<?php
require_once APPPATH."libraries/bucter/BT_topic.php";

class TO_hynh extends BT_topic{
	private function loadData(){
		$data_finder=$this->loadModel("data_finder");
		$data=$data_finder->getData("hynh");
		if($data){
			return $data_finder->data;
		}
		return array();
	}
	
	public function getReply(){
		$posts=$this->loadData();
		$r="";
		foreach ($posts as $p){
			$r=$r.$p["title"]."(http://www.student.buct.edu.cn/forum/".$p["href"]." )\r\n\r\n";
		}
		$this->msg["Content"]=$r."详细请看：\nhttp://www.student.buct.edu.cn/forum/index.aspx";
	}
	
	public function saveTopic(){
		return false;
	}
}