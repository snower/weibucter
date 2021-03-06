<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Weixin extends CI_Controller {
	private function valid(){
		$this->load->library("weixin/WX_sign",array(
				"signature"=>$this->input->get("signature"),
				"timestamp"=>$this->input->get("timestamp"),
				"nonce"=>$this->input->get("nonce")
		),"weixin_sign");
		return $this->weixin_sign->valid();
	}
	
	public function index(){
		switch ($this->input->server("REQUEST_METHOD")){
			case "GET":
				$this->sign();
				break;
			case "POST":
				$this->msg();
				break;
			default:
				$this->sign();
		}
	}
	
	public function sign()
	{
		if($this->valid()){
			$this->output->set_output($this->input->get("echostr"));
		}
		else{
			$this->output->set_output("Access Deied!");
		}
	}
	
	public function msg(){
		if(!$this->valid()){
			$this->output->set_output("Access Deied!");
			return false;
		}
		$msg_xml=file_get_contents("php://input");
		$this->load->library("weixin/WX_weixin",'',"weixin");
		$this->output->set_content_type('text/xml');
        $this->output->set_output($this->weixin->msg($msg_xml));
	}
}
