<?php
require_once APPPATH."libraries/bucter/BT_topic.php";

class TO_looking extends BT_topic{
	private function getLatest(){
		$topic=$this->loadModel("Topic");
		$topic_content=$this->loadModel("Topic_Content");
		$tcs=$topic_content->getLatestTopicContent();
		if($tcs){
			$r="最新讨论：\r\n";
			foreach ($tcs as $tc){
				$name=$topic->getTopicById($tc->topic_id);
				if($name){
					$r=$r."#".$name[0]->name."#: ".$tc->content."\r\n\r\n";
				}
			}
			return $r;
		}
		return "谢谢关注北化人，北化人致力于打造北化人自己的微信公共平台，欢迎大家参与!";
	}
	
	public function getReply(){
		$this->msg["Content"]=$this->getLatest();
	}
	
	public function saveTopic(){
		return false;
	}
}