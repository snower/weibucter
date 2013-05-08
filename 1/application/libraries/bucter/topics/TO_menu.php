<?php
require_once APPPATH."libraries/bucter/BT_topic.php";

class TO_menu extends BT_topic{
	const MENU_TEXT="菜单：获取所有菜单列表\r\n\r\n使用说明：获取使用说明\r\n\r\n话题：获取最热话题列表；\r\n\r\n详细使用说明: http://weibucter.sinaapp.com/wiki/about";
	public function getReply(){
		$this->msg["Content"]=self::MENU_TEXT;
	}
	
	public function saveTopic(){
		return false;
	}
}