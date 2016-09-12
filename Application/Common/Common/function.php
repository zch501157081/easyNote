<?php 

	function show($status,$msg,$data=array()){
		$result = array(
			'status' => $status,
			'msg' => $msg,
			'data' => $data,
		);
		exit(json_encode($result,JSON_UNESCAPED_UNICODE));
	}

	function getMd5Password($password){
		return md5($password.C('MD5_PRE'));
	}

	function getDatastamp($data){
		return strtotime($data);
	}

	function checkPwd($admin_password){
		if(!preg_match('/^[a-zA-Z_\-.\w]{6,16}$/', $admin_password)){
			return false;
		}else{
			return true;
		}
	}	

 ?>