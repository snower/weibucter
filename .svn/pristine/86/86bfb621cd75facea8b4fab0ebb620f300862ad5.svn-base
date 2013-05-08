<?php
require_once 'MB_base.php';

class MB_parse extends MB_base{
	protected $config;
	protected $data;
	protected $urls;
	
	public function __construct(){
		parent::__construct();
	}
	
	protected function loadSourcePage($url){
		$f = new SaeFetchurl();
		$content=$f->fetch($url);
		if($content){
			$this->urls->setContentOfUrl($url,$content);
			$charset=array();
			if(preg_match("/<meta\s+?http-equiv=\"Content-Type\"\s*?content=\"text\/html;\s*?charset=(.*?)\"\s*?\/*?>/ims", $content,$charset)){
				$charset=$charset[1];
				if(strtolower($charset)!="utf-8"){
					$content=mb_convert_encoding($content,"utf-8","gb2312");
				}
			}
		}
		return $content;
	}
	
	protected function getUrlInfo($url){
		$url_info=array();
		$result=array();
		if(preg_match("/^(http:\/\/)(.*?)(\/.*\/)(.*?)$/", $url,$result)){
			$url_info["protocol"]=$result[1];
			$url_info["domain"]=$result[2];
			$url_info["path"]=$result[3];
			$url_info["name"]=$result[4];
		}elseif (preg_match("/^(http:\/\/)(.*?)(\/)(.*?)$/", $url,$result)){
			$url_info["protocol"]=$result[1];
			$url_info["domain"]=$result[2];
			$url_info["path"]=$result[3];
			$url_info["name"]=$result[4];
		}elseif (preg_match("/^(http:\/\/)(.*?)(\/)$/", $url,$result)){
			$url_info["protocol"]=$result[1];
			$url_info["domain"]=$result[2];
			$url_info["path"]=$result[3];
			$url_info["name"]="";
		}elseif (preg_match("/^(http:\/\/)(.*?)$/", $url,$result)){
			$url_info["protocol"]=$result[1];
			$url_info["domain"]=$result[2];
			$url_info["path"]="/";
			$url_info["name"]="";
		}
		return $url_info;
	}
	
	protected function getRealUrl($url_info,$url){
		if(preg_match("/^http:\/\/".$url_info["domain"]."\/.+?$/", $url)){
			$url=$url;
		}elseif(preg_match("/^(?!http:\/\/)\/.+?$/", $url)){
			$url=$url_info["protocol"].$url_info["domain"].$url;
		}elseif(preg_match("/^(?![(http:\/\/)(\/)(javascript:)]).+?$/", $url)){
			$url=$url_info["protocol"].$url_info["domain"].$url_info["path"].$url;
		}else {
			return false;
		}
		$url_items=preg_split("/\//", $url);
		$url=array();
		foreach($url_items as $v){
			if($v==".."){
				array_pop($url);
			}
			else{
				array_push($url,$v);
			}
		}
		$url=implode('/',$url);
		return $url;
	}
	
	protected function findAllNewUrls($url,$content){
		$hrefs=array();
		$url_info=$this->getUrlInfo($url);
		if(preg_match_all("/href=\"(.*?)\"/ims", $content,$hrefs)){
			$urls=array();
			foreach ($hrefs[1] as $url){
				$url=$this->getRealUrl($url_info, $url);
				if($url){
					$urls[]=$url;
				}
			}
			return $urls;
		}
		return array();
	}
	
	protected function matchUrl($url){
		$match_urls=$this->config["match_urls"];
		foreach ($match_urls as $match){
			if(preg_match("/".$match."/i", $url)){
				return true;
			}
		}
		return false;
	}
	
	protected function matchAllUrls($urls){
		foreach ($urls as $url){
			if($this->matchUrl($url)){
				$this->urls->addUrl($url);
			}
		}
	}
	
	protected function findAllData($url,$content){
		return false;
	}
	
	public function parse($url){
		$content=$this->loadSourcePage($url);
		if($content){
			$urls=$this->findAllNewUrls($url,$content);
			if($urls){
				$this->matchAllUrls($urls);
			}
			$data=$this->findAllData($url,$content);
			if($data){
				$this->data->save($data);
			}
			$this->urls->setFinishOfUrl($url);
		}
	}
	
	public function setConfig(&$config){
		$this->config=$config;
	}
	
	public function setData(&$data){
		$this->data=$data;
	}
	
	public function setUrls(&$urls){
		$this->urls=$urls;
	}
	
	public function serialize(){
		return "";
	}
	
	public function unserialize($str){
	}
}