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
