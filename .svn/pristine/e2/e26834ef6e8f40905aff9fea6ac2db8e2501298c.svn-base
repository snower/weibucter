<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jokeji_Data extends CI_Model{
	const TABLE_NAME="jokeji_data";
	public $id;
	public $url_id;
	public $url;
	public $category;
	public $name;
	public $joke_id;
	public $joke;
	public $joke_len;
	public $create_time;
	
	public function addJoke($url,$category,$name,$joke){
		$set=array(
			"url_id",md5($url),
			"url",$url,
			"category",$category,
			"name",$name,
			"joke_id",md5($joke),
			"joke",$joke,
			"joke_len",strlen($joke),
			"create_time",time()
		);
		
		$this->db->insert(self::TABLE_NAME,$set);
		return $this->db->insert_id();
	}
	
	public function addJokes($jokes){
		$set=array();
		$time=time();
		foreach ($jokes as $joke){
			$set[]=array(
					"url_id"=>md5($joke["url"]),
					"url"=>$joke["url"],
					"category"=>$joke["category"],
					"name"=>$joke["name"],
					"joke_id"=>md5($joke["joke"]),
					"joke"=>$joke["joke"],
					"joke_len"=>strlen($joke["joke"]),
					"create_time"=>$time
			);
		}
		return $this->db->insert_batch(self::TABLE_NAME,$set);
	}
	
	public function getJokeById($id){
		$this->db->where("id",$id);
		$query=$this->db->get(self::TABLE_NAME);
		
		if($query->num_rows() == 0) return false;
		if($query->num_rows() == 1){
			$result=$query->result();
			return $result[0];
		}
		return false;
	}
	
	public function getJokeByJokeIds($joke_ids){
		if(is_array($joke_ids)){
			$this->db->where_in("joke_id",$joke_ids);
		}
		else{
			$this->db->where("joke_id",$joke_ids);
		}
		$query=$this->db->get(self::TABLE_NAME);
	
		if($query->num_rows() == 0) return false;
		if($query->num_rows() == 1 && !is_array($joke_ids)){
			$result=$query->result();
			return $result[0];
		}
		return $query->result();
	}
	
	public function count($filter=array()){
		foreach($filter as $k=>$v){
			if(is_array($v)){
				$this->db->where_in($k,$v);
			}
			else{
				$this->db->where($k,$v);
			}
		}
		$query=$this->db->get(self::TABLE_NAME);
		return $query->num_rows();
	}
	
	public function getJokeByOffset($offset,$count=1,$filter=array()){
		foreach($filter as $k=>$v){
			if(is_array($v)){
				$this->db->where_in($k,$v);
			}
			else{
				$this->db->where($k,$v);
			}
		}
		$this->db->limit($count,$offset);
		$query=$this->db->get(self::TABLE_NAME);
		
		if($query->num_rows() == 0) return false;
		if($query->num_rows() == 1 && $count==1){
			$result=$query->result();
			return $result[0];
		}
		return $query->result();
	}
}