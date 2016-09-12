<?php 

	namespace Note\Controller;
	use Think\Controller;

	class noteGroups{
		public  $groupName;
		public  $groupNumber;
		public  $groupData=array();
	}
	
	class NoteController extends Controller{



		/**
		 * 取得用户分组 及个数
		 * 传参方式get
		 * 参数用户 id  admin_id
		 * 返回json字符串 data中是关联数组  key代表类别  values代表数目
		 * @return [type]           [description]
		 */
		public function getGroupsCount(){
			$admin_id = I('get.admin_id');
			if(!$admin_id || !is_numeric($admin_id)) {
				return  show (0,'数据格式错误');

			}
			else{
				$Admin = D('Admin');
				if($Admin->getAdminData($admin_id)){
					$Group = D('Group');
					$result=$Group->GroupsMsg($admin_id);		
					$Note = D('Note');
					$GroupsCount = array();
					foreach ($result as $key => $value) {

						$countRes =$Note->getGroupsCount($admin_id,$result[$key]);
						//$GroupsCount[$value] = $countRes;
						//if($noteResult=$Note->getNote($admin_id,$value)){
						//	$GroupsCount[$result[$key]."data"]=$noteResult;
						//}
						$noteGroups = new noteGroups();
						$noteGroups->groupName=$value;
						$noteGroups->groupNumber = $countRes;
						$noteGroups->groupData = $Note->getNote($admin_id,$value);
						//print_r($noteGroups->groupData);
						//var_dump($noteGroups);
						$GroupsCount[] = $noteGroups;
					}
					//$result=json_encode($GroupsCount);
					//print_r($result);
					//die();
					return show(1,'成功',$GroupsCount); 
				}
				else{
					return show(0,'用户不存在');
				}
			}
		}
		/**
		 * 取得笔记信息
		 * 传参方式    get
		 * 需要两个参数   admin_id   用户id
		 * note_group    用户笔记分组
		 * @return json字符串
		 */
		public function getNote(){
			$admin_id = I('get.admin_id');
			$note_group = I('get.note_group');
			if(!$admin_id || !is_numeric($admin_id) || !$note_group) {
				return  show (0,'数据格式错误');
			}else{
				$Admin = D('Admin');
				if($Admin->getAdminData($admin_id)){
					$Group = D('Group');
					$result = $Group->GroupsMsg($admin_id);
					if(!in_array($note_group, $result)){
						return show (0,'无该类别');
					}
					$Note = D('Note');

					$noteResult=$Note->getNote($admin_id,$note_group);
					if(!$noteResult){
						return show(0,'无数据');
					}
					return show(1,'成功',$noteResult);
				}
				else{
					return show(0,'用户不存在');
				}
			}
		}
			/**
			 * 添加/修改笔记
			 * 传参方式   POST
			 * 自动判断当传递的参数有note_id时进行笔记的修改
			 */
			public function addNote(){
				$data = I('post.');
				if(!$data['admin_id'] || !is_numeric($data['admin_id']) ) {
					return  show (0,'数据格式错误');
				}else{
					$Admin = D('Admin');
					if($Admin->getAdminData($data['admin_id'])){
						$Group = D('Group');
						$result = $Group->GroupsMsg($data['admin_id']);
						if(!isset($data['note_group']) || !$data['note_group']){
							$data['note_group'] = '生活杂记';
						}
						if(!in_array($data['note_group'], $result)){
							return show (0,'无该类别');
						}
						$Note = D('Note');
						if(!$Note->create($data)){
							return show(0,$Note->getError());
						}
						else{
							if(isset($data['note_id'])){
								$updateResult = $Note->updateNote($data);
								if(!$updateResult){
									return show(0,'修改失败');
								}
								return show(1,'成功');
							}
							$result=$Note->addNote($data);
							if(!$result){
								return show(0,'添加失败');
							}
							else return show(1,'成功');
						}
					}	
					else{
						return show(0,'用户不存在');
					}
				}
			}
			/**
			 * 删除笔记
			 * 传参方式   get
			 * 需要参数   note_id
			 * @return 规定json字符串
			 */
			public function dropNote(){
				$note_id = I('get.note_id');
				if(!$note_id || !is_numeric($note_id) ) {
					return  show (0,'数据格式错误');
				}else{
					$Note = D('Note');
					$result = $Note->dropNote($note_id);
					if(!$result){
						return show(0,'删除失败');
					}
					return show(1,'删除成功');
				}

			}


			public function getOpenNote(){
				$result = D('Note')->getOpenNote();
				var_dump($result);
				die();	
				return show(1,'成功',$result);
			}


		

	}



 ?>