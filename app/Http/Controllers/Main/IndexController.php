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

    public function search(Request $request) {
        // validate
        $validate = $request->validate([
            'keyword' => 'required'
        ]);

        // get book data
        $bookData = Book::where('name', 'LIKE', '%' . $validate['keyword'] . '%')
            ->orWhere('author', 'LIKE', '%' . $validate['keyword'] . '%')
            ->get();

        return view('pages.main.search', compact('bookData'));
    }
}
