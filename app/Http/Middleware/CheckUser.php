<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        if(in_array($request->user()->level,$levels)){
            return $next($request);
        }
        if($request->user()->level=='user'){
            return redirect('/cetakhasilperhitungan');
        }
        // dd($request->user());
        return redirect('/');
    }
}
