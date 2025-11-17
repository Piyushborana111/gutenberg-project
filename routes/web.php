<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Book Genre/Category list page route
Route::get('/', function () {
    return view('home');
});
// Book list page route according to selected category
Route::get('/books/{category}', function ($category) {
    return view('books', compact('category'));
});
