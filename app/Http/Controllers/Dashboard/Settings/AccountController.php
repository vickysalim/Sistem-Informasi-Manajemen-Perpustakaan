<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AccountController extends Controller
{
    public function index() {
        $accountData = User::all();
        return view('pages.dashboard.pengaturan.akun', compact('accountData'));
    }

    public function store(Request $request) {
        // validate
        $validate = $request->validate([
            'namaLengkap' => 'required',
            'email' => 'required',
            'password' => 'required',
            'tipeAkun' => 'required',
        ]);

        // check if email already exists
        if (User::where('email', $validate['email'])->exists()) {
            return redirect()->route('pengaturan.akun')->with('danger', 'Email sudah terdaftar!');
        }

        try {
            // store
            $user = new User;
            $user->name = $validate['namaLengkap'];
            $user->email = $validate['email'];
            $user->password = Hash::make($validate['password']);
            $user->role = $validate['tipeAkun'];
    
            // save
            $user->save();
        } catch (\Exception $e) {
            return redirect()->route('pengaturan.akun')->with('danger', 'Gagal menambahkan data buku');
        }

        // redirect
        return redirect()->route('pengaturan.akun')->with('success', 'Akun berhasil ditambahkan!');
    }

    public function update(Request $request, User $user) {

    }

    public function destroy(Request $request, User $user) {
        try {
            // delete
            User::where('id', $user->id)->delete();
        } catch (\Exception $e) {
            return redirect()->route('pengaturan.akun')->with('danger', 'Gagal menghapus data akun');
        }

        // redirect
        return redirect()->route('pengaturan.akun')->with('success', 'Akun berhasil dihapus!');
    }
}
