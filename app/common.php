<?php
// 应用公共文件
use think\Request;

/**
 * 创建一个公用函数创建新的Token
 *
 * @param Request $request
 * @return string
 */
function createToken(Request $request){
    return $request->buildToken();
}


/**
 * page limit 的预处理
 *
 * @param $request
 * @return array
 */
function pagePrepare(Request $request)
{
    $page = (int)$request->param('page');
    $limit = (int)$request->param('limit');
    $page = (int)($page - 1) * $limit;

    return [$page,$limit];
}