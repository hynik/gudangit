<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class authAdmin
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
        // if (Session::has('userCredensials') && Session::get('userCredensials')['role'] == 1){

        //     return $next($request);
        // }
        // elseif (Session::has('userCredensials') && Session::get('userCredensials')['role'] == 2){

        //     return $next($request);
        // }

        if (!empty(session()->get('userCredential'))) {
            return $next($request);
        }
        // return $next($request);

        return redirect('login');
    }
}
