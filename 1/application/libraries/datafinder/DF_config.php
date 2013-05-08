<?php
class DF_config{
	private static $instance=null;
	private $finder_config=array(
			"hynh"=>"FD_hynh",
			"jiaowu"=>"FD_jiaowu",
			"bucterBbs"=>"FD_bucterBbs"
	);
	
	public static function getInstance(){
		if(!self::$instance){
			self::$instance=new DF_config();
		}
		return self::$instance;
	}
	
	public function getFinderConfig(){
		return $this->finder_config;
	}
}