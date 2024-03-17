<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/upload', function () {
    return view('upload');
});

Route::post('/file-upload', [App\Http\Controllers\UploadController::class, 'uploadAndProcess']);
Route::get('/content', [App\Http\Controllers\ContentController::class, 'list']);
Route::get('/edit/{id}', [App\Http\Controllers\ContentController::class, 'edit']);
Route::put('/save', [App\Http\Controllers\ContentController::class, 'save']);
