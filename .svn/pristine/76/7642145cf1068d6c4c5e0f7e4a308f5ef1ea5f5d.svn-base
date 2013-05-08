<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Weixin_User extends CI_Model{
	const TABLE_NAME="weixin_user";
	public $id;
	public $open_id;
	public $wx_name;
	public $wx_msg_count;
	public $wx_create_time;
	public $wx_update_time;
	
	private function setData($data){
		foreach ($data as $k=>$v){
			$this->$k=$v;
			$this->db->set($k,$this->$k);
		}
	}
	
	public function addWeixinUser($data){
		$this->setData($data);
		
		$this->db->insert(self::TABLE_NAME,$this);
		$this->id=$this->db->insert_id();
		return $this->id;
	}
	
	public function updateMsgById($id,$data){
		$this->setData($data);
		
		$this->db->where("id",$id);
		
		$this->db->update(self::TABLE_NAME);
		return $this->db->affected_rows();
	}
	
	public function getUserByOpenId($open_id){
		$this->db->where("open_id",$open_id);
		$query=$this->db->get(self::TABLE_NAME);
		
		if($query->num_rows() == 0) return false;
		$result=$query->result();
		foreach ($result[0] as $k=>$v){
			$this->$k=$v;
		}
		return $result;
	}
	
	public function deleteWeixinUser($name){
		
	}
}