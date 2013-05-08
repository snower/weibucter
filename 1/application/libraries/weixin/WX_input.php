<?php

class WX_input{
	public function input($msg_xml_string){
		$msg_xml=simplexml_load_string($msg_xml_string, 'SimpleXMLElement', LIBXML_NOCDATA);
		$msg=array();
		foreach ($msg_xml->children() as $n=>$c){
			$msg[$n]=(String)$c;
		}
		return $msg;
	}
}