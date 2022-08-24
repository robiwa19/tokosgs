<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    use HasFactory;
    protected $table = 'conf';

    public static function getCodes() {
        return [
            'about_us' => 'About Us',
            'toc' => 'Terms Of Conditions'
        ];
    }

    public static function acceptedCodes() {
        $accepted = [];
        foreach (self::getCodes() as $key => $value) {
            $accepted[] = $key;
        }

        return $accepted;
    }

    public static function getCodeName($code) {
        return self::getCodes()[$code] ?? null;
    }
}
