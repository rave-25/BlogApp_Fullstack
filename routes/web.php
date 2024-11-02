<?php

use App\Http\Controllers\AdminControl;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DevController;

Route::post('app/create_tag', [AdminControl::class, 'addTag']);
Route::get('app/get_tags', [AdminControl::class, 'getTag']);
Route::post('app/edit_tag', [AdminControl::class, 'editTag']);

Route::get('/', function () {
    return view('welcome');
});

Route::any('{slug}', function(){
    return view('welcome');
});