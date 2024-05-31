<?php
namespace app\index\controller;
use think\Controller;//引入Controller类
use think\Db;


class D02 extends AuthController
{

    public function d02baojing()
    {


        return view();

    }
	
	public function d02quxian()
		{
			
				
				return view();
	
	 }
	 public function d02quxianClick()
		{
			
			
			
			$days = $_POST['days'];
			$startTime = $_POST['startTime'];
			
			$endTime = date("Y-m-d", strtotime("$startTime  + $days day"));

			$TemperatureData = Db::name('d02')
			->where('time','>',$startTime)
			->where('time','<',$endTime)
			->field('time,X11,X13,X15,X17')
			->select();

			$HumidityData = Db::name('d02')
			->where('time','>',$startTime)
			->where('time','<',$endTime)
			->field('time,X12,X14,X16,X18')
			->select();
		

			return json([
	            'TemperatureData'=>$TemperatureData,      
	            'HumidityData'=>$HumidityData
				
	           
				
	            
	        ]);
	
	 }
	public function d02shishixianshi()
	{
				 $time = date('Y-m-d H:i:s', strtotime("-1 min"));
						
				 		$data = Db::name('d02')->where('time', '>=', $time)->select();
							
				 			$this->assign('data', $data);				
							 return view();	
	}

	
	public function d02baobiao()
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
	        $listall = Db::name('d02')->where('time', '>', $searchStartTime)->where('time', '<', $searchEndTime)->where("minute(time) mod $minute=0")->field('time,X11,X12,X13,X14,X15,X16,X17,X18')->select();                 
	        $list = Db::name('d02')->where('time', '>', $searchStartTime)->where('time', '<', $searchEndTime)->where("minute(time) mod $minute=0")->field('time,X11,X12,X13,X14,X15,X16,X17,X18')->select();
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

	
	
	
