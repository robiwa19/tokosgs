<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SGSUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('sgs_user')) return redirect('/auth/login');

        $user = Session::get('sgs_user');
        $user = User::where('id', $user->id)->first();
        
        if (!$user) {
            Session::forget('sgs_user');

            return redirect('/auth/login');
        }
        
        Session::put('sgs_user', $user);

        return $next($request);
    }
}
