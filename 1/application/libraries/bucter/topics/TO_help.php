<?php
require_once APPPATH."libraries/bucter/BT_topic.php";

class TO_help extends BT_topic{
	const HELP_TEXT="使用说明：\r\n直接输入“话题名“将显示该话题下最新发表内容，不存在该话题则显示最新发表内容；\r\n\r\n直接输入”#话题名#话题内容“将直接把话题内容发表到该话题下，不存在该话题则创建话题;\r\n\r\n详细使用说明: http://weibucter.sinaapp.com/wiki/about";
	public function getReply(){
		$this->msg["Content"]=self::HELP_TEXT;
	}

	public function saveTopic(){
		return false;
	}
}