<?php
declare(strict_types=1);

namespace app\controller;

use app\BaseController;
use app\model\User;
use app\validate\User as UserValidate;
use think\exception\ValidateException;
use think\facade\Session;
use think\Request;
use think\response\Json;
use think\response\View;

class Login extends BaseController
{

    /**
     * 跳转登录页面
     *
     * @return View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * 跳转注册页面
     *
     * @return View
     */
    public function register()
    {
        return view('register');
    }


    /**
     * 进行登录操作
     *
     * @param Request $request
     * @return Json
     */
    public function login(Request $request)
    {
        // 验证token
        $tokenCheck = $request->checkToken('__token__', $request->param());
        if (false == $tokenCheck) {
            $token = createToken($request);
            return json([false, $token, '表单错误']);
        }
        try {
            validate(UserValidate::class)
                ->scene('login')
                ->check($request->param());
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            $token = createToken($request);
            return json([false, $token, $e->getError()]);
        }
        // 验证用户名
        $username = $request->param('username');
        $user = User::where('username', $username)->findOrEmpty();
        if ($user->isEmpty()) {
            $token = createToken($request);
            return json([false, $token, '账号或密码错误']);
        }
        // 验证密码
        $password = $request->param('password');
        $result = $user->passwordVerify($password);
        if (!$result) {
            $token = createToken($request);
            return json([false, $token, '账号或密码错误']);
        }
        // 存入Session
        Session::clear();
        Session::set('username', $username);
        return json(true);
    }

    /**
     * 注册一个新的用户
     *
     * @param Request $request
     * @return Json
     */
    public function store(Request $request)
    {
        $tokenCheck = $request->checkToken('__token__', $request->param());
        $token = createToken($request);
        if (false == $tokenCheck) {
            return json([false, $token, '表单错误']);
        }
        try {
            validate(UserValidate::class)
                ->scene('register')
                ->check($request->param());
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            return json([false, $token, $e->getError()]);
        }
        $username = $request->param('username');
        $userIsExist = User::where('username', $username)->findOrEmpty();

        if (!$userIsExist->isEmpty()) {
            return json([false, $token, '该用户名已存在']);
        }
        $user = new User;
        $passwordTemp = $request->param('password');
        $password = password_hash($passwordTemp, PASSWORD_DEFAULT);
        $user->username = $username;
        $user->password = $password;
        $result = $user->save();
        if (false == $result) {
            return json([false, $token, '数据添加失败']);
        }
        unset($token);
        return json([true, 'success']);
    }

    public function logout(){
        Session::clear();
        // 重定向到index页面
        return redirect((string)url('index/index'));
    }

    public function miss(){
        return view('miss');
    }
}