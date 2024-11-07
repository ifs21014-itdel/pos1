<?php

/**
 * Integration Store Head Office Factory
 *
 * @author Rizal.Gurning
 */
class Store_head_office_factory extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'file' );
		$this->load->model ( "master/Model_store" );
	}
	function Index() {
	}
	function get_store_code_from_request() {
		$store_serial_number = $this->input->post ( "store_serial_number" );
		$store_code = $this->Model_store->get_store_code_by_serial_number ( $store_serial_number );
		return $store_code;
	}
	function get_download_file_path($is_master = true, $store_code) {
		$path_root = $this->config->item ( 'PATH_ROOT_SYNCHRONIZE_STORE_HO_DIRECTORY' );
		$history_type = "master";
		$suffix = date ( "d_m_Y__H_m_s" );
		$file_name = "dm_synchronize_download_" . $suffix . ".xml";
		if ($is_master != true) {
			$history_type = "transaction";
			$file_name = "dt_synchronize_download" . $suffix . ".xml";
		}
		$path_dir = $config ['upload_path'] = $path_root . "store_" . $store_code . "/download/" . $history_type . "/";
		if (! is_dir ( $path_dir )) {
			mkdir ( $path_dir, 0777, true );
		}
		$path_dir = $path_dir . $file_name;
		$fh = fopen ( $path_dir, 'w' );
		fclose ( $fh );
		$file_data = array(
				"file_path" => $path_dir,
				"file_name" => $file_name
		);
		return $file_data;
	}
	function get_sql_document($nodes) {
		$node_properties = "";
		foreach ( $nodes as $node ) {
			foreach ( $node->childNodes as $child ) {
				$node_properties = $child->nodeValue;
			}
		}
		return $node_properties;
	}
	function read_document_and_save_stock_transfer_manifest($path_file) {
		$dom = new DOMDocument ();
		$dom->preserveWhiteSpace = false;
		$dom->load ( $path_file );
		$sqlElement = $dom->getElementsByTagName ( "sql" );
		$sql = $this->get_sql_document ( $sqlElement );
		$this->load->model ( "order_management/Model_stock_transfer_manifest" );
		$result = $this->Model_stock_transfer_manifest->execute_query ( $sql );
		if ($result) {
			return true;
		}
		return false;
	}
	function get_synchronized_file_path_module_stock_transfer_manifest($store_code, $file_name) {
		$path_root = $this->config->item ( 'PATH_ROOT_SYNCHRONIZE_STORE_HO_DIRECTORY' );
		$folder = "upload";
		$file_name = "dt_stock_transfer_manifest_" . $file_name . ".xml";
		$path_dir = $path_root . "store_" . $store_code ."/". $folder . "/transaction/";
		if (! is_dir ( $path_dir )) {
			mkdir ( $path_dir, 0777, true );
		}
		// $path_dir = $path_dir . $file_name;
		// $fh = fopen($path_dir, 'w');
		// fclose($fh);
		// return realpath($path_dir);
		return $path_dir;
	}
	function stock_transfer_manifest_upload() {
		$store_code = $this->get_store_code_from_request ();
		$file_name = $this->input->post ( "file_name" );
		$module_name = "stock_transfer_manifest";
		$config ['upload_path'] = $this->get_synchronized_file_path_module_stock_transfer_manifest ( $store_code, $file_name);
		$config ['allowed_types'] = 'xml|application/xml';
		$config ['max_size'] = '100000';
		$this->load->library ( 'upload', $config );
		$this->upload->overwrite = true;
		
		if (! $this->upload->do_upload ( "uploaded_file" )) {
			echo json_encode ( array (
					'success' => false,
					'msg' => $this->upload->display_errors ( "", "" ) 
			) );
		} else {
			$data = array (
					'upload_data' => $this->upload->data () 
			);
			$path_file = $data ['upload_data'] ['full_path'];
			$result_array = $this->read_document_and_save_stock_transfer_manifest ( $path_file );
			
			echo json_encode ( array (
					'success' => true,
					'msg' => "Success" 
			) );
		}
	}
	function get_fields_table($datas) {
		$row_data = array ();
		if (is_array ( $datas )) {
			$row_data = $datas [0];
		}
		$table_fields = "";
		foreach ( $row_data as $key => $value ) {
			$table_fields .= "$key,";
		}
		if ($table_fields != "") {
			$table_fields = substr ( $table_fields, 0, (strlen ( $table_fields ) - 1) );
		}
		return $table_fields;
	}
	function get_values_table($datas) {
		$values = "";
		foreach ( $datas as $data ) {
			$values .= "(";
			foreach ( $data as $value ) {
				$values .= "'$value',";
			}
			if ($values != "") {
				$values = substr ( $values, 0, (strlen ( $values ) - 1) );
			}
			$values .= "),";
		}
		
		if ($values != "") {
			$values = substr ( $values, 0, (strlen ( $values ) - 1) );
			$values .= ";";
		}
		return $values;
	}
	function get_prefix_sql() {
		$prefix_sql = " \n BEGIN TRANSACTION; \n";
		return $prefix_sql;
	}
	function get_suffix_sql() {
		$suffix_sql = "\n END TRANSACTION;";
		return $suffix_sql;
	}
	function get_sql_update_setting($last_id, $key_setting) {
		$suffix_sql = "\n update settings set value='$last_id' where key='$key_setting' ;";
		return $suffix_sql;
	}
	function get_sql_download_stock_transfer_manifest($header_data, $detail_data) {
		$sql = $this->get_prefix_sql ();
		$sql .= "\n";
		$sql .= " insert into stock_transfer_manifest ( ";
		$sql .= $this->get_fields_table ( $header_data ) . ") values " . $this->get_values_table ( $header_data ) . "\n";
		$sql .= " insert into stock_transfer_manifest_item ( ";
		$sql .= $this->get_fields_table ( $detail_data ) . ") values " . $this->get_values_table ( $detail_data ) . "\n";
		$sql .= $this->get_suffix_sql ();
		return $sql;
	}
	function create_xml_sql_download_master($starting_point_id, $store_code) {
		$file_data = $this->get_download_file_path ( true, $store_code);
		$xmldoc = new DOMDocument ();
		$xmldoc->preserveWhiteSpace = false;
		$xmldoc->formatOutput = true;
		
		$root = $xmldoc->createElement ( 'root' );
		$total = $xmldoc->createElement ( 'total' );
		
		$last_id = $xmldoc->createElement ( 'last_id' );
		$this->load->model ( 'Model_history_sync_master' );
		$last_id_data = $this->Model_history_sync_master->get_last_id_history_sync_master ();
		$last_id->appendChild ( $xmldoc->createCDATASection ( $last_id_data ) );
		$root->appendChild ( $last_id );
		
		$sqlElement = $xmldoc->createElement ( 'sql' );
		$sql_section = "";
		$history_data = $this->Model_history_sync_master->get_history_sync_master ( $starting_point_id );
		foreach ( $history_data as $row ) {
			$sql_section .= $row->query . "\n";
		}
		if (isset ( $history_data ) && count ( $history_data ) > 0) {
			$sql_section = $this->get_prefix_sql () . $sql_section . $this->get_sql_update_setting ( $last_id_data, "ID_SYNC_MASTER" ) . $this->get_suffix_sql ();
		}
		
		$cdata = $xmldoc->createCDATASection ( $sql_section );
		$sqlElement->appendChild ( $cdata );
		
		$total_data = count ( $history_data );
		$total->appendChild ( $xmldoc->createCDATASection ( $total_data ) );
		$root->appendChild ( $total );
		
		$root->appendChild ( $sqlElement );
		$xmldoc->appendChild ( $root );
		$xmldoc->save ( $file_data['file_path'] );
		return $file_data['file_path'];
	}
	function get_file($file_path) {
		if ($fd = fopen ( $file_path, "r" )) {
			$fsize = filesize ( $file_path );
			$path_parts = pathinfo ( $file_path );
			header( "Content-type: application/octet-stream" );
// 			header( "Content-Disposition:attachment; filename=\"" . $path_parts ['filename'] . "\"");
// 			header( "Content-length: $fsize" );
			header( "Cache-control: private" ); // use this to open files directly
			while ( ! feof ( $fd ) ) {
				$buffer = fread ( $fd, 2048 );
				echo $buffer;
			}
		}
		fclose ( $fd );
	}
	function create_xml_sql_download_transaction($starting_point_id, $store_code) {
		$file_data = $this->get_download_file_path ( false, $store_code );
		$xmldoc = new DOMDocument ();
		$xmldoc->preserveWhiteSpace = false;
		$xmldoc->formatOutput = true;
		
		$root = $xmldoc->createElement ( 'root' );
		$total = $xmldoc->createElement ( 'total' );
		
		$last_id = $xmldoc->createElement ( 'last_id' );
		$this->load->model ( 'Model_history_sync_transaction' );
		$last_id_data = $this->Model_history_sync_transaction->get_last_id_history_sync_transaction ();
		$last_id->appendChild ( $xmldoc->createCDATASection ( $last_id_data ) );
		$root->appendChild ( $last_id );
		
		$this->load->model ( 'Model_store' );
		$store_id = $this->Model_store->get_store_id_by_code ( $store_code );
		
		$sqlElement = $xmldoc->createElement ( 'sql' );
		$sql_section = "";
		$history_data = $this->Model_history_sync_transaction->get_history_sync_transaction ( $starting_point_id, $store_id );
		foreach ( $history_data as $row ) {
			$sql_section .= $row->query . "\n";
		}
		
		if (isset ( $history_data ) && count ( $history_data ) > 0) {
			$sql_section = $this->get_prefix_sql () . $sql_section . $this->get_sql_update_setting ( $last_id_data, "ID_SYNC_TRANSACTION" ) . $this->get_suffix_sql ();
		}
		
		$cdata = $xmldoc->createCDATASection ( $sql_section );
		$sqlElement->appendChild ( $cdata );
		
		$total_data = count ( $history_data );
		$total->appendChild ( $xmldoc->createCDATASection ( $total_data ) );
		$root->appendChild ( $total );
		
		$root->appendChild ( $sqlElement );
		$xmldoc->appendChild ( $root );
		$xmldoc->save ( $file_data['file_path'] );
		return $file_data['file_path'];
	}
	function download_master() {
		$store_code = $this->get_store_code_from_request ();
		$starting_point = $this->input->post ( "starting_point" );
		$created_file_path = $this->create_xml_sql_download_master ( $starting_point, $store_code);
		$this->get_file ( $created_file_path );
	}
	function download_transaction() {
		$store_code = $this->get_store_code_from_request ();
		$starting_point = $this->input->post ( "starting_point" );
		
		$file_path = $this->create_xml_sql_download_transaction ( $starting_point, $store_code );
		$this->get_file ( $file_path );
	}
	function read_document_and_save_uploaded_all_master_and_transaction($path_file) {
		$dom = new DOMDocument ();
		$dom->preserveWhiteSpace = false;
		$dom->load ( $path_file );
		$sqlElement = $dom->getElementsByTagName ( "sql" );
		$sql = $this->get_sql_document ( $sqlElement );
		$this->load->model ( "synchronize/Model_integration" );
		$result = $this->Model_integration->execute_query ( $sql );
		if ($result) {
			return true;
		}
		return false;
	}
	function upload_all_master_and_transaction() {
		$store_code = $this->get_store_code_from_request ();
		// $file_name = $this -> input -> post("file_name");
		$path_root = $this->config->item ( 'PATH_ROOT_SYNCHRONIZE_STORE_HO_DIRECTORY' );
		$folder = "upload";
		$path_dir = $path_root . "store_" . $store_code ."/". $folder . "/all/";
		if (! is_dir ( $path_dir )) {
			mkdir ( $path_dir, 0777, true );
		}
		$real_path = realpath ( $path_dir );
		$config ['upload_path'] = $real_path;
		$config ['allowed_types'] = 'xml|application/xml';
		$config ['max_size'] = '1000000';
		$this->load->library ( 'upload', $config );
		$this->upload->overwrite = true;
		
		if ($this->upload->do_upload ( "uploaded_file" )) {
			$data = array (
					'upload_data' => $this->upload->data () 
			);
			$path_file = $data ['upload_data'] ['full_path'];
			$result_array = $this->read_document_and_save_uploaded_all_master_and_transaction ( $path_file );
			echo json_encode ( array (
					'success' => true,
					'msg' => "Success" 
			) );
		} else {
			echo json_encode ( array (
					'success' => false,
					'msg' => $this->upload->display_errors ( "", "" ) 
			) );
		}
	}
}