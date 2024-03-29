<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// function แก้ไข

Route::get('/edit-user/{id}', [HomeController::class, 'editUser'])->name('edit.user');
Route::put('/update-user/{id}', [HomeController::class, 'updateUser'])->name('update.user');

Route::get('/edit-user', function () {
return view('editpage');
});
// function ลบ

Route::delete('/delete-user/{id}', [App\Http\Controllers\HomeController::class, 'deleteUser'])->name('delete.user');

// function เพิ่ม

Route::get('/add-user', [App\Http\Controllers\HomeController::class, 'showAddPage']);

Route::post('/add-user', [App\Http\Controllers\HomeController::class, 'addUser'])->name('add.user');

Route::get('/add-user', function () {
    $titles = App\Models\Title::all();
    return view('addpage', compact('titles'));
});
// หน้าหลัก
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::get('/f', function () {
//     return view('homepage');
// });




