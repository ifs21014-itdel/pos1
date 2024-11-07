<?php

/**
 * Card Type
 *
 * @author Razal.Gurning
 */
class Card_type extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this -> load -> model('Model_card_type');
	}

	function index(){}

	function get_debit_card_type(){
		$result = $this -> Model_card_type -> get_debit_card_type();
		echo json_encode($result);
	}

	function get_credit_card_type(){
		$result = $this -> Model_card_type -> get_credit_card_type();
		echo json_encode($result);
	}
}
