<?php

namespace App\Http\Controllers;

use App\Models\Name;
use App\Models\NameCategory;
use App\Models\NameComment;
use App\Models\NameLike;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NameController extends Controller
{
    public function search(Request $request): RedirectResponse
    {
        $category = NameCategory::query()
            ->where('slug', (string) $request->query('category'))
            ->first();

        $params = array_filter([
            'gender' => $this->normalizeGender($request->query('gender')),
            'q' => trim((string) $request->query('q')),
        ], fn ($value) => filled($value));

        if ($category) {
            return redirect()->route('names.category', ['nameCategory' => $category] + $params);
        }

        return redirect()->route('names.archive', $params);
    }

    public function archiveGlobal(): View
    {
        $categories = NameCategory::query()
            ->withCount('names')
            ->orderBy('name')
            ->get(['id', 'name', 'slug']);

        $topFemale = Name::query()
            ->with('nameCategory:id,slug')
            ->where('gender', 'female')
            ->orderBy('title')
            ->limit(10)
            ->get(['id', 'title', 'slug', 'name_category_id']);

        $popularNames = Name::query()
            ->with('nameCategory:id,slug')
            ->popular()
            ->limit(10)
            ->get(['id', 'title', 'slug', 'name_category_id', 'likes_count']);

        return view()->file(resource_path('views/names/archive_global.blade.php'), [
            'categories' => $categories,
            'topFemale' => $topFemale,
            'popularNames' => $popularNames,
        ]);
    }

    public function categoryIndex(NameCategory $nameCategory, Request $request): View
    {
        $namesQuery = $nameCategory->names()
            ->when($this->normalizeGender($request->query('gender')), function ($query, $gender) {
                $query->where('gender', $gender);
            })
            ->when(filled($request->query('q')), function ($query) use ($request) {
                $query->where('title', 'like', '%' . trim((string) $request->query('q')) . '%');
            })
            ->orderBy('title');

        $namesToRender = (clone $namesQuery)
            ->orderBy('title')
            ->limit(100)
            ->get(['id', 'title', 'slug']);

        $topFemale = $nameCategory->names()
            ->where('gender', 'female')
            ->orderBy('title')
            ->limit(10)
            ->get(['id', 'title', 'slug']);

        return view('names.category', [
            'nameCategory' => $nameCategory,
            'letter' => 'A',
            'letters' => range('A', 'Z'),
            'namesToRender' => $namesToRender,
            'topFemale' => $topFemale,
            'activeGender' => $this->normalizeGender($request->query('gender')),
            'activeQuery' => trim((string) $request->query('q')),
        ]);
    }

    public function category(NameCategory $nameCategory, string $letter, Request $request): View
    {
        $letter = strtoupper($letter);
        abort_unless(preg_match('/^[A-Z]$/', $letter) === 1, 404);

        $namesQuery = $nameCategory->names()
            ->when($this->normalizeGender($request->query('gender')), function ($query, $gender) {
                $query->where('gender', $gender);
            })
            ->when(filled($request->query('q')), function ($query) use ($request) {
                $query->where('title', 'like', '%' . trim((string) $request->query('q')) . '%');
            })
            ->orderBy('title');

        $letterNames = (clone $namesQuery)
            ->where('title', 'like', $letter . '%')
            ->get(['id', 'title', 'slug']);

        $allNames = $namesQuery->get(['id', 'title', 'slug']);

        $namesToRender = $letterNames->isNotEmpty() ? $letterNames : $allNames;

        $topFemale = $nameCategory->names()
            ->where('gender', 'female')
            ->orderBy('title')
            ->limit(10)
            ->get(['id', 'title', 'slug']);

        return view('names.category_letter', [
            'nameCategory' => $nameCategory,
            'letter' => $letter,
            'letters' => range('A', 'Z'),
            'namesToRender' => $namesToRender,
            'topFemale' => $topFemale,
            'activeGender' => $this->normalizeGender($request->query('gender')),
            'activeQuery' => trim((string) $request->query('q')),
        ]);
    }

    public function show(NameCategory $nameCategory, Name $name): View
    {
        abort_unless($name->name_category_id === $nameCategory->id, 404);

        $approvedComments = $name->comments()
            ->where('is_approved', true)
            ->latest()
            ->get(['id', 'author_name', 'message', 'created_at']);

        return view('names.show', [
            'name' => $name,
            'nameCategory' => $nameCategory,
            'approvedComments' => $approvedComments,
        ]);
    }

    public function like(Request $request, NameCategory $nameCategory, Name $name): RedirectResponse
    {
        abort_unless($name->name_category_id === $nameCategory->id, 404);

        $voterToken = (string) $request->cookie('name_voter_token');
        $shouldSetCookie = blank($voterToken);

        if ($shouldSetCookie) {
            $voterToken = Str::random(64);
        }

        $voterTokenHash = hash('sha256', $voterToken);
        $ip = (string) $request->ip();
        $ipHash = filled($ip)
            ? hash_hmac('sha256', $ip, (string) config('app.key', 'names-like-salt'))
            : null;

        $alreadyLiked = NameLike::query()
            ->where('name_id', $name->id)
            ->where(function ($query) use ($ipHash, $voterTokenHash): void {
                $query->where('voter_token_hash', $voterTokenHash);

                if (filled($ipHash)) {
                    $query->orWhere('ip_hash', $ipHash);
                }
            })
            ->exists();

        $status = 'already_liked';

        if (! $alreadyLiked) {
            NameLike::query()->create([
                'name_id' => $name->id,
                'ip_hash' => $ipHash,
                'voter_token_hash' => $voterTokenHash,
            ]);

            $name->increment('likes_count');
            $status = 'liked';
        }

        $response = redirect()->back()->with('name_like_status', $status);

        if ($shouldSetCookie) {
            $response->cookie(
                'name_voter_token',
                $voterToken,
                60 * 24 * 365 * 5,
                null,
                null,
                request()->isSecure(),
                true,
                false,
                'Lax'
            );
        }

        return $response;
    }

    public function storeComment(Request $request, NameCategory $nameCategory, Name $name): RedirectResponse
    {
        abort_unless($name->name_category_id === $nameCategory->id, 404);

        $validated = $request->validate([
            'author_name' => ['required', 'string', 'max:255'],
            'author_email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:3', 'max:2000'],
        ]);

        $ip = (string) $request->ip();
        $ipHash = filled($ip)
            ? hash_hmac('sha256', $ip, (string) config('app.key', 'names-comment-salt'))
            : null;

        $name->comments()->create([
            'author_name' => $validated['author_name'],
            'author_email' => $validated['author_email'],
            'message' => $validated['message'],
            'is_approved' => false,
            'approved_at' => null,
            'ip_hash' => $ipHash,
        ]);

        return redirect()
            ->route('names.show', ['nameCategory' => $nameCategory, 'name' => $name])
            ->with('comment_status', 'pending');
    }

    private function normalizeGender(mixed $gender): ?string
    {
        $value = trim((string) $gender);

        return in_array($value, ['male', 'female'], true) ? $value : null;
    }
}
