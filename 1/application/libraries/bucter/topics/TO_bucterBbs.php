<?php
require_once APPPATH."libraries/bucter/BT_topic.php";

class TO_bucterBbs extends BT_topic{
	private function loadData(){
		$data_finder=$this->loadModel("data_finder");
		$data=$data_finder->getData("bucterBbs");
		if($data){
			return $data_finder->data;
		}
		return array();
	}
	
	public function getReply(){
		$posts=$this->loadData();
		$r="";
		foreach ($posts as $i=>$p){
			if($i>=10) break;
			$r=$r.$p["title"]."(http://www.bucter.com/bbs/".$p["href"]." )\r\n\r\n";
		}
		$this->msg["Content"]=$r."详细请看：\nhttp://www.bucter.com/bbs/forum.php";
	}
	
	public function saveTopic(){
		return false;
	}
}