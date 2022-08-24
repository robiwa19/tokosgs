<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function settings() {
        return view('account.settings');
    }

    public function change_password(Request $r) {
        $r->validate([
            'password' => 'required',
            'newpassword' => 'required',
            'confirm_newpassword' => 'required|same:newpassword'
        ]);
        
        $user = User::find(User::auth()->id);
        $user->password = Hash::make($r->newpassword);
        $user->save();

        return redirect('/account/settings')->with('success', 'Kata Sandi berhasil diubah.');
    }
}
