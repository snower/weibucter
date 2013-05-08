<?php
require_once APPPATH."libraries/bucter/BT_topic.php";

class TO_joke extends BT_topic{
	private $jokeji;
	
	private function loadJokeji(){
		$this->jokeji=$this->loadModel("jokeji_data");
	}
	
	private function getOneRandomJoke(){
		$offset=rand(0, $this->jokeji->count(array("joke_len <"=>2000)));
		$joke=$this->jokeji->getJokeByOffset($offset,1,array("joke_len <"=>2000));
		if($joke){
			return $joke;
		}
		return null;
	}
	
	public function getReply(){
		$this->loadJokeji();
		$joke=$this->getOneRandomJoke();
		if($joke){
			$this->msg["Content"]=$joke->joke."\r\n\r\n来自：".$joke->url;
			return true;
		}
		$this->msg["Content"]="谢谢关注北化人，北化人致力于打造北化人自己的微信公共平台，欢迎大家参与!";
		return false;
	}
	
	public function saveTopic(){
		return false;
	}
}