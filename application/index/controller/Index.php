<?php
namespace app\index\controller;
use think\Db;


class Index extends AuthController
{
	
	public function check()
	{
		
		return view();
			
	         }
			 public function checkf29()
			 {
		 
			 return view();
			 
			  }
			  public function checkf29xiaoku()
			  {
		  
			  return view();
			  
			   }
			 public function checkh08()
			 {
		 
			 return view();
			 
			  }
			 public function checkd02()
			{
		
			return view();
			
	         }
			 public function checkf20()
			 {
		 
			 return view();
			 
			  }
			  public function checkf21()
			  {
		  
			  return view();
			  
			   }
	
	public function login()
	{

        return $this->view->fetch('login',['title'=>'用户登录']);
	         }
	     
	         public function check1(){
				$inputuser=$_POST['username'];
				$inputpwd=$_POST['password'];
				
				 $user1 = Db::table('login')->where('id', 1)->where('username', $inputuser)->where('password', md5($inputpwd))->select();
				 $user2 = Db::table('login')->where('id', 2)->where('username', $inputuser)->where('password', md5($inputpwd))->select();
				 $user3 = Db::table('login')->where('id', 3)->where('username', $inputuser)->where('password', md5($inputpwd))->select();
				 $user4 = Db::table('login')->where('id', 4)->where('username', $inputuser)->where('password', md5($inputpwd))->select();
				 $user5 = Db::table('login')->where('id', 5)->where('username', $inputuser)->where('password', md5($inputpwd))->select();
				 $user6 = Db::table('login')->where('id', 6)->where('username', $inputuser)->where('password', md5($inputpwd))->select();
				 $user7 = Db::table('login')->where('id', 7)->where('username', $inputuser)->where('password', md5($inputpwd))->select();
	             if ($user1) {

					

					
					$loginTime = date('Y-m-d H:i:s');
					//获取页面的url			
					$host = $_SERVER['HTTP_HOST'];																			
					$uri = $_SERVER['REQUEST_URI'];										
					$url = "http://$host$uri";

							// 获取客户端IP地址
					$ip = $_SERVER['REMOTE_ADDR'];
			
					$data1 = [
						

						'url' => $url,
						'ip' => $ip,
						'username' => $inputuser,
						'title' => "登录"
					];
					$data2 = [
						
						 
						'create_time' => date('Y-m-d H:i:s', strtotime('+1 minute'))
					];
					Db::table('loginrecord')->insert($data1);
					Db::table('login')->where('id', 1)->update($data2);
					//记录session
					$_SESSION['aid'] = 1;
					$_SESSION['expiretime'] = time() + 3600; //登录一个小时
					 // 设置参数值为1
    				$param = 1;

				} elseif($user2){
					$loginTime = date('Y-m-d H:i:s');
					//获取页面的url			
					$host = $_SERVER['HTTP_HOST'];																			
					$uri = $_SERVER['REQUEST_URI'];										
					$url = "http://$host$uri";

							// 获取客户端IP地址
					$ip = $_SERVER['REMOTE_ADDR'];
			
					$data1 = [
						
						'logintime' => $loginTime,
						'url' => $url,
						'ip' => $ip,
						'username' => $inputuser,
						'title' => "登录"
					];
					$data2 = [
						
						 
						'creattime' => date('Y-m-d H:i:s', strtotime('+1 minute'))
					];
					Db::table('loginrecord')->insert($data1);
					Db::table('login')->where('id', 2)->update($data2);
					//记录session
					$_SESSION['aid'] = 1;
					$_SESSION['expiretime'] = time() + 3600; //登录一个小时
					$param = 2;
				}elseif($user3){
					$loginTime = date('Y-m-d H:i:s');
					//获取页面的url			
					$host = $_SERVER['HTTP_HOST'];																			
					$uri = $_SERVER['REQUEST_URI'];										
					$url = "http://$host$uri";

							// 获取客户端IP地址
					$ip = $_SERVER['REMOTE_ADDR'];
			
					$data1 = [
						
						'logintime' => $loginTime,
						'url' => $url,
						'ip' => $ip,
						'username' => $inputuser,
						'title' => "登录"
					];
					$data2 = [
						
						 
						'creattime' => date('Y-m-d H:i:s', strtotime('+1 minute'))
					];
					Db::table('loginrecord')->insert($data1);
					Db::table('login')->where('id', 3)->update($data2);
					//记录session
					$_SESSION['aid'] = 1;
					$_SESSION['expiretime'] = time() + 3600; //登录一个小时
					$param = 3;
				}elseif($user4){
					$loginTime = date('Y-m-d H:i:s');
					//获取页面的url			
					$host = $_SERVER['HTTP_HOST'];																			
					$uri = $_SERVER['REQUEST_URI'];										
					$url = "http://$host$uri";

							// 获取客户端IP地址
					$ip = $_SERVER['REMOTE_ADDR'];
			
					$data1 = [
						
						'logintime' => $loginTime,
						'url' => $url,
						'ip' => $ip,
						'username' => $inputuser,
						'title' => "登录"
					];
					$data2 = [
						
						 
						'creattime' => date('Y-m-d H:i:s', strtotime('+1 minute'))
					];
					Db::table('loginrecord')->insert($data1);
					Db::table('login')->where('id', 4)->update($data2);
					//记录session
					$_SESSION['aid'] = 1;
					$_SESSION['expiretime'] = time() + 3600; //登录一个小时
					$param = 4;
				}elseif($user5){
					$loginTime = date('Y-m-d H:i:s');
					//获取页面的url			
					$host = $_SERVER['HTTP_HOST'];																			
					$uri = $_SERVER['REQUEST_URI'];										
					$url = "http://$host$uri";

							// 获取客户端IP地址
					$ip = $_SERVER['REMOTE_ADDR'];
			
					$data1 = [
						
						'logintime' => $loginTime,
						'url' => $url,
						'ip' => $ip,
						'username' => $inputuser,
						'title' => "登录"
					];
					$data2 = [
						
						 
						'creattime' => date('Y-m-d H:i:s', strtotime('+1 minute'))
					];
					Db::table('loginrecord')->insert($data1);
					Db::table('login')->where('id', 5)->update($data2);
					//记录session
					$_SESSION['aid'] = 1;
					$_SESSION['expiretime'] = time() + 3600; //登录一个小时
					$param = 5;
				}elseif($user6){
					$loginTime = date('Y-m-d H:i:s');
					//获取页面的url			
					$host = $_SERVER['HTTP_HOST'];																			
					$uri = $_SERVER['REQUEST_URI'];										
					$url = "http://$host$uri";

							// 获取客户端IP地址
					$ip = $_SERVER['REMOTE_ADDR'];
			
					$data1 = [
						
						'logintime' => $loginTime,
						'url' => $url,
						'ip' => $ip,
						'username' => $inputuser,
						'title' => "登录"
					];
					$data2 = [
						
						 
						'creattime' => date('Y-m-d H:i:s', strtotime('+1 minute'))
					];
					Db::table('loginrecord')->insert($data1);
					Db::table('login')->where('id', 6)->update($data2);
					//记录session
					$_SESSION['aid'] = 1;
					$_SESSION['expiretime'] = time() + 3600; //登录一个小时
					$param = 6;
				}elseif($user7){
					$loginTime = date('Y-m-d H:i:s');
					//获取页面的url			
					$host = $_SERVER['HTTP_HOST'];																			
					$uri = $_SERVER['REQUEST_URI'];										
					$url = "http://$host$uri";

							// 获取客户端IP地址
					$ip = $_SERVER['REMOTE_ADDR'];
			
					$data1 = [
						
						'logintime' => $loginTime,
						'url' => $url,
						'ip' => $ip,
						'username' => $inputuser,
						'title' => "登录"
					];
					$data2 = [
						
						 
						'creattime' => date('Y-m-d H:i:s', strtotime('+1 minute'))
					];
					Db::table('loginrecord')->insert($data1);
					Db::table('login')->where('id', 7)->update($data2);
					//记录session
					$_SESSION['aid'] = 1;
					$_SESSION['expiretime'] = time() + 3600; //登录一个小时
					$param = 7;
				}
				else{
					$param = 0;
				}
				// 构造响应数组
					$response = array(
						
						"param" => $param
					);
				
					// 将数组转换为 JSON 格式
					$jsonResponse = json_encode($response);

					// 设置响应头，确保前端知道这是一个 JSON 格式的响应
					header('Content-Type: application/json');

					// 返回 JSON 格式的响应
					echo $jsonResponse;
				



	
	         }
	
