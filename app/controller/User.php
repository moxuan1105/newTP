<?php


namespace app\controller;

use app\BaseController;
use app\middleware\Auth;
use app\model\UserInfo;
use think\Request;
use app\model\User as UserModel;

class User extends BaseController
{
    // 需要验证
    protected $middleware = [Auth::class];

    public function userList(){
        $count = UserModel::count();
        $user = UserModel::withoutField('password')->select();
        $data = [
            'code'=>0,
            'msg'=>0,
            'count'=>$count,
            'data'=>$user
        ];
        return json($data);
    }

    public function modifyPasswordView(Request $request){
        return view('modifyPassword');
    }

    public function modifyPassword(Request $request){
        return dump($request);
    }

    public function getUserInfo(){
//        $userInfo =  UserInfo::where('user_id',1)->select();
        $userInfo = UserModel::hasWhere('userInfo',['info'=>56465])->select();

        if($userInfo->isEmpty()){
            return json($userInfo);
        }
        $data = [];
        // select 查询到的是model的一个集合 需要单独取值后 再进行model的操作
        foreach ($userInfo as $user){
            $data[] = $user->userinfo->info;
        }

        return json($data);
    }


}