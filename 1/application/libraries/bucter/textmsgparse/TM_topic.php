<?php
require_once APPPATH."libraries/bucter/BT_textParse.php";

class TM_topic extends BT_textParse{
	private function loadTopic(){
		require_once APPPATH."libraries/bucter/BT_topic.php";
		return new BT_topic();
	}
	
	private function parseConfig($topic){
		$config=$this->loadConfig()->getTopicsConfig();
		$topics=array();
		foreach ($config as $c=>$p){
			if(preg_match("/".$c."/ims", $topic)){
				$topics=array_merge($topics,$p);
			}
		}
		return $topics;
	}
	
	public function parse(&$msg){
		$topic=$this->loadTopic();
		$topic->setConfig($msg,$this->parseConfig($msg["Topic"]));
		return $topic->getReply();
	}
}