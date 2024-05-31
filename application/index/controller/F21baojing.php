<?php
namespace app\index\controller;

use think\Controller;//引入Controller类
use think\Db;
use think\Loader;
//将实时数据更新到d02parameter1表中

class F21baojing extends AuthController
{
   

	public function delete()
	{
        $id = $_POST['id'];
		 Db::table('f21parameter1')
        ->where('id',$id)
        ->delete();
       
		$result = array("status" => "success", "message" => "参数已更新");
        // 设置响应头，确保前端知道这是一个 JSON 格式的响应
        header('Content-Type: application/json');
        echo json_encode($result);
		
		
	}
	public function add()
	{
        $probe = $_POST['probe'];
        $tUp = $_POST['tUp'];
        $tDown = $_POST['tDown'];
        $hUp = $_POST['hUp'];
        $hDown = $_POST['hDown'];
        $telephone1 = $_POST['telephone1'];
        $telephone2 = $_POST['telephone2'];

        $alarmSmsNumLimit = $_POST['alarmSmsNumLimit'];
        $dayNumLimit = $_POST['dayNumLimit'];
        $delayTime = $_POST['delayTime'];
        $spaceTime = $_POST['spaceTime'];
		$data = [
            'SmsTime' => date("Y-m-d"),
            'dayNum' =>'0',
            'totalcount' =>'0',
            'alarmSmsNum' =>'0',
            'probe' => $probe,
            'room' => $probe,
            'tUp' => $tUp,
            'tDown' => $tDown,
            'hUp' => $hUp,
            'hDown' => $hDown,
            'telephone1' => $telephone1,
            'telephone2' => $telephone2,
            'alarmSmsNumLimit' => $alarmSmsNumLimit,
            'dayNumLimit' => $dayNumLimit,
            'delayTime' => $delayTime,
            'spaceTime' => $spaceTime
        ];
		Db::table('f21parameter1')->insert($data);
		$response = array("status" => "success", "message" => "参数已更新");
   // 设置响应头，确保前端知道这是一个 JSON 格式的响应
   header('Content-Type: application/json');


		// 将响应以JSON格式返回给前端
		echo json_encode($response);
      
     
      
	}
	
	public function f21baojing()
	{

		return view();
	}

	public function list()
	{
		$result = Db::table('f21parameter1')->field('id,probe,tUp,tDown,hUp,hDown,telephone1,telephone2,status,alarmSmsNumLimit,dayNumLimit,delayTime,spaceTime')->select();
		$response = [
			'rows' => $result

		];
		// 设置响应头，确保前端知道这是一个 JSON 格式的响应
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function shezhi()
	{



		$id = $_POST['id'];
		$probe = $_POST['probe'];
		$tUp = $_POST['tUp'];
		$tDown = $_POST['tDown'];
		$hUp = $_POST['hUp'];
		$hDown = $_POST['hDown'];
		$telephone1 = $_POST['telephone1'];
		$telephone2 = $_POST['telephone2'];

		$alarmSmsNumLimit = $_POST['alarmSmsNumLimit'];
		$dayNumLimit = $_POST['dayNumLimit'];
		$delayTime = $_POST['delayTime'];
		$spaceTime = $_POST['spaceTime'];

		 $loginTime = date('Y-m-d H:i:s');
			
		$host = $_SERVER['HTTP_HOST'];																			
		$uri = $_SERVER['REQUEST_URI'];										
		$url = "http://$host$uri";

		
		 $ip = $_SERVER['REMOTE_ADDR'];

		$data = [
						
			'logintime' => $loginTime,
			'url' => $url,
			'ip' => $ip,		
			'title' => "编辑"
		];
		Db::table('loginrecord')->insert($data);


	


		Db::table('f21parameter1')->where('id', $id)->update([
			'probe' => $probe,
			'tUp' => $tUp,
			'tDown' => $tDown,
			'hUp' => $hUp,
			'hDown' => $hDown,
			'telephone1' => $telephone1,
			'telephone2' => $telephone2,
			'alarmSmsNumLimit' => $alarmSmsNumLimit,
			'dayNumLimit' => $dayNumLimit,
			'delayTime' => $delayTime,
			'spaceTime' => $spaceTime
		]);



		$response = array("status" => "success", "message" => "参数已更新");



		// 将响应以JSON格式返回给前端
		echo json_encode($response);
	}
	
	public function smsSwitch()
	{
		$id = $_POST['id'];
		$smsSwitch = input('post.smsSwitch');
		Db::name('f21parameter1')->where('id', $id)->update(['status' => $smsSwitch]);
		
		// 构造一个包含参数的关联数组
		$response = array(
			'smsSwitch' => $smsSwitch
		);

		// 将数组转换为 JSON 格式
		$jsonResponse = json_encode($response);

		// 设置响应头，确保前端知道这是一个 JSON 格式的响应
		header('Content-Type: application/json');

		// 返回 JSON 格式的响应
		echo $jsonResponse;
	}




	public function jilu()
	{

		return view();

	}

	public function record()
	{
		

		$offset = $_GET['offset'];
		$limit = $_GET['limit'];


		if ($offset == '' || $limit == '') {
			$offset = 0;
			$limit = 10;
		}


		$result = Db::name('smsrecord')->limit($offset, $limit)->order('id DESC')->select();

		$count = Db::name('smsrecord')->count();


		$data = [];

		if (!empty($result)) {
			foreach ($result as $row) {
				// 将时间字符串转换为时间戳，并增加八小时
				$timeStamp = strtotime($row['Time']) + (8 * 3600);
				// 将增加了八小时的时间戳格式化为日期时间字符串
				$formattedTime = date('Y-m-d H:i:s', $timeStamp);
			
				$data[] = [
					'id' => $row['id'],
					'Temperature' => $row['Temperature'],
					'Humidity' => $row['Humidity'],
					'Probe' => $row['Probe'],
					'Rome' => $row['Rome'], // 保留拼写错误
					'Time' => $formattedTime, // 使用增加了八小时的时间字符串
					'TemperatureStatus' => $row['TemperatureStatus'],
					'HumidityStatus' => $row['HumidityStatus']
				];
			}
			
			
		}


		// 将数据转换为 JSON 格式并输出
		header('Content-Type: application/json');
		echo json_encode([
			'total' => $count,
			'rows' => $data
		]);

	}

}

