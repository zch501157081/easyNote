<?php

	namespace Common\Model;
	use Think\Model;

	class NoteModel extends Model{

			protected $_validate = array(
			array('note_title','require','题目必须',1),
     		array('note_title','0,30','题目长度不符合',0,'length'), // 在新增的时候验证name字段长
     		array('note_content','0,1000','内容长度不符合！',0,'length'),
     		array('note_status',array(-1,0,1,2),'状态码错误',0,'in'),
   			);

		public function getGroupsCount($admin_id,$group_name){
			return $this->where('admin_id='.$admin_id.' and note_group="'.$group_name .'"')->Count('note_id');
		}

		public function getNote($admin_id,$note_group){
			$data =  array('admin_id' =>$admin_id ,
							'note_group'=>$note_group
			 );
			$result = $this->where($data)->select();
			foreach ($result as $key => $value) {
				if($result[$key] ){
					$result[$key]['note_createtime']=getDatastamp($result[$key]['note_createtime']);
					$result[$key]['note_modifytime']=getDatastamp($result[$key]['note_modifytime']);
				}
			}
			
			//var_dump($this->getLastSql());
			return $result;
		}

		public function addNote($data){
			return $this->add($data);

		}

		public function updateNote($data){
			return $this->save($data);
		}

		public function dropNote($note_id){
			return $this->delete($note_id);
		}

		public function getOpenNote(){
			return $this->where('note_status=-1')->select();
		}
	}

 ?>