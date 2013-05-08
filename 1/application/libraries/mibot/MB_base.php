<?php
class MB_base{
	protected  $load;
	public function __construct(){
		$this->load=&get_instance();
	}
	
	protected function loadLibrary($name,$config){
	
	}
	
	protected function loadModel($name){
		$this->load->load->model($name,"",TRUE);
		return $this->load->$name;
	}
	
	protected function loadConfig(){
		static $config=null;
		if(!$config){
			require_once 'MB_config.php';
			$config=&MB_config::getInstance();
		}
		return $config;
	}
}