<?php

/**
 * Synchronize_upload Controller
 *
 * @author Razal.Gurning
 */
class Synchronize_download extends MY_Controller{

	public function __construct(){
		parent::__construct();
	}

function index(){
		$this -> load -> view('synchronize/synchronize_download/index');
	}
}
