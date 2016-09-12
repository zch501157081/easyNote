<?php 
	
	namespace Note\Controller;
	use Think\Controller;

	class DownloadController extends Controller{
		public function upload(){
			//var_dump($_POST);
			$config = array(
				'maxSize' => 3145728,
				'rootPath' => './Public/uploads/',
				'savePath' =>  '',
				'savename' => array('uniqid',''),
				'exts'     => array('jpg','gif','png','jpeg'),
				//'autoSub'  => true,
				//'subName'  =>array('data','Ymd'),
 			);
 			$upload = new \Think\Upload($config); //实例化上传类
 			//var_dump($upload);
 			$info =$upload ->upload();
 			if(!$info){
 				return show(0,$upload->getError());
 			}
 			else{
 				foreach ($info as $file) {
 					return  show(1,'成功',array('path'=>'/'.$file['savepath'].$file['savename']));
 				}
 			}
		}

		// public function test(){
		// 	$imgurl='./Public/upload/2016-09-09/57d2711ba5b0c.jpg';
		// 	header('content-type: image/jpg'); 
		// 	echo file_get_contents($imgurl);
		// }
	}


 ?>