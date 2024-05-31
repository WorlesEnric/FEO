<?php
namespace app\index\controller;
use think\Controller;//引入Controller类
use think\Db;


class F29xiaoku extends AuthController
{
	
	
	
	public function F29xiaokuquxian()
		{
	
			
				
				return view();
	
	 }
	 public function F29xiaokuquxianClick()
	 {
		 
		 
		 
		 $days = $_POST['days'];
		 $startTime = $_POST['startTime'];
		 
		 $endTime = date("Y-m-d", strtotime("$startTime  + $days day"));

		 $TemperatureData = Db::name('f29readplcxiaoku')
		 ->where('time','>',$startTime)
		 ->where('time','<',$endTime)
		 ->field('time,X11')
		 ->select();

		 $HumidityData = Db::name('f29readplcxiaoku')
		 ->where('time','>',$startTime)
		 ->where('time','<',$endTime)
		 ->field('time,X12')
		 ->select();
	 

		 return json([
			 'TemperatureData'=>$TemperatureData,      
			 'HumidityData'=>$HumidityData
			 
			
			 
			 
		 ]);
		}
	public function F29xiaokushishixianshi()
	{
				 $time = date('Y-m-d H:i:s', strtotime("2024-01-15 17:35:51"));
						
				 		$data = Db::name('f29readplcxiaoku')->where('time', '>=', $time)->select();
							
				 			$this->assign('data', $data);				
							 return view();	
	}

	
	public function F29xiaokubaobiao()
	{
		
						return view();
	}
	public function Click($page=1){
	        $requestData = $_POST['requestData']; 
	        $minute = $requestData['minute'];
	        $startTime = $requestData['startTime'];
	        $days = $requestData['days'];
	        $c = Db::table('form')->where('id',1)->field('searchStartTime')->select();
	        $d = $c[0]['searchStartTime'];       
	
	        // 判断执行的操作
	        if(isset($_POST['buttonId'])) {
	            $buttonId = $_POST['buttonId'];
	            if ($buttonId == 'firstDay') {
	                $c = Db::table('form')->where('id',1)->field('startTime')->select();
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
	        $listall = Db::name('f29readplcxiaoku')->where('time', '>', $searchStartTime)->where('time', '<', $searchEndTime)->where("minute(time) mod $minute=0")->field('time,X11,X12')->select();
	        $list = Db::name('f29readplcxiaoku')->where('time', '>', $searchStartTime)->where('time', '<', $searchEndTime)->where("minute(time) mod $minute=0")->field('time,X11,X12')->select();
	        if(count($list)!=0){
	            $pages=ceil(count($listall)/count($list));
	        }
        Db::table('form')
            ->where('id', 1)
            ->update([
                'startTime' => $startTime,
                'searchStartTime' => $searchStartTime,
                'days' => $days,
                'searchEndTime' => $searchEndTime
            ]);
	        
	        
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

	
	
	
