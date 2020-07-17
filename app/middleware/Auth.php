<?php
namespace app\middleware;

use Closure;
use think\Request;
use think\Response;
use think\response\Redirect;

class Auth
{
    /**
     * 处理请求
     *
     * @param Request $request
     * @param Closure $next
     * @return Response|Redirect
     */
    public function handle($request, Closure $next)
    {
        // 验证登录操作
        if (!session('?username')) {
            return redirect((string)url('login/'));
        }
        return $next($request);
    }
}
