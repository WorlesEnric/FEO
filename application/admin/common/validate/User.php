<?php

namespace app\admin\common\validate;
use think\Validate;

class User extends Validate
{
    protected $rule = [
        'name|用户名'=>'require|chsAlphaNum',
        'email|邮箱'=>'require|email|unique:ly_user',
        'mobile|手机号'=>'require|mobile|unique:ly_user',
        'password|密码'=>'require|alphaNum|confirm',
    ];
}