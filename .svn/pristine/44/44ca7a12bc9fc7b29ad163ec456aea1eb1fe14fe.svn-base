<?php
require_once APPPATH."libraries/bucter/BT_msgHandle.php";

class BT_event extends BT_msgHandle{
	private function addMsgUser($weixin_user,$msg){
		return $weixin_user->addWeixinUser(array("wx_name"=>"","open_id"=>$msg["FromUserName"], "wx_msg_count"=>0,"wx_create_time"=>$msg["CreateTime"],"wx_update_time"=>$msg["CreateTime"]));
	}
	
	private function loadTextParse($name){
		if(file_exists(APPPATH."libraries/bucter/textmsgparse/".$name.".php")){
			require_once APPPATH."libraries/bucter/textmsgparse/".$name.".php";
			return new $name();
		}
		return false;
	}
	
	private function topic(&$msg){
		$parse=$this->loadTextParse("TM_topic");
		if($parse){
			$parse->parse($msg);
		}
	}
		
	private function subscribe(&$msg){
		$weixin_user=$this->loadModel("Weixin_User");
		$user_id=$weixin_user->getUserByOpenId($msg["FromUserName"]);
		if(!$user_id){
			$user_id=$this->addMsgUser($weixin_user,$msg);
		}
		$msg["MsgType"]="text";
		$msg["TopicType"]="欢迎关注";
		$msg["Topic"]="欢迎关注";
		$msg["TopicContent"]="";
		$this->topic($msg);
	}
	
	private function unsubscribe(&$msg){
		
	}
	
	public function handle(&$msg){
		$this->$msg['Event']($msg);
	}
}