<?php
require_once APPPATH."libraries/datafinder/DF_finder.php";

class FD_bucterBbs extends DF_finder{
	protected $url='http://www.bucter.com/bbs/forum.php';
	protected $name="bucterBbs";
	
	private function parseLatestPosts(){
		$content=$this->getPageSource();
		$reg="/portal_block_19_content.*?<\/ul>/ims";
		$posts=array();
		if(preg_match($reg,$content,$posts)){
			$reg="/<em>.*?target=\"_blank\">(.*?)<\/a><\/em>.*?href=\"(.+?)\".+?title=\"(.+?)\"/ims";
			if(preg_match_all($reg,$posts[0],$posts)){
				$r=array();
				foreach ($posts[3] as $k=>$v){
					$r[]=array("title"=>$v,"href"=>$posts[2][$k],"author"=>$posts[1][$k]);
				}
				return $r;
			}
		}
		return array();
	}
	
	public function finder(){
		$this->data=$this->parseLatestPosts();
		if($this->data){
			$this->saveData();
		}
	}
}