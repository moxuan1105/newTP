<?php
declare(strict_types=1);
namespace app\controller;

use app\BaseController;

class Login extends BaseController
{

    public function index()
    {
        return view('index');
    }
}