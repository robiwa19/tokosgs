<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriTenant extends Model
{
    use HasFactory;
    protected $table = 'ref_jenis_kategori';

    public static function getInduk($id) {
        return self::where('id_induk_kategori', $id)->get();
    }
}
