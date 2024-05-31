<?php
namespace app\index\controller;
use think\Controller;//引入Controller类
use think\Db;


class Index extends Controller
{
	
	
	public function login()
	{
	            return view();
	         }
	     
	         public function check(){
	             $user=$_POST['username'];
	             $pwd=$_POST['password'];
			
	             if($user=='admin' && $pwd=='123'){
					 
	                 return $this->fetch();
	              
	               
	             }else{
	                 $this->error('登陆失败');
	             }
	         }

			 public function user()
			 {
						 return view();
					  }
				  
	

 
 
 
}