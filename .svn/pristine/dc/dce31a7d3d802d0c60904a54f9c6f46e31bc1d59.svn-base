<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WX_weixin{
	private $ci;
	private $bucter;
	public function __construct(){
		$this->ci=&get_instance();
		$this->ci->load->library("weixin/WX_input",'',"wx_input");
		$this->ci->load->library("weixin/WX_output",'',"wx_output");
		$this->ci->load->library("bucter/BT_bucter",'',"bucter");
	}
	
	public function msg($msg_xml){
		return $this->ci->wx_output->output($this->ci->bucter->getReply($this->ci->wx_input->input($msg_xml)));
	}
}