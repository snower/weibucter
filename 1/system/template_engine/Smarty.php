<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 */
require_once 'Template_engine.php';
require_once 'Smarty/Smarty.class.php';

class CI_Smarty extends Smarty{
	private $ci;
	
	public function __construct($template_paths){
		parent::__construct();
		$this->setTemplateDir($template_paths);
		$this->setCompileDir(TEMPLATEENGINEPATH."Smarty/templates_c");
		$this->setConfigDir(TEMPLATEENGINEPATH."Smarty/config");
		$this->setCacheDir(APPPATH."cache");
		$this->ci=& get_instance();
		
		$this->debugging=FALSE;
	}
	
	public function template($template,$vars=array(),$return=FALSE){
		foreach ($vars as $key => $val){
			$this->assign($key, $val);
		}
		
		if ($return == FALSE){
			return $this->ci->output->set_output($this->fetch($template));
		}else{
			return $this->fetch($template);
		}
	}
}