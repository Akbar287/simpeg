<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class cekLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = User::find(Auth::user()->user_id);
            if($user->role()->first()->name == 'admin' || $user->role()->first()->name == 'pegawai') return redirect('/home');
            Auth::logout(); return redirect('/login')->with('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Kesalahan!</strong> Anda Tidak memiliki hak akses ke sistem pegawai. Hubungi Admin<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }
        return $next($request);
    }
}
