<?php

namespace app\controller;

use app\BaseController;
use app\middleware\Auth;
use think\response\Redirect;
use think\response\View;

class Index extends BaseController
{

    protected $middleware = [Auth::class];

    /**
     * Home主页
     *
     * @return View
     */
    public function index()
    {
        // 判断有无进行登录操作
        return view('index');
    }

    public function welcome(){

        return 'hello';
    }


    public function miss(){
        return view('miss');
    }



}
