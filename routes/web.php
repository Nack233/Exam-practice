<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/add-user', [App\Http\Controllers\HomeController::class, 'addUser'])->name('add.user');
// Route::get('/f', function () {
//     return view('homepage');
// });

Route::get('/add-user', function () {
    return view('addpage');
});

Route::get('/edit-user', function () {
return view('editpage');
});
