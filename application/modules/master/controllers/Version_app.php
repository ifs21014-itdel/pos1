<?php 

/**
 * @author 
 */
class Version_app extends MY_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'model_version_app' );
	}
	
	function get_app_data() {
	    $result = $this->model_version_app->get_app_data();
	    echo json_encode($result);
	}	
    
	function getUpdate(){
	    $git_version= $this->model_version_app->get_data();
	    $temp = json_decode($git_version, true);
	    $server_version = $temp[0]['version_name'];
	    $version_app= $this->model_version_app->get_app_data();
	    $temp1 = json_decode($version_app, true);
	    $client_version= $temp1[0]['version_name'];
	    //Initialize for DB Version
	    $server_path= 'C:/xampp/htdocs/ho_bez/application/db_update';
	    $i = 0;
	    if ($handle = opendir($server_path)) {
	        while (($file = readdir($handle)) !== false){
	            if (!in_array($file, array('.', '..')) && !is_dir($server_path.$file))
	                $i++;
	        }
	    }
	    $version_count = $this->model_version_app->get_db_count();
	    $row_count = json_decode($version_count, true);
	    $db_count = $row_count[0]['count'];
	    //BACKUP DB
	    $backup_command= exec('pg_dump.exe --host localhost --port 5432 --username "postgres" --no-password  --format plain --inserts --verbose --file "C:\xampp\htdocs\retail_dev\assets\backup\store_sohodb.backup" "store_soho"');
	    
	    while($server_version>$client_version){
	        //Execute git pull
	        echo "<h3 align = center> Succesfully Updated</h3>";
	        $path='C:\xampp\htdocs\retail_dev';
	        $cdCommand= chdir($path);
	        $client_version+= 0.1;
	        $pull="git pull origin dev.".$client_version;
	        $output= shell_exec($pull);
	        //Execute upgrade db
	        $isSuccess = $this ->model_version_app-> add_version($client_version);
	        $this -> getMessageResult( $isSuccess );  
	    }
	    //Get Lastest file to exec
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
	        $db_count++;
	       // $isSuccess = $this -> model_db_version -> add_db_version($db_count);
	    }
	    else{
	        echo"<h3>Update is not Ready</h3>";
	    }
	}
}

