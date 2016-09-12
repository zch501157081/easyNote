<?php 

	namespace Admin\Controller;
	use Think\Controller;

	class AdminController extends Controller{
		/**
		 * 登陆
		 * post
		 * admin_number 账号
		 * admin_password 密码
		 * @return [type] [description]
		 */
		public function login(){
			$admin_number = I('post.admin_number');
			$admin_password = I('post.admin_password');

			if(!trim($admin_number)){
				return show(0,'账号不能为空');
			}
			if(!trim($admin_password)){
				return show(0,'密码不能为空');
			}

			$result = D('Admin')->getAdminByNumber($admin_number);
			if(!$result){
				return show(0,'该用户不存在');
			}
			if($result['admin_password']!=getMd5Password($admin_password)){
				return show(0,'密码错误');
			}
			
			return show(1,'登陆成功',$result);
		}
		/**
		 * 
		 * 注册
		 * post
		 * 
		 * @return [type] [description]
		 */
		public function register(){
			if($_POST && !empty($_POST)){
				$Admin = D('Admin');
				$postData=I('post.');				
				if(!$Admin->create($postData)){
					return show(0,$Admin->getError());
				}else{
					
						$result = $Admin->registerByPost($postData);
						if(!$result){
						return show(0,'数据操作失败');
						}
						return show(1,'成功',$Admin->getAdminData($result));
					
				}
			}
			else{			
				return show(0,'参数错误');
			}
		}

		/**
		 * 修改个人信息
		 * @return [type] [description]
		 */
		public function editAdmin(){
			if($_POST){
				$Admin = D('Admin');
				$postData = I('post.');
				if(!$Admin->create($postData)){
					return show(0,$Admin->getError());
				}else{
					$result =  $Admin->editAdminData($postData);
					if(!$result){
						return show(0,'修改失败');
					}
					return show(1,'成功');
				}

			}else{
				return show(0,'参数错误');
			}
		}

		/**
		 * 取得个人信息
		 * @return [type] [description]
		 */
		public function getAdmin(){
			$admin_id = I('get.admin_id/d');
			if(!$admin_id || !is_numeric($admin_id)){
				return show(0,'数据异常');
			}
			else{
				$result = D('Admin')->getAdminData($admin_id);
				if(!$result){
					return show(0,'数据操作失败');
				}
				
				return show(1,'成功',$result);
			}

		}

		public function test(){
			var_dump($_GET);
			echo "55555555";
		}

	
	}

 ?>