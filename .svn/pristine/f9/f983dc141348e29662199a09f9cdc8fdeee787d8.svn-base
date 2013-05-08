<?php
require_once APPPATH."libraries/bucter/BT_topic.php";

class TO_topicList extends BT_topic{
	private function getLatestTopic(){
		$topic=$this->loadModel("topic");
		$topics=$topic->getLatestTopic();
		if($topics){
			$r="";
			foreach ($topics as $t){
				$r=$r."#".$t->name."#\r\n";
			}
			return $r;
		}
		return "谢谢关注北化人，北化人致力于打造北化人自己的微信公共平台，欢迎大家参与!";
	}
	
	public function getReply(){
		$this->msg["Content"]=$this->getLatestTopic();
	}

	public function saveTopic(){
		return false;
	}
}