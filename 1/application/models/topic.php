<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Topic extends CI_Model{
	const TABLE_NAME="topic";
	public $id;
	public $name;
	public $parent;
	public $content_count;
	public $create_time;
	public $update_time;
	
	private function setData($data){
		foreach ($data as $k=>$v){
			$this->$k=$v;
			$this->db->set($k,$this->$k);
		}
	}
	
	public function addTopic($data){
		$this->setData($data);
	
		$this->db->insert(self::TABLE_NAME);
		$this->id=$this->db->insert_id();
		return $this->id;
	}
	
	public function updateTopicById($id,$data){
		$this->setData($data);
		
		$this->db->where("id",$id);
		
		$this->db->update(self::TABLE_NAME);
		return $this->db->affected_rows();
	}
	
	public function getTopicByName($name){
		$this->db->where("name",$name);
		$query=$this->db->get(self::TABLE_NAME);
		
		if($query->num_rows() == 0) return false;
		$result=$query->result();
		foreach ($result[0] as $k=>$v){
			$this->$k=$v;
		}
		return $result;
	}	
	
	public function getTopicById($id){
		$this->db->where("id",$id);
		$query=$this->db->get(self::TABLE_NAME);
		
		if($query->num_rows() == 0) return false;
		$result=$query->result();
		foreach ($result[0] as $k=>$v){
			$this->$k=$v;
		}
		return $result;
	}
	
	public function getLatestTopic($count=10){
		$this->db->order_by("update_time","desc");
		$this->db->limit($count);
		
		$query=$this->db->get(self::TABLE_NAME);
		
		if($query->num_rows() == 0) return false;
		$result=$query->result();
		foreach ($result[0] as $k=>$v){
			$this->$k=$v;
		}
		return $result;
	}
}