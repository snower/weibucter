<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data_Finder extends CI_Model{
	const TABLE_NAME="data_finder";
	public $id;
	public $name;
	public $data;
	public $create_time;
	public $update_time;
	
	public function addData($name,$data){
		$this->name=$name;
		$this->data=$data;
		$this->create_time=time();
		$this->update_time=time();
		
		$this->db->set("name",$this->name);
		$this->db->set("data",serialize($this->data));
		$this->db->set("create_time",$this->create_time);
		$this->db->set("update_time",$this->update_time);
		
		$this->db->insert(self::TABLE_NAME);
		$this->id=$this->db->insert_id();
		return $this->id;
	}
	
	public function updateData($name,$data){
		$this->name=$name;
		$this->data=$data;
		$this->update_time=time();
		
		$this->db->set("data",serialize($this->data));
		$this->db->set("update_time",$this->update_time);
		
		$this->db->where("name",$this->name);
		
		$this->db->update(self::TABLE_NAME);
		return $this->db->affected_rows();
	}
	
	public function getData($name){
		$this->db->where("name",$name);
		$query=$this->db->get(self::TABLE_NAME);
		
		if($query->num_rows() == 0) return false;
		$result=$query->result();
		foreach ($result[0] as $k=>$v){
			if($k=="data"){
				$this->$k=unserialize($v);
			}
			else{
				$this->$k=$v;
			}
		}
		return $result;
	}
	
	public function deleteData($name){
		
	}
}