<?php
Class Controller_Index Extends Controller_Base {
	
	public $layouts = "first_layouts";

	function index() {
		$this->template->view('index');
	}
	
}