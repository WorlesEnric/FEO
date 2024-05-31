<?php
namespace app\index\controller;
use think\Controller;//引入Controller类



class AuthController extends Controller
{
	
	protected function _initialize(){
		
		$request= \think\Request::instance();
		$controller_name=$request->controller();
		$action=$request->action();
		$active_url=$controller_name.'/'.$action;
		session_start();
		// var_dump($_SESSION);die;
		if($active_url == 'Index/login'){
			unset($_SESSION['aid']);unset($_SESSION['expiretime']);
		}
		
		//session存在时，不需要验证的权限
		$not_check = array('Index/login','Index/check1','Index/checkuser');
		//当前操作的请求                 模块名/方法名
		if(in_array($active_url, $not_check)){
			return true;
		}
		
		// var_dump($active_url);die;
	
		//session不存在时，不允许直接访问
		if(!isset($_SESSION['aid']) || !isset($_SESSION['expiretime'])  || !$_SESSION['aid'] || $_SESSION['expiretime'] < time() ){
			header('Location: /tp5/public/index.php/index/index/login'); // 登出
			exit(0);
		}

	}
	
}