<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;
    protected $table = 'konfigurasi_sgs';
    public $timestamps = false;

    public static function get($key = null) {
        $config = self::first();
        if ($key !== null) {
            return $config->$key ?? null;
        }

        return $config;
    }
}
