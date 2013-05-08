<?php
class DF_finder{
	protected  $load;
	protected $url;
	protected $name;
	protected $data;
	
	public function __construct(){
		$this->load=&get_instance();
	}
	
	protected function loadLibrary($name,$config){
	
	}
	
	protected function loadModel($name){
		$this->load->load->model($name,"",TRUE);
		return $this->load->$name;
	}
	
	protected function getPageSource(){
		$f = new SaeFetchurl();
		$content=$f->fetch($this->url);
		if($content){
			$charset=array();
			if(preg_match("/<meta\s+?http-equiv=\"Content-Type\"\s*?content=\"text\/html;\s*?charset=(.*?)\"\s*?\/*?>/ims", $content,$charset)){
				$charset=$charset[1];
				if(strtolower($charset)!="utf-8"){
					$content=mb_convert_encoding($content,"utf-8",$charset);
				}
			}
		}
		return $content;
	}
	
	function finder(){
		
	}
	
	protected function saveData(){
		$data_finder=$this->loadModel("data_finder");
		if($data_finder->getData($this->name)){
			$data_finder->updateData($this->name,$this->data);
		}
		else{
			$data_finder->addData($this->name,$this->data);
		}
	}
}