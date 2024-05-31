<?php
namespace app\index\controller;
use think\Controller;//引入Controller类
use think\Db;


class User extends Controller
{
    public function avatar()
    {
        $photo = $_FILES['photo']; // 获取上传的文件的信息
        
      
        // 获取上传文件的原始文件名
$filename = basename($photo["name"]);
$base_url = "http://test.thbent.com"; // 你的网站基础 URL
$avatar_path = "/tp5/public/avatars/" . $filename; // 用户头像相对路径
$avatar_url = $base_url . $avatar_path; // 构建完整的网络路径


$target_directory = $_SERVER['DOCUMENT_ROOT'] . "/tp5/public/avatars/";
//$new_photo_name = uniqid() . "_" . $filename;
$target_file = $target_directory . $filename;
move_uploaded_file($photo["tmp_name"], $target_file);

 Db::table('login')->where('id', 1)->update(['photourl' => $avatar_url]);

// 返回保存路径
$response = array(
    "target_directory" => $avatar_url // 将文件名拼接到目标路径上
   
);
        
        // 将数组转换为 JSON 格式
        $jsonResponse = json_encode($response);
        
        // 设置响应头，确保前端知道这是一个 JSON 格式的响应
        header('Content-Type: application/json');
        
        // 返回 JSON 格式的响应
        echo $jsonResponse;
        
        
    }
}
