<?php

/**
 * Controller Email
 *
 * @author Razal.Gurning
 */
class Email extends MX_Controller{

	public function __construct(){
		parent::__construct();
	}

	function test(){
		define("ENCRYPTION_KEY", "12345");
		$string = "This is the original data string!";
		
		echo $encrypted = $this->encrypt($string, ENCRYPTION_KEY);
		echo "<br />";
		echo $decrypted = $this->decrypt($encrypted, ENCRYPTION_KEY);
	}
	
	/**
	 * Returns an encrypted & utf8-encoded
	 */
	function encrypt($pure_string, $encryption_key){
		$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
		return $encrypted_string;
	}

	/**
	 * Returns decrypted original string
	 */
	function decrypt($encrypted_string, $encryption_key){
		$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
		return $decrypted_string;
	}

	function sendEmail(){
		$this -> load -> model("email/model_email");
		$this -> model_email -> send();
	}
}
