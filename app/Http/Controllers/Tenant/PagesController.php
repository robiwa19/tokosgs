<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Konten;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index($code = null) {
        $konten = Konten::where('code', $code)->first();
        if (!$konten) {
            return abort(404, 'Halaman tidak ditemukan!');
        } else {
            return view('frontend.pages', compact('konten'));
        }
    }

    public function contact() {
        return view('frontend.contact');
    }
}
