<?php 
	namespace Admin\Controller;
	use Think\Controller;

	class GroupController extends Controller{

		/**
		 * 取得用户分组
		 * 传参方式get
		 * 参数  admin_id  用户id
		 * @return [type] [description]
		 */
		public function getGroups(){
			$admin_id = I('get.admin_id');
			if(!$admin_id || !is_numeric($admin_id)) {
				return  show (0,'数据格式错误');

			}
			else{
				$Admin = D('Admin');
				if($Admin->getAdminData($admin_id)){
					$Group = D('Group');
					$result=$Group->GroupsMsg($admin_id);				
					return show(1,'成功',$result);
				}
				else{
					return show(0,'用户不存在');
				}
			}
		}

		/**
		 * 添加分组
		 * 传参方式post
		 * 参数 admin_id
		 * group_name  分类名
		 */
		public function addGroups(){
			$admin_id =I('post.admin_id');
			$group_name = I('post.group_name');

			if($admin_id && $group_name){
				if(!$admin_id || !is_numeric($admin_id)) {
					return  show (0,'数据格式错误');
				}else{
					$Group = D('Group');
					$result = $Group->GroupsMsg($admin_id);
					if(in_array($group_name, $result)){
						return show (0,'类别已经存在');
					}
					$Admin=D('Admin');
					if($Admin->getAdminData($admin_id)){
						if(!$Group->addGroups($admin_id,$group_name)){
							return show(0,'添加失败');
						}
						return show(1,'成功');
					}
					else{
						return show(0,'用户不存在');
					}
				}	
			}else{
				return show(0,'数据不足');
			}
		}

		/**
		 * 删除分组
		 * get
		 * admin_id  用户id
		 * group_name 分类名称
		 * 注意的是系统会自动默认三个分类是无法删除的（已做判断） 
		 * '生活杂记','心情随笔','工作笔记'  
		 * @return [type] [description]
		 */
		public function dropGroup(){
			$admin_id =I('get.admin_id');
			$group_name = I('get.group_name');
			if(!$admin_id || !is_numeric($admin_id) || !$group_name) {
					return  show (0,'数据格式错误');
			}
			if(in_array($group_name,C('DEFAULT_GROUP'))){
				return show (0,'对不起,系统默认不能够删除');
			}
			$Admin=D('Admin');
			if($Admin->getAdminData($admin_id)){
				if(!D('Group')->dropGroup($admin_id,$group_name)){
					return show(0,'删除失败');
				}
				return show(1,'删除成功');
			}
			else{
				return show(0,'用户不存在');
			}
		}


	}


 ?>