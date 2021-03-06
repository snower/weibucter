<?php
require_once APPPATH."libraries/mibot/MB_data.php";

class DT_jokeji extends MB_data{
	public function __construct(){
		parent::__construct();
		
		$this->model=$this->loadModel("jokeji_data");
	}
	
	public function saveData($data){
		$joke_id=md5($data["joke"]);
		$this->cache[$joke_id]=$data;
	}
	
	protected function storeData($data){
		$stores=$this->model->getJokeByJokeIds(array_keys($this->cache));
		if($stores){
			foreach ($stores as $v){
				unset($this->cache[$v->joke_id]);
			}
		}
		if(count($this->cache)>0){
			$this->model->addJokes($this->cache);
		}
		$this->cache=array();
	}
}