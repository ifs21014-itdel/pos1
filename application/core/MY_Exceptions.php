<?php
/**
 * yg ini blum jalan, butuh di cek lagi
 * 
 * @author Rizal Gurning
 */

class MY_Exceptions extends CI_Exceptions{

	public function __construct(){
        parent::__construct();
    }
    
    function echoError(){
    	show_error('lalala', 401);
    }
}
