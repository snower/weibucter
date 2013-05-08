<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Topic_Content extends CI_Model{
	const TABLE_NAME="topic_content";
	public $id;
	public $topic_id;
	public $user_id;
	public $content;
	public $create_time;
	
	private function setData($data){
		foreach ($data as $k=>$v){
			$this->$k=$v;
			$this->db->set($k,$this->$k);
		}
	}
	
	public function addTopicContent($data){
		$this->setData($data);
	
		$this->db->insert(self::TABLE_NAME);
		$this->id=$this->db->insert_id();
		return $this->id;
	}
	
	public function getLatestTopicContent($id=null,$count=10){
		if($id) $this->db->where("topic_id",$id);
		$this->db->order_by("create_time","desc");
		$this->db->limit($count);
		
		$query=$this->db->get(self::TABLE_NAME);
		if($query->num_rows() == 0) return false;
		return $query->result();
	}
}