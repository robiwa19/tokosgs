<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';

    public static function auth() {
        if (Session::has('sgs_user')) {
            $user = Session::get('sgs_user');
            
            return $user;
        }

        return null;
    }
}
