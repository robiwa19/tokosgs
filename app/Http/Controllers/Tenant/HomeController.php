<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Libraries\Sologreatsale;
use App\Models\ProdukTenant;
use App\Models\Slider;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $news = Sologreatsale::news();
        $sponsors = Sologreatsale::sponsors();
        $sliders = Slider::all();
        $testimonis = Testimoni::all();
        $produks = ProdukTenant::limit(8)
            ->orderBy('id', 'DESC')->get();

        return view('frontend.tenant', [
            'news' => $news,
            'sponsors' => $sponsors,
            'sliders' => $sliders,
            'testimonis' => $testimonis,
            'produks' => $produks
        ]);
    }
}
