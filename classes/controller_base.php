<?php
Abstract Class Controller_Base {

	protected $registry;
	protected $template;
	protected $layouts; 
	
	public $vars = array();

	function __construct() {
		$this->template = new Template($this->layouts, get_class($this));
	}
	abstract function index();
}
