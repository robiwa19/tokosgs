<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index() {
        if (!Session::has('sgs_user')) {
            return redirect('/fo');
        }

        return view('home');
    }
}
