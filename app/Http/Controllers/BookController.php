<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookshelf;

class BookController extends Controller
{
    public function index()
    {
        return view('books.index');
    }
}
