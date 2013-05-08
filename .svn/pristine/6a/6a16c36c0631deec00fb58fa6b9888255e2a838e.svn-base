<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jokeji_Urls extends CI_Model{
	const TABLE_NAME="jokeji_urls";
	public $id;
	public $url_id;
	public $url;
	public $content;
	public $status;
	public $create_time;
	
	public function addUrl($url){
		$set=array(
			"url_id",md5($url),
			"url",$url,
			"content","",
			"status",1,
			"create_time",time()
		);
		
		$this->db->insert(self::TABLE_NAME,$set);
		return $this->db->insert_id();
	}
	
	public function addUrls($urls){
		$set=array();
		$time=time();
		foreach ($urls as $url){
			$set[]=array(
				"url_id"=>md5($url),
				"url"=>$url,
				"content"=>"",
				"status"=>1,
				"create_time"=>$time	
			);
		}
		return $this->db->insert_batch(self::TABLE_NAME,$set);
	}
	
	public function setContent($url_id,$content){
		$this->db->set("content",$content);
		
		$this->db->where("url_id",$url_id);
		
		$this->db->update(self::TABLE_NAME);
		return $this->db->affected_rows();
	}
	
	public function setContents($url_ids,$contents){
		$set=array();
		foreach ($url_ids as $k=>$v){
			$set[]=array("url_id"=>$url_ids[$k],"content"=>$contents[$k]);
		}
		$this->db->update_batch(self::TABLE_NAME,$set,"url_id");
		return $this->db->affected_rows();
	}
	
	public function setStatus($url_id,$status){
		$this->db->set("status",$status);
	
		$this->db->where("url_id",$url_id);
	
		$this->db->update(self::TABLE_NAME);
		return $this->db->affected_rows();
	}
	
	public function setStatuses($url_ids,$statuses){
		$set=array();
		foreach ($url_ids as $k=>$v){
			$set[]=array("url_id"=>$url_ids[$k],"status"=>$statuses[$k]);
		}
		return $this->db->update_batch(self::TABLE_NAME,$set,"url_id");
		return $this->db->affected_rows();
	}
	
	public function getUrlByUrlIds($url_ids){
		if(is_array($url_ids)){
			$this->db->where_in("url_id",$url_ids);
		}
		else{
			$this->db->where("url_id",$url_ids);
		}
		$query=$this->db->get(self::TABLE_NAME);
		
		if($query->num_rows() == 0) return false;
		if($query->num_rows() == 1 && !is_array($url_ids)){
			$result=$query->result();
			return $result[0];
		}
		return $query->result();
	}
	
	public function getNoFinishUrls($count=20,$order_by="asc"){
		$this->db->where("status",1);
		$this->db->order_by("create_time",$order_by);
		$this->db->limit($count);
		$query=$this->db->get(self::TABLE_NAME);
	
		if($query->num_rows() == 0) return false;
		return $query->result();
	}
}