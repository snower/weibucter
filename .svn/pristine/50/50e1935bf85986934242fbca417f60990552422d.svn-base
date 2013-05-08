<?php
require_once 'MB_base.php';

class MB_mibotQueue extends MB_base{
	private $queue=array();
	
	public function load(){
		$kv = new SaeKV();
		$kv->init();
		$data=$kv->get("weibucter_mibot_queue");
		$this->queue=unserialize($data);
	}
	
	public function add($name,$context){
		$this->queue[$name]=$context;
	}
	
	public function remove($name){
		if(array_key_exists($name, $this->queue)){
			unset($this->queue[$name]);
		}
	}
	
	public function store(){
		$kv = new SaeKV();
		$kv->init();
		$kv->set("weibucter_mibot_queue",serialize($this->queue));
	}
}