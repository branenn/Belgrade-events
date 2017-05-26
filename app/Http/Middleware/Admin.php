<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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


//if(Auth::check){
 //   if(Auth::user()->uloga==1)
//}
        /*  if ($request->user()->uloga != 2)
          {
              return redirect('home');
          }
          return $next($request);
          */

          if ( Auth::check() && Auth::user()->uloga==2 )
          {
              return $next($request);
          }

          return redirect('/admin');


    }
}
