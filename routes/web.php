<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/add-user', function () {
    return view('addpage');
});

Route::get('/edit-user', function () {
return view('editpage');
});
