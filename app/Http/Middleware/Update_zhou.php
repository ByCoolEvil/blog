<?php

namespace App\Http\Middleware;

use Closure;

class Update_zhou
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
        $start = strtotime('9:00:00');
        $end = strtotime('17:00:00');
        $_now_ = time();
        if($_now_ >= $start && $_now_ <= $end){
            //可以通过
        }else{
            //不可以通过
            dd('当前时间不可访问');
        }

        return $next($request);
    }
}
