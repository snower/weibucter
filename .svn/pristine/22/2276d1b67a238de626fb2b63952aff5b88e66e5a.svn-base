<?php
require_once APPPATH."libraries/datafinder/DF_finder.php";

class FD_hynh extends DF_finder{
	protected $url='http://www.student.buct.edu.cn/forum/index.aspx';
	protected $name="hynh";
	
	private function parseLatestPosts(){
		$content=$this->getPageSource();
		$reg="/ul_hot_topics.*?ul/ims";
		$posts=array();
		if(preg_match($reg,$content,$posts)){
			$reg="/title=\"(.+?)\".+?href=\"(.+?)\"/ims";
			if(preg_match_all($reg,$posts[0],$posts)){
				$r=array();
				foreach ($posts[1] as $k=>$v){
					$r[]=array("title"=>$posts[1][$k],"href"=>$posts[2][$k]);
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