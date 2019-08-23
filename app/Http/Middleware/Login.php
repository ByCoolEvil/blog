<?php

namespace App\Http\Middleware;

use Closure;

class Login
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
        // 前置
        // $result = $request->session()->has('name');
        $result = $request->session()->has('uid');
        if($result){
            echo "登陆成功!";
        }else{
            // return redirect('liuyan/wechat_login');
            dd('登录失败');
        }

        $response = $next($request);

        // 后置
        // echo 2222222;

        return $response;
        // return $next($request);
    }
}
