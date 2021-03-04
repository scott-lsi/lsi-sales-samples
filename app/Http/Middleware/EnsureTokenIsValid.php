<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

use App\Models\Token;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() || session()->has('token') && Carbon::now() < Token::where('token', session('token')->token)->first()->expires){
            return $next($request);
        }
        
        session()->flash('flash.banner', 'Sorry, you do not have authorisation to visit this page');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('home');
    }
}
