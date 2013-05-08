<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DF_dataFinder{
	private static $config=null;
	
	public function __construct(){
		if(!self::$config){
			self::$config=$this->loadConfig();
		}
	}
	
	private function loadConfig(){
		require_once 'DF_config.php';
		$config=&DF_config::getInstance();
		return $config;
	}
	
	private function loadFinder($name){
		if(file_exists(APPPATH."libraries/datafinder/finders/".$name.".php")){
			require_once APPPATH."libraries/datafinder/finders/".$name.".php";
			return new $name();
		}
		return false;
	}
	
	public function start(){
		$taskQueue = new SaeTaskQueue("weibucter_data_finder");
		foreach (self::$config->getFinderConfig() as $c=>$f){
			$taskQueue->addTask("http://weibucter.sinaapp.com/datafinder/finder?finder_name=".$c);
		}
		return $taskQueue->push();
	}
	
	public function finder($name){
		$finders=self::$config->getFinderConfig();
		if(array_key_exists($name, $finders)){
			$finder=$this->loadFinder($finders[$name]);
			if($finder){
				$finder->finder();
			}
		}
		return true;
	}
}
