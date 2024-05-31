<?php
namespace app\index\controller;
use think\Controller;//引入Controller类
use think\Db;


class F29 extends Controller
{
	
	
	
	public function f29quxian()
		{
	$time = date('Y-m-d H:i:s', strtotime("-1 min"));
	$data = Db::name('f29')->where('time', '>=', $time)->select();
	
	
					
	
	$this->assign('data', $data);
			
				
				return view();
	
	 }
	public function f29shishixianshi()
	{
				 $time = date('Y-m-d H:i:s', strtotime("2023-12-18 14:14:57"));
						
				 		$data = Db::name('f29')->where('time', '>=', $time)->select();
							
				 			$this->assign('data', $data);				
							 return view();	
	}

	
	public function f29baobiao()
	{
		
						return view();
	}
	public function Click($page=1){
	        $requestData = $_POST['requestData']; 
	        $minute = $requestData['minute'];
	        $startTime = $requestData['startTime'];
	        $days = $requestData['days'];
	        $c = Db::table('prameter')->where('id',1)->field('searchStartTime')->select();
	        $d = $c[0]['searchStartTime'];       
	
	        // 判断执行的操作
	        if(isset($_POST['buttonId'])) {
	            $buttonId = $_POST['buttonId'];
	            if ($buttonId == 'firstDay') {
	                $c = Db::table('prameter')->where('id',1)->field('startTime')->select();
	                $d = $c[0]['startTime'];
	                $searchStartTime = $d;          
	               
	            } elseif ($buttonId == 'backDay') {
	                $searchStartTime = date("Y-m-d H:i:s", strtotime("$d- $days day"));                      
	                if(strtotime($searchStartTime) < strtotime($startTime)){
	                    $searchStartTime = $startTime;            
	                }
	               
	            } elseif ($buttonId == 'nextDay') {
	                $searchStartTime = date("Y-m-d H:i:s", strtotime("$d+ $days day"));                      
	              
	            } else {
	                $searchStartTime = $startTime;                          
	               
	            }
	        } else {
	            $searchStartTime = $startTime;                          
	           
	        }
	
	        $searchEndTime = date('Y-m-d', strtotime("$searchStartTime +$days day"));   
	        $listall = Db::name('f29')->where('time', '>', $searchStartTime)->where('time', '<', $searchEndTime)->where("minute(time) mod $minute=0")->field('time,X11,X12,X13,X14,X15,X16,X17,X18,X19,X20,X21,X22,X23,X24')->select();                 
	        $list = Db::name('f29')->where('time', '>', $searchStartTime)->where('time', '<', $searchEndTime)->where("minute(time) mod $minute=0")->field('time,X11,X12,X13,X14,X15,X16,X17,X18,X19,X20,X21,X22,X23,X24')->select();
	        if(count($list)!=0){
	            $pages=ceil(count($listall)/count($list));
	        } 
	        Db::table('prameter')->where('id', 1)->update(['startTime' => $startTime]);
	        Db::table('prameter')->where('id', 1)->update(['searchStartTime' => $searchStartTime]);
	        Db::table('prameter')->where('id', 1)->update(['days' => $days]);
	        Db::table('prameter')->where('id', 1)->update(['searchEndTime' => $searchEndTime]);
	        
	        
	        return json([
	            'minute'=>$minute,
	           
	            'searchStartTime'=>$searchStartTime,
	            'searchEndTime'=>$searchEndTime,
	            'requestData'=>$requestData,
	            'data' => $list,
	            'pages'=>$pages
	        ]);
	    }
	
	
	
	
}

	
	
	
