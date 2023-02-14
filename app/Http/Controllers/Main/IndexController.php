<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Setting;

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

    public function show(Book $book) {
        $bookData = Book::where('id', $book->id)->first();

        return view('pages.main.buku', compact('bookData'));
    }

    public function about() {
        // get data from settings
        $settingsData = Setting::all();

        return view('pages.main.tentang', compact('settingsData'));
    }
}
