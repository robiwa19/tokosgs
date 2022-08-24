<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\ProdukTenant;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function produkDetail(Request $r) {
        if ($r->has('id')) {
            $produk = ProdukTenant::where('id', $r->id)->first();
            if (!$produk) {
                return abort(404);
            } else {
                $produk->image_path_file = 'https://dummyimage.com/540x600/bfbdbf/fff.jpg';
                if (count($produk->foto($produk->id)) >= 1) {
                    foreach ($produk->foto($produk->id) as $foto) {
                        $produk->image_path_file = $foto->path_file;
                        break;
                    }
                }
                $produk->harga_format = number_format($produk->harga,0,',','.');

                return json_encode($produk);
            }
        }
    }
}
