<?php

namespace App\Http\Controllers;

use App\Models\Name;
use App\Models\NameCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

        return view()->file(resource_path('views/names/archive_global.blade.php'), [
            'categories' => $categories,
            'topFemale' => $topFemale,
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

        return view('names.show', [
            'name' => $name,
            'nameCategory' => $nameCategory,
        ]);
    }

    private function normalizeGender(mixed $gender): ?string
    {
        $value = trim((string) $gender);

        return in_array($value, ['male', 'female'], true) ? $value : null;
    }
}
