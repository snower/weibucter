<?php
require_once APPPATH."libraries/bucter/BT_msgHandle.php";

class BT_text extends BT_msgHandle{
	private function loadTextParse($name){
		if(file_exists(APPPATH."libraries/bucter/textmsgparse/".$name.".php")){
			require_once APPPATH."libraries/bucter/textmsgparse/".$name.".php";
			return new $name();
		}
		return false;
	}
	
	private function parseType(&$msg){
		$config=$this->loadConfig()->getTextMsgParseConfig();
		$content=$msg["Content"];
		$content=str_replace("＃","#",$content);
		$result=array();
		foreach ($config as $c=>$p){
			if(preg_match("/".$c."/ims",$content,$result)){
				$msg["TopicType"]=$c;
				$msg["Topic"]=$result[1];
				$msg["TopicContent"]=$result[2];
				$parse=$this->loadTextParse($p);
				if($parse){
					$parse->parse($msg);
				}
				return;
			}
		}
		$msg["Content"]="谢谢关注北化人，北化人致力于打造北化人自己的微信公共平台，欢迎大家参与!";
	}
	
	public function handle(&$msg){
		$this->parseType($msg);
	}
}