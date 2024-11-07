<?php

/**
 * History_sync_transaction Controller
 *
 * @author Razal.Gurning
 */
class History_sync_transaction extends MY_Controller{

	public function __construct(){
		parent::__construct();
	}

	function index(){
		$this -> load -> view('synchronize/history_sync_transaction/index');
	}
}
