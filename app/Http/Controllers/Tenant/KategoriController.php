<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\JenisKategoriTenant;
use App\Models\KategoriTenant;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index() {
        $kategoris = KategoriTenant::where('level', '1')->get();

        return view('frontend.kategori', compact('kategoris'));
    }

    public function induk($id) {
        $kategori = KategoriTenant::where('id', $id)->first();
        if (!$kategori) {
            return abort(404);
        } else {
            $kategoris = KategoriTenant::where('id_induk_kategori', $id)->get();

            return view('frontend.kategori', [
                'kategoris' => $kategoris,
                'title' => $kategori->nama_kategori
            ]);
        }
    }

    public function showProduk($id) {
        $kategori = KategoriTenant::where('id', $id)->first();
        if (!$kategori) {
            return abort(404);
        } else {
            $kategoris = KategoriTenant::all();
            $produks = JenisKategoriTenant::getProduk($id);

            return view('frontend.produk.show_by_kategori', [
                'kategoris' => $kategoris,
                'kategori' => $kategori,
                'produks' => $produks
            ]);
        }
    }
}
