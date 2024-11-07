<?php

/**
 * History_sync_master Controller
 *
 * @author Razal.Gurning
 */
class History_sync_master extends MY_Controller{

	public function __construct(){
		parent::__construct();
	}

	function index(){
		$this -> load -> view('synchronize/history_sync_master/index');
	}
}
