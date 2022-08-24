<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKategoriTenant extends Model
{
    use HasFactory;
    protected $table = 'tenant_jenis_kategori';

    public static function getProduk($id_jenis_kategori) {
        $jenis_kategoris = self::where('id_jenis_kategori', $id_jenis_kategori)->get();

        $produks = [];
        foreach ($jenis_kategoris as $jk) {
            $tenant = Tenant::where('id', $jk->id_tenant)->first();
            if (!isset($produks[$jk->id_tenant]) && $tenant) {
                $produks[$jk->id_tenant] = ProdukTenant::where('id_tenant', $tenant->id)->get();
            }
        }

        $results = [];
        foreach ($produks as $pkey => $pvalue) {
            foreach ($pvalue as $produk) {
                $results[] = $produk;
            }
        }

        return $results;
    }
}
