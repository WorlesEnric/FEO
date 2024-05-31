<?php
namespace app\index\controller;
use think\Controller;//引入Controller类
use think\Db;


class Yunxing extends AuthController
{
	public function yunxing()
		{
			$time = date('Y-m-d H:i:s', strtotime("-1 min"));
									
			$data = Db::name('d02')->where('time', '>=', $time)->select();
										
			$this->assign('data', $data);	
				
			return view();
			
			
			}
	
	
	}