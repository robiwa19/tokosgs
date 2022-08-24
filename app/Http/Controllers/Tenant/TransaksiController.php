<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index() {
        $transaksis = Transaksi::where('id_buyer', User::auth()->id)->get();

        return redirect('/fo');
    }
}
