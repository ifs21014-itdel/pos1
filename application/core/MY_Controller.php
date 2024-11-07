<?php
/**
 * @author Rizal Gurning
 */

class MY_Controller extends MX_Controller{

	public $languange_source;
	
	public function __construct(){
		parent::__construct();
		$this->_load_languages("common");//load common lang
		$this->_load_languages($this->languange_source);
	}
	
	public function _load_languages($languange_source){
		if(is_array($languange_source)){
			foreach($languange_source as $key=>$value){
				load_language($value);
			}
		}else{
			if(!empty($languange_source)){
				load_language($languange_source);
			}
		}
	}
	
	function getMessageResult($isSuccess){
		$message = array();
		if($isSuccess){
			$message = array ('success' => true );
		}else{
			$message = array ('msg' => $this -> db -> _error_message() );
		}
		echo json_encode($message);
	}
	
}
