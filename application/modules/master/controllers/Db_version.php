<?php

/**
 * @author 
 */
class Db_version extends MY_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'model_db_version' );
	}
	
	function get_data() {
	    $result = $this->model_db_version->get_data();
	    echo json_encode($result);
	}
	
	function UpdateDb(){
	   $server_path= 'C:/xampp/htdocs/ho_bez/application/db_update';
	   $i = 0;
	   if ($handle = opendir($server_path)) {
	       while (($file = readdir($handle)) !== false){
	           if (!in_array($file, array('.', '..')) && !is_dir($server_path.$file))
	               $i++;
	       }
	   }
	   //echo "There were $i files";
	   //echo"<br/>";
	   $version_count = $this->model_db_version->get_row_count();
	   var_dump($version_count);
	   die();
	   $row_count = json_decode($version_count, true);
	   $db_count = $row_count[0]['count'];
	   if ($i > $db_count){
	       echo"<h3>Update is Ready</h3>";
	       $lastMod = 0;
	       $lastModFile = '';
	       foreach (scandir($server_path) as $entry) {
	           if (is_file($server_path.$entry) && filectime($server_path.$entry) > $lastMod) {
	               $lastMod = filectime($server_path.$entry);
	               $lastModFile = $entry;
	           }
	       }
	       
	       $new_file = file_get_contents($server_path."/".$entry);
	       file_put_contents('C:/xampp/htdocs/retail_dev/application/db_update/'.$entry,$new_file);
	       $my_file=readfile('C:/xampp/htdocs/retail_dev/application/db_update/'.$entry);
           $this->db->trans_start();
	       $this->db->query($new_file);
	       $this->db->trans_complete();
	       //echo $entry;
	       //var_dump($new_file);
	       $db_count++;
	       $isSuccess = $this -> model_db_version -> add_db_version($db_count);
	   }
	   else{
	       echo"<h3>Update is not Ready</h3>";
	   }
	}
}
