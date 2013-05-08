<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WX_sign{
	const TOKEN="bucter_weixin";
	private $error;
	private $signature;
	private $timestamp;
	private $nonce;
	
	public function __construct($params){
		$this->signature=$params["signature"];
		$this->timestamp=$params["timestamp"];
		$this->nonce=$params["nonce"];
		$this->error= $this->signature && $this->timestamp && $this->nonce;
	}
	
	public function valid(){
		if(!$this->error) return false;
		return $this->checkSignature();
	}
	
	private function checkSignature(){
		$tmpArr = array(self::TOKEN, $this->timestamp, $this->nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $this->signature ){
			return true;
		}else{
			return false;
		}
	}
}
?>