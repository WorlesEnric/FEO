<?php
//引入阿里云短信配置
include ('SMS/demo/sendSms.php');
include ('SMS/demo/sendSms3.php');


//链接数据库
$link = mysqli_connect("thbent020479.mysql.rds.aliyuncs.com", "root", "Sbnt020479","sdly");
mysqli_query($link,"set names utf8");

	$currentDate = date('Y-m-d');
	$currentDateTime = date('Y-m-d H:i:s');
	$currentTime = time();

	//对每天短信条数的处理
	$sql= "select * from prameter order by id desc limit 0,1;";
	$rt=mysqli_query($link,$sql);
	$last=mysqli_fetch_assoc($rt);
	$time = $last['alarmLastNum10'];
	if (strtotime($currentDate) != strtotime($time)) {
		$sqlPrameter = "update prameter set alarmLastNum8 = ? , alarmLastNum10 = ? ";
		$stmt = mysqli_prepare($link,$sqlPrameter);
		mysqli_stmt_bind_param($stmt,'is',$alarmLastNum8,$alarmLastNum10);
		$alarmLastNum8 = 0;
		$alarmLastNum10 = $currentDate;
		mysqli_stmt_execute($stmt);
	}
	
	//温度正常(之前有发送异常短信，现在温度刚正常)
	//$sql= "select * from prameter where t < tUp and t > tDown and h < hUp and h > hDown and alarmSmsNum > 0 ;";
	//可以发送短信的温湿度正常的数据（温湿度正常、可以发送短信、每天发送次数没超限）
	$sql= "select * from prameter where t <= tUp and t > tDown and h <= hUp and h > hDown and alarmSmsAccount2 = 1
		and alarmSmsNum > 0  and alarmLastNum8 < alarmLastNum9 ;";
	$rt=mysqli_query($link,$sql);
	$resultNormal=array();
	while($row=mysqli_fetch_assoc($rt)){
		$resultNormal[]=$row;
	}
	if($resultNormal){
		foreach($resultNormal as $item){
			//发送短信
			Sendsms3($item['telephone1'],$item['room'], $item['probe'], $item['t'], $item['h']);
			// 更新数据库
			$sqlPrameter = "update prameter set  alarmSmsNum = ? , 
			totalcount = ? , alarmLastNum8 = ?, daycount = ? where id = ? ";
			$stmt = mysqli_prepare($link,$sqlPrameter);
<<<<<<< HEAD
			mysqli_stmt_bind_param($stmt,'iiiiii',$alarmSmsNum,$totalcount,$alarmLastNum8,$daycount,$id);
=======
			mysqli_stmt_bind_param($stmt,'iiiii',$alarmSmsNum,$totalcount,$alarmLastNum8,$daycount,$id);
>>>>>>> 0ba6ac09756614366d15da3a4c04d6add12e442d
			
			$alarmSmsNum = 0;
			$totalcount = $item['totalcount'] + 1;
			$alarmLastNum8 = $item['alarmLastNum8'] + 1;
			$daycount = $item['daycount'] + 1;
			$id = $item['id'];
			mysqli_stmt_execute($stmt);
			
			$humidityStatus = '正常';
			$temperatureStatus = '正常';
			$sqlRecord = "insert into smsrecord set Time = ? , Probe = ? , Rome = ? , Temperature = ? 
			, Humidity = ? , TemperatureStatus = ? , HumidityStatus = ?";	
			$stmtRecord = mysqli_prepare($link,$sqlRecord);
			mysqli_stmt_bind_param($stmtRecord,'siiiiss',$time,$Probe,$Rome,$Temperature,$Humidity,$TemperatureStatus,$HumidityStatus);
			$time = $currentDateTime;
			$Probe = $item['probe'] ;
			$Rome = $item['room'] ;
			$Temperature = $item['t'] ;
			$Humidity = $item['h'] ;
			$TemperatureStatus = $temperatureStatus;
			$HumidityStatus = $humidityStatus;
			mysqli_stmt_execute($stmtRecord);
		}
	}

	//可以发送短信的温湿度异常的数据（温湿度异常、可以发送短信、异常发送次数没超限、每天发送次数没超限）
	$sql= "select * from prameter where (t > tUp or t < tDown or h > hUp or h < hDown) and alarmSmsAccount2 = 1  
		and alarmSmsNum < alarmSmsNumLimit and alarmLastNum8 < alarmLastNum9 ";
	$rt=mysqli_query($link,$sql);
	$result=array();
	while($row=mysqli_fetch_assoc($rt)){
		$result[]=$row;
	}
	if($result){
		foreach($result as $item){
			//间隔发送
			$haveSendDate = date('Y-m-d', strtotime($item['time']));
			if($currentDate == $haveSendDate && $item['spaceTime'] > 0 ){//今天发送过了，且有间隔时间
				$canSendTime = strtotime($item['time']. "+".$item['spaceTime']." min");
				$canSendDateTime = date('Y-m-d H:i:s', $canSendTime);
				if($currentDateTime <= $canSendDateTime){
					continue;
				}
			}
			//延迟发送
			if($item['delayTime'] > 0 && $item['alarmSmsAccount3'] == null){
				$canSendDateTime = date('Y-m-d H:i:s', strtotime("+".$item['delayTime']." min"));
				$sqlPrameter = "update prameter set alarmSmsAccount3 = ? where id = ? ";
				$stmt = mysqli_prepare($link,$sqlPrameter);
				mysqli_stmt_bind_param($stmt,'si',$alarmSmsAccount3,$id);
				$alarmSmsAccount3 = $canSendDateTime;
				$id = $item['id'];
				mysqli_stmt_execute($stmt);
				continue;
			}elseif($item['delayTime'] > 0 && $currentDateTime < $item['alarmSmsAccount3']){
				continue;
			}elseif($item['delayTime'] > 0 && $currentDateTime >= $item['alarmSmsAccount3']){
				$sqlPrameter = "update prameter set alarmSmsAccount3 = ? where id = ? ";
				$stmt = mysqli_prepare($link,$sqlPrameter);
				mysqli_stmt_bind_param($stmt,'si',$alarmSmsAccount3,$id);
				$alarmSmsAccount3 = null;
				$id = $item['id'];
				mysqli_stmt_execute($stmt);
			}

			//发送短信
           
			sendSms($item['telephone1'],$item['room'], $item['probe'], $item['t'], $item['h']);
			if ($item['h'] > $item['hUp'] || $item['h'] < $item['hDown']) {
				$humidityStatus = '湿度超出范围';
			} else {
				$humidityStatus = '正常';
			}
			if ($item['t'] > $item['tUp'] || $item['t'] < $item['tDown']) {
				$temperatureStatus = '温度超出范围';
			} else {
				$temperatureStatus = '正常';
			}
			// 更新数据库
			$sqlPrameter = "update prameter set  totalcount = ? , time = ? , 
			alarmSmsNum = ? , alarmLastNum8 = ?, daycount = ? where id = ? ";
			$stmt = mysqli_prepare($link,$sqlPrameter);
			mysqli_stmt_bind_param($stmt,'isiiii',$totalcount,$time,$alarmSmsNum,$alarmLastNum8,$daycount,$id);
			
			$totalcount = $item['totalcount'] + 1;
			$time = $currentDateTime;
			$alarmSmsNum = $item['alarmSmsNum'] + 1;
			$alarmLastNum8 = $item['alarmLastNum8'] + 1;
			$daycount = $item['daycount'] + 1;
			$id = $item['id'];
			mysqli_stmt_execute($stmt);
			
			$sqlRecord = "insert into smsrecord set Time = ? , Probe = ? , Rome = ? , Temperature = ? 
			, Humidity = ? , TemperatureStatus = ? , HumidityStatus = ?";	
			$stmtRecord = mysqli_prepare($link,$sqlRecord);
			mysqli_stmt_bind_param($stmtRecord,'siiiiss',$time,$Probe,$Rome,$Temperature,$Humidity,$TemperatureStatus,$HumidityStatus);
			$time = $currentDateTime;
			$Probe = $item['probe'] ;
			$Rome = $item['room'] ;
			$Temperature = $item['t'] ;
			$Humidity = $item['h'] ;
			$TemperatureStatus = $temperatureStatus;
			$HumidityStatus = $humidityStatus;
			mysqli_stmt_execute($stmtRecord);
		}
	}
	
