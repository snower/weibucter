<?php
require_once APPPATH."libraries/mibot/MB_parse.php";

class Ps_jokeji extends MB_parse{
	private function isJokeDetailPage($url){
		return preg_match("/http:\/\/www\.jokeji\.cn\/JokeHtml\/.+?\/\d+?\.htm/i", $url);
	}
	
	protected function findAllData($url,$content){
		if(!$this->isJokeDetailPage($url)) return array();
		$result=array();
		$category="";
		$name="";
		$joke="";
		if(preg_match("/<h1>.*?>(.*?)<\/.*?> -> <.*?>(.*?)<\/.*?> -> (.*?)<\/h1>/ims", $content,$result)){
			$category=$result[2];
			$name=$result[3];
		}
		if(preg_match("/<span id=\"text110\">(.+?)<\/span>/ims", $content,$result)){
		 	$joke=preg_replace("/<.+?>/ims", "", $result[1]);
		 	$joke=trim(html_entity_decode($joke));
		}
		return array(array("url"=>$url,"category"=>$category,"name"=>$name,"joke"=>$joke));
	}
}