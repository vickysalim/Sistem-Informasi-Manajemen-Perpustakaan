<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class AccountController extends Controller
{
    public function index() {
        $accountData = User::all();
        return view('pages.dashboard.pengaturan.akun', compact('accountData'));
    }

    public function update(Request $request, User $user) {

    }

    public function destroy(Request $request, User $user) {

    }
}
