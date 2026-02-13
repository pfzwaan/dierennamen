<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\NameController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home']);

Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{slug}', [BlogController::class, 'show'])
    ->where('slug', '[A-Za-z0-9-]+');

Route::get('/namen', [NameController::class, 'archiveGlobal'])->name('names.archive');
Route::get('/namen/zoeken', [NameController::class, 'search'])->name('names.search');
Route::get('/namen/{nameCategory}', [NameController::class, 'categoryIndex'])->name('names.category');
Route::get('/namen/{nameCategory}/{letter}', [NameController::class, 'category'])
    ->where('letter', '[A-Za-z]')
    ->name('names.category.letter');
Route::get('/namen/{nameCategory}/{name}', [NameController::class, 'show'])
    ->where('name', '(?![A-Za-z]$)[A-Za-z0-9-]+')
    ->name('names.show');

Route::get('/{slug}', [PageController::class, 'show'])
    ->where('slug', '^(?!admin$)[A-Za-z0-9-]+$');
