<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Member;
use App\Models\Book;
use App\Models\Circulation;

class IndexController extends Controller
{
    public function index() {
        $memberCount = DB::table('members')->count();
        $bookCount = DB::table('books')->count();
        $loanCount = DB::table('circulations')->where('status', 'Berjalan')->count();
        $returnCount = DB::table('circulations')->where('status', 'Selesai')->count();
        return view('pages.dashboard.index', compact('memberCount', 'bookCount', 'loanCount', 'returnCount'));
    }
}
