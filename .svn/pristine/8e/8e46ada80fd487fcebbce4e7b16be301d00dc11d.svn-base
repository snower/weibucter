<?php
require_once 'MB_base.php';

class MB_Data extends MB_base{
	protected $config;
	protected $model;
	protected $cache=array();
	
	public function __construct(){
		parent::__construct();
	}
	
	protected function saveData($data){
		$data_id=md5($data);
		$this->cache[$data_id]=$data;
	}
	
	public function save($data){
		if(is_array($data)){
			foreach ($data as $d){
				$this->saveData($d);
			}
		}
		else{
			$this->saveData($data);
		}
	}
	
	protected function storeData(&$data){
		foreach ($data as $d){
			$this->model->addData($d);
		}
	}
	
	public function store(){
		if(count($this->cache)>0){
			$this->storeData($this->cache);
		}
		$this->cache=array();
	}
	
	public function setConfig(&$config){
		$this->config=$config;
	}
	
	public function serialize(){
		return serialize($this->cache);
	}
	
	public function unserialize($str){
		$this->cache=unserialize($str);
	}
}