			 public function user()
			 {
						 return view();
					  }
					  public function userInfo()//左侧回显
					  {
					$result = Db::table('login')->where('id',1)->field('username,email,photourl')->select();
					
					$response = [
						'rows' => $result[0]

					];
					
					header('Content-Type: application/json');
					echo json_encode($response);
							   }
					  public function update()//点击个人资料的提交按钮
					  {
						$email= $_POST['email'];
						$username = $_POST['username'];						
						$password = $_POST['password'];
						$hashedPassword = md5($password);
						
						$data = [
							'username' => $username,
							'email' => $email
						];
						
						if(!empty($password)){
							$data['password'] = $hashedPassword;
						}
						$result = Db::table('login')->where('id', 1)->update($data);
						if($result == 1){
							$response = array("status" => "success", "message" => "参数已更新");
							echo json_encode($response);
						}
								 
							   }
							   public function loginInfo()//用户登录记录
							   {

								$offset = $_GET['offset'];
								$limit = $_GET['limit'];


								if ($offset == '' || $limit == '') {
									$offset = 0;
									$limit = 10;
								}

								$result = Db::name('loginrecord')->limit($offset, $limit)->order('id DESC')->select();

								$count = Db::name('loginrecord')->count();

							
								$data = [];
							if (!empty($result)) {
								foreach ($result as $row) {
									$data[] = [
										'id' => $row['id'],
										'username' => $row['username'],
										'url' => $row['url'],
										'ip' => $row['ip'],
										'logintime' => $row['logintime'],
										'title' => $row['title']//标题
										
									];
								}
							}
								
								header('Content-Type: application/json');
								echo json_encode([
									'total' => $count,
									'rows' => $data
								]);	
						     
										 
										}

	public function checkUser(){

		$loginStatus = false;
		if(!empty($_SESSION['aid']) && !empty($_SESSION['expiretime']) && $_SESSION['expiretime'] >= time() ){
			$loginStatus = true;
		}
		$results = ['loginStatus'=>$loginStatus];
		$jsonResponse = json_encode($results);
		header('Content-Type: application/json');
		echo $jsonResponse;
	}
										
									
 
 
}