<?php
require_once "BT_base.php";

class BT_msg extends BT_base{
	private $weixin_user;
	private $weixin_msg;
	
	public function __construct(){
		parent::__construct();
		
		$this->weixin_user=$this->loadModel("Weixin_User");
		$this->weixin_msg=$this->loadModel("Weixin_Msg");
	}
	
	private function addMsgUser($msg){
		return $this->weixin_user->addWeixinUser(array("wx_name"=>"","open_id"=>$msg["FromUserName"], "wx_msg_count"=>0,"wx_create_time"=>$msg["CreateTime"],"wx_update_time"=>$msg["CreateTime"]));
	}
	
	public function saveMsg($msg){
		$user_id=$this->weixin_user->getUserByOpenId($msg["FromUserName"]);
		if(!$user_id){
			$user_id=$this->addMsgUser($msg);
		}
		$this->weixin_msg->addWeixinMsg(array("user_id"=>$this->weixin_user->id,"content"=>serialize($msg),"type"=>$msg["MsgType"],"create_time"=>$msg["CreateTime"]));
		$this->weixin_user->updateMsgById($this->weixin_user->id,array("wx_msg_count"=>$this->weixin_user->wx_msg_count+=1,"wx_update_time"=>$msg["CreateTime"]));
		return $this->weixin_msg->id;
	}
}