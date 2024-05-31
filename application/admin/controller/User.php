<?php

namespace app\admin\controller;
use think\facade\Request;
use think\facade\Session;
use app\admin\common\controller\Base;

class User extends Base
{
    public function login()
    {
        return "wsfdfedf";
       // return $this->view->fetch('login',['title'=>'用户登录']);
    }
    public function checkLogin()
    {
        $this->record();
        $data = request()->post();

        $rule = [
            'name|用户名' => 'require',
            'password|密码' => 'require',
        ];

        $res = $this->validate($data, $rule);
        if ($res !== true) {
            $this->error($res);
        } else {
            //验证成功,执行查询操作,用闭包查询
            $result = UserModel::get(function ($query) use ($data) {
                $query->where('name', $data['name'])
                    ->where('password', $data['password']);

            });
            if (null == $result) {
                //密码或用户名错误
                $this->error('密码或用户名错误');
            } else {
                //将用户的数据写道session中
                Session::set('admin_level', $result->is_admin);
                Session::set('admin_id', $result->id);
                Session::set('admin_name', $result->name);
                $this->success('登录成功', 'index/index');
            }

        }
    }
}