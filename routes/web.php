<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
// ...

Route::get('/add-user', [App\Http\Controllers\HomeController::class, 'showAddPage']);
Route::post('/add-user', [App\Http\Controllers\HomeController::class, 'addUser'])->name('add.user');

// ...
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::get('/f', function () {
//     return view('homepage');
// });

Route::get('/add-user', function () {
    $titles = App\Models\Title::all();
    return view('addpage', compact('titles'));
});

Route::get('/edit-user', function () {
return view('editpage');
});
