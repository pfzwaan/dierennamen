<?php

namespace App\Http\Controllers;

use App\Models\Name;
use App\Models\NameCategory;
use Illuminate\View\View;

class NameController extends Controller
{
    public function archiveGlobal(): View
    {
        $categories = NameCategory::query()
            ->withCount('names')
            ->orderBy('name')
            ->get(['id', 'name', 'slug']);

        $topFemale = Name::query()
            ->where('gender', 'female')
            ->orderBy('title')
            ->limit(10)
            ->get(['id', 'title', 'slug']);

        return view()->file(resource_path('views/names/archive_global.blade.php'), [
            'categories' => $categories,
            'topFemale' => $topFemale,
        ]);
    }

    public function categoryIndex(NameCategory $nameCategory): View
    {
        $namesToRender = $nameCategory->names()
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
        ]);
    }

    public function category(NameCategory $nameCategory, string $letter): View
    {
        $letter = strtoupper($letter);
        abort_unless(preg_match('/^[A-Z]$/', $letter) === 1, 404);

        $namesQuery = $nameCategory->names()->orderBy('title');

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
        ]);
    }

    public function show(Name $name): View
    {
        return view('names.show', [
            'name' => $name,
        ]);
    }
}
