<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class datafinder extends CI_Controller {
	public function start(){
		$this->load->library("datafinder/DF_dataFinder","","datafinder");
		$finders=$this->datafinder->start();
		$this->output->set_output('{"error":0,"time":'.time().',"finders":'.json_encode($finders).'}');
	}
	
	public function finder(){
		$this->load->library("datafinder/DF_dataFinder","","datafinder");
		$finder_name=$this->input->get("finder_name");
		$this->datafinder->finder($finder_name);
		$this->output->set_output('{"error":0,"time":'.time().',"finder_name":"'.$finder_name.'"}');
	}
	
	public function error(){
		$this->output->set_output('{"error":1,"time":'.time().'}');
	}
}