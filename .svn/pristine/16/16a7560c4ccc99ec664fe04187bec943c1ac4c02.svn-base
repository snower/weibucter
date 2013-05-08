<?php
require_once 'BT_base.php';

class BT_topic extends BT_base{
	protected $msg;
	protected $config;
	protected $indexReply;
	protected $indexStore;
	
	public function __construct(){
		parent::__construct();
		$this->indexReply=-1;
		$this->indexStore=-1;
	}
	
	public function nextReply(){
		$this->indexReply++;
		if($this->indexReply>=count($this->config)) return "";
		require_once APPPATH.'libraries/bucter/topics/'.$this->config[$this->indexReply].".php";
		$topic=new $this->config[$this->indexReply]();
		$topic->setConfig($this->msg,$this->config);
		$topic->setReplyIndex($this->indexReply);
		return $topic->getReply();
	}
	
	public function nextStore(){
		$this->indexStore++;
		if($this->indexStore>=count($this->config)) return "";
		require_once APPPATH.'libraries/bucter/topics/'.$this->config[$this->indexStore].".php";
		$topic=new $this->config[$this->indexStore]();
		$topic->setConfig($this->msg,$this->config);
		$topic->setStoreIndex($this->indexStore);
		return $topic->saveTopic();
	}
	
	public function getReply(){
		return $this->nextReply();
	}
	
	public function saveTopic(){
		return $this->nextStore();
	}
	
	public function setConfig(&$msg,$config){
		$this->msg=&$msg;
		$this->config=$config;
	}
	
	public function setReplyIndex($index){
		$this->indexReply=$index;
	}
	
	public function setStoreIndex($index){
		$this->indexStore=$index;
	}
}