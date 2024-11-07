<?php

/**
 * @author 
 */
class App_version extends MY_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'model_app_version' );
	}
	
	function get_data() {
	    $result = $this->model_app_version->get_data();
	    echo json_encode($result);
	}
	
	function getUpdate(){
	    $git_version= 1.2;
	    $temp = $this->model_app_version->get_data();
	    $temp = json_decode($temp, true);
	    $project_version = $temp[0]['version'];
	   // echo 'git: ' . $git_version . "/project: " . $project_version;
	    if($git_version > $project_version){	        
    	  $path='C:\xampp\htdocs\retail_dev';
    	  $cdCommand= chdir($path);
    	  //$pull="git pull origin dev.".$git_version;
    	  $pull="git pull origin dev.1.1";
    	  $output= shell_exec($pull);
    	  $isSuccess = $this -> model_app_version -> add_version($git_version);
    	  //$this -> getMessageResult( $isSuccess );
    	 echo "<h3 align = center> Succesfully Updated</h3>"; 
    	 //echo '<script type="text/javascript">alert("Successfully Updated");</script>';
    	 //$this->load->view('cashier/sales/index');
	    }
	    else{
	        echo "<h3 align = center> Can't Update This Version</h3>";
	    }
	}
	

}
