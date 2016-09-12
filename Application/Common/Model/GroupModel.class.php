<?php 

	namespace Common\Model;
	use Think\Model;

	class GroupModel extends Model{


		public function GroupsMsg($admin_id){
			$Groups= C('DEFAULT_GROUP');
			$result = $this->where('admin_id='.$admin_id)->getField('group_name',true);
			if($result){
				$Groups=array_merge($Groups,$result);
			}
			return $Groups;
		
		}

		public function addGroups($admin_id,$group_name){
			$data =  array('admin_id' =>$admin_id ,'group_name'=>$group_name );
			return $this->add($data);
		}	

		public function dropGroup($admin_id,$group_name){
			//return $this->delete($data);
			return $this->where('admin_id='.$admin_id.' and group_name="'.$group_name .'"')->delete();
		}
	}


 ?>