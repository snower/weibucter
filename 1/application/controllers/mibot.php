<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mibot extends CI_Controller {
	public function start(){
		$this->load->library("mibot/MB_mibot","","mibot");
		$tasks=$this->mibot->start();
		$this->output->set_output('{"error":0,"time":'.time().',"tasks":'.json_encode($tasks).'}');
	}
	
	public function stop(){
		$this->load->library("mibot/MB_mibot","","mibot");
		$tasks=$this->mibot->stop();
		$this->output->set_output('{"error":0,"time":'.time()."}");
	}
	
	public function task(){
		$this->load->library("mibot/MB_mibot","","mibot");
		$task_name=$this->input->get("task_name");
		$context_id=$this->input->get("context_id");
		$this->mibot->task($task_name,$context_id);
		$this->output->set_output('{"error":0,"time":'.time().',"task_name":"'.$task_name.'"}');
	}
	
	public function error(){
		$this->output->set_output('{"error":1,"time":'.time().'}');
	}
}