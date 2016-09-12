<?php 
	namespace Common\Model;
	use Think\Model;




	class AdminModel extends Model{
		//protected $_db = '';
		//
		
		protected $_validate = array(
			array('admin_number','checkPwd','账号格式不正确',0,'function'), // 自定义函数验证密码格式
     		array('admin_number','','帐号名称已经存在！',0,'unique',1),
     		array('admin_password','checkPwd','密码格式不正确',0,'function'), // 自定义函数验证密码格式
     		array('admin_name','2,16','名字长度不符合',1,'length'),
     		array('admin_age',array(1,100),'你是妖怪吗',0,'between'),
     		array('admin_sex',array(0,1),'你是人妖吗',0,'in'),
   			);

		// public function __construct(){
		// 	$this->_db = M('Admin');
		// 	parent::__construct();
		// }
		public function getAdminByNumber($admin_number){
			$result=$this->where('admin_number="'.$admin_number.'"')->find();
			if($result){
				$result['admin_time'] = getDatastamp($result['admin_time']);
			}
			return $result;
		}

		public function registerByPost($postData){
			$data=array();
			foreach ($postData as $key => $value) {
				if($key === 'admin_password'){
					$data[$key] = getMd5Password($value);
				}
				else{
			 		$data[$key] = $value;
			 	}
			 }
				$result = $this->add($data);			
			return $result;
		}

		public function getAdminData($admin_id){
			$result= $this->where('admin_id='.$admin_id)->find();
			if($result){
				$result['admin_time'] = getDatastamp($result['admin_time']);
			}
			return $result;
		}

		public function editAdminData($editAdminData){
			$result = $this->save($editAdminData);
			return $result;
		}



	}
 ?>