<?php

namespace app\controller;

use app\BaseController;
use think\response\Redirect;
use think\response\View;

class Index extends BaseController
{
    /**
     * Home主页
     *
     * @return Redirect|View
     */
    public function index()
    {
        // 判断有无进行登录操作
        if (!session('?username')) {
            return redirect((string)url('login/'));
        }
        return view('index');
    }



}
