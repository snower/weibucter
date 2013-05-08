<?php
require_once 'MB_base.php';
require_once 'MB_context.php';
require_once 'MB_mibotQueue.php';

class MB_mibot extends MB_base{
	private function isStop(){
		$kv = new SaeKV();
		$kv->init();
		$stop=$kv->get("weibucter_mibot_stop");
		return ($stop=="true");
	}
	
	public function start(){
		$taskQueue = new SaeTaskQueue("weibucter_mibot");
		foreach ($this->loadConfig()->getTasksConfig() as $mn=>$mb){
			$taskQueue->addTask("http://weibucter.sinaapp.com/mibot/task?task_name=".$mn);
		}
		
		$kv = new SaeKV();
		$kv->init();
		$kv->set("weibucter_mibot_stop","false");
		return $taskQueue->push();
	}
	
	public function stop(){
		$kv = new SaeKV();
		$kv->init();
		$kv->set("weibucter_mibot_stop","true");
	}
	
	private function runTask($context){
		$start_time=time();
		while (time()-$start_time<270){
			$url=$context->getUrls()->getOneUrl();
			if(!$url){
				$context->getUrls()->store();
				$context->getData()->store();
				if(!$context->getUrls()->load()){
					return false;
				}
				continue;
			}
			$parse=$context->getParse();
			$parse->parse($url);
		}
		return true;
	}
	
	public function task($name,$context_id=null){
		$config=$this->loadConfig()->getTaskConfig($name);
		$context= $context_id ? MB_context::loadContext($context_id) : MB_context::initContext($config);
		
		$mibot_queue=new MB_mibotQueue();
		$mibot_queue->load();
		$mibot_queue->add($name, $context);
		
		$end=!$this->runTask($context);
		$end = $end || $this->isStop();
		if($end){
			$context->getUrls()->store();
			$context->getData()->store();
			return false;
		}
		$context_id=$context->saveContext();
		$mibot_queue->remove($name);
		$mibot_queue->store();
		
		$taskQueue = new SaeTaskQueue("weibucter_mibot");
		$taskQueue->addTask("http://weibucter.sinaapp.com/mibot/task?task_name=".$name."&context_id=".$context_id);
		return $taskQueue->push();
	}
}