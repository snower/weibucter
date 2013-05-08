<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Weixin_Msg extends CI_Model{
	const TABLE_NAME="weixin_msg";
	public $id;
	public $user_id;
	public $content;
	public $type;
	public $create_time;
	
	private function setData($data){
		foreach ($data as $k=>$v){
			$this->$k=$v;
			$this->db->set($k,$this->$k);
		}
	}
	
	public function addWeixinMsg($data){
		$this->setData($data);
		
		$this->db->insert(self::TABLE_NAME);
		$this->id=$this->db->insert_id();
		return $this->id;
	}
}