<?php

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/get-content/{collection}', function ($collectionName) {
    $collection = Collection::where('name', $collectionName)->with('posts')->get();
    return response()->json($collection);
});
