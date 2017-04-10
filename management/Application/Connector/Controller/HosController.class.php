<?php
namespace Connector\Controller;

use Think\Controller;

class HosController extends Controller{
	
	public function hosinfo(){
		$model = D('hospital_info');
		//$sql = "select * from message where id>'$maxID'";
		$res = $model->order('hos_id desc')->select();
		//dump($res);
//		$qry = mysql_query($sql);
//		//把一维信息变成二维
//		$info = array();
//		while($rst = mysql_fetch_assoc($qry)){
//			$info[]=$rst;
//		}
//	
		echo json_encode($res);
	}
	
	public function reg(){
		if(!$_POST['user_phone']||!$_POST['user_password']) {
			$res['result']=0;
			$res['data']="手机号码或者密码不能为空";
		}else{
			$model = D('user_info');
			$data['user_phone']=$_POST['user_phone'];
			// 用户注册之前先对密码加密
			$data['user_password']=md5($_POST['user_password'].C('MD5_KEY'));
			//用户名生成随机字符串
			$name = new \Org\Util\String();
			$data['user_name']=$name->randString(6,5);
			$data['user_time']=date('Y-m-d H:i:s');
			$findmess['user_phone']=$_POST['user_phone'];
			$user=$model->where($findmess)->find();
			//先判断该手机是否注册过
			if ($user) {
				//User exists
				$res['result']=0;
				$res['data']="该手机号已经被注册";
			}else{
				//No user exists
				$addres=$model->add($data);
				$res['result']=1;
				$res['data']="恭喜注册成功";
			}
		}
		echo json_encode($res);
	}
	
	
}