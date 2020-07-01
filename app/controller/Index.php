<?php
namespace app\controller;

use app\BaseController;
use think\facade\Session;

class Index extends BaseController
{
    public function index(){
        if(!session('?name')){
            return redirect((string)url('Login/'));
        }
        return 'index';
    }
}
