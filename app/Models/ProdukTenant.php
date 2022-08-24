<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukTenant extends Model
{
    use HasFactory;
    protected $table = 'tenant_produk';

    public static function foto($id_tenant_produk) {
        return ProdukFotoTenant::where('id_tenant_produk', $id_tenant_produk)->get();
    }
}
