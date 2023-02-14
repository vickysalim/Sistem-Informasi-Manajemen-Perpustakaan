<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;

class IndexController extends Controller
{
    public function index() {
        $bookData = Book::orderBy('created_at', 'desc')->limit(6)->whereNotNull('cover_url')->get();

        return view('pages.main.index', compact('bookData'));
    }
}
