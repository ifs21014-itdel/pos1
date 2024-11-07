<?php

/**
 * Integration Store Factory
 *
 * @author Rizal.Gurning
 */
class Store_factory extends MY_Controller {

    private $MODULE_STOCK_TRANSFER_MANIFEST = "stock_transfer_manifest";

    public function __construct() {
        parent::__construct();
        $this->load->helper('file');
    }

    function Index() {
        
    }

    function get_web_page($url, $data) {
        $options = array(
            CURLOPT_URL => $url,
            CURLINFO_HEADER_OUT => true, // Request header
            CURLOPT_RETURNTRANSFER => true, // return web page
            CURLOPT_HEADER => false, // don't return headers
            CURLOPT_FOLLOWLOCATION => true, // follow redirects
            CURLOPT_MAXREDIRS => 10, // stop after 10 redirects
            CURLOPT_ENCODING => "", // handle compressed
            CURLOPT_USERAGENT => "", // name of client $_SERVER["HTTP_USER_AGENT"]
            CURLOPT_AUTOREFERER => true, // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 120, // time-out on connect
            CURLOPT_TIMEOUT => 120, // time-out on response
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            // CURLOPT_BINARYTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Content-type: multipart/form-data;'
            )
        );

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $content = curl_exec($ch);

        $header_info = curl_getinfo($ch, CURLINFO_HEADER_OUT);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

// 		print_r($content);
// 		echo "<br/>";
// 		print_r($header_info);

        curl_close($ch);
        return $content;
    }

    function get_curl($server_method_to_invoke, $data) {        
        $main_data = array(
            "store_ho_serial_number" => $this->config->item('STORE_HO_SERIAL_NUMBER'),
            "store_serial_number" => $this->config->item('STORE_SERIAL_NUMBER')
        );
        $main_data = array_merge($main_data, $data);
        $target_server_url = $this->config->item('PATH_URL_SYNCHRONIZE_STORE_HO') . $server_method_to_invoke;
//        var_dump($target_server_url);
        $response = $this->get_web_page($target_server_url, $main_data);
        return $response;
    }

    function get_synchronized_file_path_module($synchronize_type, $is_download = true, $is_master) {
        $path_root = $this->config->item('PATH_ROOT_SYNCHRONIZE_STORE_DIRECTORY');
        $folder = "";
        if ($is_download != true) {
            $folder = "upload";
        } else {
            $folder = "download";
        }
        $file_name = $this->get_synchronized_file_name_per_current_date($is_master);

        $path_dir = $path_root . $folder . "/" . $synchronize_type . "/";
        if (!is_dir($path_dir)) {
            mkdir($path_dir, 0777, true);
        }
        $path_dir = $path_dir . $file_name;
        $fh = fopen($path_dir, 'w+');
        fclose($fh);
        return $path_dir;
    }

    function create_curl_file_synchronization_upload($file_path) {
        $file_real_path = realpath($file_path);
        $file_mime = get_mime_by_extension($file_path);
        $file_upload = new CURLFile($file_real_path, $file_mime, $file_real_path);
        if (!isset($file_upload)) {
            throw "CURL File failed!";
        }
        return $file_upload;
    }

    function get_synchronized_file_name_per_current_date($is_master = true) {
        $suffix = date("d_m_Y__H_m_s");
        $folder = "dt";
        if ($is_master == true) {
            $folder = "dm";
        }
        return $folder . "_synchronize_download_" . $suffix . ".xml";
    }

    function get_code_stock_transfer_manifest($stock_transfer_manifest_id) {
        $no_stock_transfer_manifest = $this->Model_stock_transfer_manifest->get_code_stock_transfer_manifest_by_id($stock_transfer_manifest_id);
        return $no_stock_transfer_manifest;
    }

    function get_prefix_sql() {
        $prefix_sql = "SET statement_timeout = 0;
					\n SET lock_timeout = 0;
					\n SET client_encoding = 'UTF8';
					\n SET standard_conforming_strings = on;
					\n SET check_function_bodies = false;
					\n SET client_min_messages = warning;
				 	\n BEGIN TRANSACTION; \n";
        return $prefix_sql;
    }

    function get_suffix_sql() {
        $suffix_sql = "\n END TRANSACTION;";
        return $suffix_sql;
    }

    function get_fields_table($datas) {
        $row_data = array();
        if (is_array($datas)) {
            $row_data = $datas [0];
        }
        $table_fields = "";
        foreach ($row_data as $key => $value) {
            $table_fields .= "$key,";
        }
        if ($table_fields != "") {
            $table_fields = substr($table_fields, 0, (strlen($table_fields) - 1));
        }
        return $table_fields;
    }

    function get_values_table($datas) {
        $values = "";
        foreach ($datas as $data) {
            $values .= "(";
            foreach ($data as $value) {
                $values .= "'$value',";
            }
            if ($values != "") {
                $values = substr($values, 0, (strlen($values) - 1));
            }
            $values .= "),";
        }

        if ($values != "") {
            $values = substr($values, 0, (strlen($values) - 1));
            $values .= ";";
        }
        return $values;
    }

    function get_synchronized_file_name_of_stock_transfer_manifest() {
        $suffix = date("d_m_Y");
        return "dt_stock_transfer_manifest_" . $suffix . ".xml";
    }

    function get_synchronized_file_name_of_transfer_stock_request() {
        $suffix = date("d_m_Y");
        return "dt_transfer_stock_request_" . $suffix . ".xml";
    }

    function get_synchronized_file_path_module_stock_transfer_manifest() {
        $path_root = $this->config->item('PATH_ROOT_SYNCHRONIZE_STORE_DIRECTORY');
        $folder = "upload";
        $file_name = $this->get_synchronized_file_name_of_stock_transfer_manifest();
        $path_dir = $path_root . $folder . "/transaction/";
        if (!is_dir($path_dir)) {
            mkdir($path_dir, 0777, true);
        }
        $path_dir = $path_dir . $file_name;
        $fh = fopen($path_dir, 'w');
        fclose($fh);
        $file_data = array(
            "file_path" => $path_dir,
            "file_name" => $file_name
        );
        return $file_data;
    }

    function get_synchronized_file_path_module_transfer_stock_request() {
        $path_root = $this->config->item('PATH_ROOT_SYNCHRONIZE_STORE_DIRECTORY');
        $folder = "upload";
        $file_name = $this->get_synchronized_file_name_of_transfer_stock_request();
        $path_dir = $path_root . $folder . "/transaction/";
        if (!is_dir($path_dir)) {
            mkdir($path_dir, 0777, true);
        }
        $path_dir = $path_dir . $file_name;
        $fh = fopen($path_dir, 'w');
        fclose($fh);
        $file_data = array(
            "file_path" => $path_dir,
            "file_name" => $file_name
        );
        return $file_data;
    }

    function create_xml_sql_stock_transfer_manifest($stock_transfer_manifest_id) {
//		$no_stock_transfer_manifest = $this->get_code_stock_transfer_manifest ( $stock_transfer_manifest_id );
        $file_data = $this->get_synchronized_file_path_module_stock_transfer_manifest();
        $xmldoc = new DOMDocument ();
        $xmldoc->preserveWhiteSpace = false;
        $xmldoc->formatOutput = true;

        $root = $xmldoc->createElement('root');
        $sql = $xmldoc->createElement('sql');
// 		$header_data = $this->Model_stock_transfer_manifest->get_stock_transfer_manifest_by_id ( $stock_transfer_manifest_id );
// 		$detail_data = $this->Model_stock_transfer_manifest_item->get_stock_transfer_manifest_items ( $stock_transfer_manifest_id );

        $cdata_section = $this->get_prefix_sql();
        $cdata_section .= "\n";

        $this->load->model("synchronize/Model_integration");
        $dataSTM = $this->Model_integration->backupTable("stock_transfer_manifest", " id = $stock_transfer_manifest_id", "1");

        foreach ($dataSTM as $value) {
            $cdata_section .= $value . "\n";
        }

        $dataSTMI = $this->Model_integration->backupTable("stock_transfer_manifest_item", " stock_transfer_manifest_id = $stock_transfer_manifest_id", "1");
        foreach ($dataSTMI as $value) {
            $cdata_section .= $value . "\n";
        }

        $cdata_section .= $this->get_suffix_sql();
        $cdata = $xmldoc->createCDATASection($cdata_section);
        $sql->appendChild($cdata);

        $root->appendChild($sql);
        $xmldoc->appendChild($root);
        $xmldoc->save($file_data['file_path']);
        return $file_data;
    }

    function stock_transfer_manifest_upload() {
        $this->load->model("order_management/Model_stock_transfer_manifest");
        $this->load->model("order_management/Model_stock_transfer_manifest_item");

        $stock_transfer_manifest_id = $this->input->post("stock_transfer_manifest_id");
        $file_data = $this->create_xml_sql_stock_transfer_manifest($stock_transfer_manifest_id);
        if (isset($file_data)) {
            $no_stock_transfer_manifest = $this->get_code_stock_transfer_manifest($stock_transfer_manifest_id);
            $server_method_to_invoke = "stock_transfer_manifest_upload";
            $uploaded_file = $this->create_curl_file_synchronization_upload($file_data['file_path']);
            $data = array(
                "uploaded_file" => $uploaded_file,
                "file_name" => $file_data['file_name']
            );

            $server_response = $this->get_curl($server_method_to_invoke, $data);
            $response = json_decode($server_response);
            // var_dump($response); exit();
            if ($response != null && $response->success === true) {
                // update status STM
                $this->Model_stock_transfer_manifest->update_status_stock_transfer_manifest($stock_transfer_manifest_id, true);
                echo json_encode(array(
                    'success' => true,
                    'msg' => ""
                ));
            } else {
                echo json_encode(array(
                    'success' => false,
                    'msg' => "error sync upload"
                ));
            }
        } else {
            echo json_encode(array(
                'success' => false,
                'msg' => "error create xml transfer_stock"
            ));
        }
    }

    function transfer_stock_request_upload() {
        $this->load->model("order_management/Model_transfer_stock_request");

        $transfer_stock_request_id = $this->input->post("transfer_stock_request_id");
        $file_data = $this->create_xml_sql_transfer_stock_request($transfer_stock_request_id);
        
        if (isset($file_data)) {
            $server_method_to_invoke = "transfer_stock_request_upload";
            $uploaded_file = $this->create_curl_file_synchronization_upload($file_data['file_path']);
            $data = array(
                "uploaded_file" => $uploaded_file,
                "file_name" => $file_data['file_name']
            );

            $server_response = $this->get_curl($server_method_to_invoke, $data);
            $response = json_decode($server_response);
//            var_dump($server_response); exit();
            if ($response != null && $response->success === true) {
                // update status 
                $this->Model_transfer_stock_request->update_status_transfer_stock_request($transfer_stock_request_id, true);
                echo json_encode(array('success' => true, 'msg' => ""));
            } else {
                echo json_encode(array('success' => false, 'msg' => "1 error sync upload"));
            }
        } else {
            echo json_encode(array('success' => false, 'msg' => "error create xml transfer_stock"));
        }
    }

    function stock_transfer_manifest_download() {
        $this->load->model("order_management/Model_stock_transfer_manifest");
        $this->load->model("order_management/Model_stock_transfer_manifest_item");

        $stock_transfer_manifest_id = $this->input->post("stock_transfer_manifest_id");
        $return = $this->create_xml_sql_stock_transfer_manifest($stock_transfer_manifest_id);
        if (isset($return)) {
            $module_name = $this->MODULE_STOCK_TRANSFER_MANIFEST;
            $no_stock_transfer_manifest = $this->get_code_stock_transfer_manifest($stock_transfer_manifest_id);
// 			$file_name = $this->get_stock_transfer_manifest_file_name_per_current_date ( $no_stock_transfer_manifest );

            $server_method_to_invoke = "stock_transfer_manifest";
            // $uploaded_file = $this -> create_curl_file_synchronization($file_name, $module_name);
            $data = array();
            // "uploaded_file" => $uploaded_file

            $response = $this->get_curl($server_method_to_invoke, $data);

            $response = json_decode($response);
            if ($response->success === true) {
                // update status STM
                $status_is_synchronized = true;
                $this->Model_stock_transfer_manifest->update_status_stock_transfer_manifest($stock_transfer_manifest_id, $status_is_synchronized);
                echo json_encode(array(
                    'success' => true,
                    'msg' => ""
                ));
            }
        } else {
            echo json_encode(array(
                'success' => true,
                'msg' => "error create xml transfer_stock"
            ));
        }
    }

    function create_xml_sql_transfer_stock_request($transfer_stock_request_id) {
        $file_data = $this->get_synchronized_file_path_module_transfer_stock_request();
        $xmldoc = new DOMDocument ();
        $xmldoc->preserveWhiteSpace = false;
        $xmldoc->formatOutput = true;

        $root = $xmldoc->createElement('root');
        $sql = $xmldoc->createElement('sql');
        $cdata_section = $this->get_prefix_sql();
        $cdata_section .= "\n";

        $this->load->model("synchronize/Model_integration");
        $dataSTM = $this->Model_integration->backupTable("transfer_stock_request", " id = $transfer_stock_request_id", "1");

        foreach ($dataSTM as $value) {
            $cdata_section .= $value . "\n";
        }

        $dataSTMI = $this->Model_integration->backupTable("transfer_stock_request_item", " transfer_stock_request_id = $transfer_stock_request_id", "1");
        foreach ($dataSTMI as $value) {
            $cdata_section .= $value . "\n";
        }

        $cdata_section .= $this->get_suffix_sql();
        $cdata = $xmldoc->createCDATASection($cdata_section);
        $sql->appendChild($cdata);

        $root->appendChild($sql);
        $xmldoc->appendChild($root);
        $xmldoc->save($file_data['file_path']);
        return $file_data;
    }

    function get_content_document($nodes) {
        $node_properties = "";
        foreach ($nodes as $node) {
            foreach ($node->childNodes as $child) {
                $node_properties = $child->nodeValue;
            }
        }
        return $node_properties;
    }

    function read_document_and_save_stock_transfer_manifest($path_file) {
        $dom = new DOMDocument ();
        $dom->preserveWhiteSpace = false;
        $dom->load($path_file);
        $sizeElement = $dom->getElementsByTagName("size");
        $size = $this->get_sql_document($sizeElement);

        if ($size > 0) {
            $sqlElement = $dom->getElementsByTagName("sql");
            $sql = $this->get_sql_document($sqlElement);
            $this->load->model("order_management/Model_stock_transfer_manifest");
            $result = $this->Model_stock_transfer_manifest->execute_query($sql);
            if ($result) {
                return true;
            }
        }
        return false;
    }

    function download($synchronize_type, $store_ho_method_name, $is_master) {
        $file_path = $this->get_synchronized_file_path_module($synchronize_type, true, $is_master);
        $url = $this->config->item('PATH_URL_SYNCHRONIZE_STORE_HO') . $store_ho_method_name;

        $fp = fopen($file_path, 'w+');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 		curl_setopt($ch, CURLOPT_HEADER,true);

        $this->load->model("system/Model_settings");
        $id_sync = 0;
        if ($synchronize_type == 'transaction') {
            $id_sync = $this->Model_settings->get_id_sync_transaction();
        } else {
            $id_sync = $this->Model_settings->get_id_sync_master();
        }

        $main_data = array(
            "store_ho_serial_number" => $this->config->item('STORE_HO_SERIAL_NUMBER'),
            "store_serial_number" => $this->config->item('STORE_SERIAL_NUMBER'),
            "starting_point" => $id_sync
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $main_data);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_FILE, $fp);

        $response = curl_exec($ch);
// 		$info = curl_getinfo($ch);
        curl_close($ch);
        fclose($fp);
        return $file_path;
    }

    function process_synchronize_data($path_file) {
        $dom = new DOMDocument ();
        $dom->load($path_file);
        $totalElement = $dom->getElementsByTagName("total");
        $total = $this->get_content_document($totalElement);
        $result = false;
        if (isset($total)) {
            if ($total > 0) {
                $sqlElement = $dom->getElementsByTagName("sql");
                $sql = $this->get_content_document($sqlElement);

                $this->load->model("synchronize/Model_history_sync_master");
                $result = $this->Model_history_sync_master->execute_query($sql);
                if (!$result) {
                    // $lastIdElement = $dom -> getElementsByTagName("last_id");
                    // $last_id = $this -> get_content_document($lastIdElement);
                    // $this -> load -> model("system/Model_settings");
                    // $this->Model_settings->update_id_sync_master($last_id);
                    $result = false;
                }
            } else {
                $result = true;
            }
        }
        return $result;
    }

    function synchronize_master() {
        $store_ho_method_name = "download_master";
        $synchronize_type = "master";
        $file_downloaded_path = $this->download($synchronize_type, $store_ho_method_name, true);
        $is_success = $this->process_synchronize_data($file_downloaded_path);
// 		if ($is_success == true) {
// 			echo json_encode ( array (
// 					'success' => true,
// 					'msg' => "" 
// 			) );
// 		} else {
// 			echo json_encode ( array (
// 					'success' => false,
// 					'msg' => "Error when synchronize master !" 
// 			) );
// 		}
        return $is_success;
    }

    function synchronize_transaction() {
        $store_ho_method_name = "download_transaction";
        $synchronize_type = "transaction";
        $file_downloaded_path = $this->download($synchronize_type, $store_ho_method_name, false);
        $is_success = $this->process_synchronize_data($file_downloaded_path);
// 		if ($is_success == true) {
// 			echo json_encode ( array (
// 					'success' => true,
// 					'msg' => "" 
// 			) );
// 		} else {
// 			echo json_encode ( array (
// 					'success' => false,
// 					'msg' => "Error when synchronize Transaction !" 
// 			) );
// 		}
        return $is_success;
    }

    function synchronize_master_and_transaction() {
        $is_success = $this->synchronize_master();
        if ($is_success == true) {
            $is_success = $this->synchronize_transaction();
            if ($is_success == true) {
                echo json_encode(array(
                    'success' => true,
                    'msg' => ""
                ));
            } else {
                echo json_encode(array(
                    'success' => false,
                    'msg' => "Error when synchronize Transaction !"
                ));
            }
        } else {
            echo json_encode(array(
                'success' => false,
                'msg' => "Error when synchronize Master !"
            ));
        }
    }

    function get_synchronized_upload_file_data() {
        $path_root = $this->config->item('PATH_ROOT_SYNCHRONIZE_STORE_DIRECTORY');
        $folder = "upload";
        $suffix = date("Y_m_d_H_m_s");
        $file_name = $suffix . "_dt_synchronize_upload.xml";
        $path_dir = $path_root . $folder . "/all/";
        if (!is_dir($path_dir)) {
            mkdir($path_dir, 0777, true);
        }
        $path_dir = $path_dir . $file_name;
        $fh = fopen($path_dir, 'w');
        fclose($fh);
        $file_data = array(
            "file_path" => $path_dir,
            "file_name" => $file_name
        );
        return $file_data;
    }

    function create_xml_sql_synchronized_upload() {
        $file_data = $this->get_synchronized_upload_file_data();
        $file_path = $file_data['file_path'];
        $xmldoc = new DOMDocument ();
        $xmldoc->preserveWhiteSpace = false;
        $xmldoc->formatOutput = true;

        $root = $xmldoc->createElement('root');
        $sql = $xmldoc->createElement('sql');
        $cdata_section = $this->get_prefix_sql();
        $cdata_section .= "\n";

        $this->load->model("synchronize/Model_integration");
        $datas = $this->Model_integration->get_uploaded_all_data();

        foreach ($datas as $value) {
            $cdata_section .= $value . "\n";
        }

        $cdata_section .= $this->get_suffix_sql();
        $cdata = $xmldoc->createCDATASection($cdata_section);
        $sql->appendChild($cdata);

        $root->appendChild($sql);
        $xmldoc->appendChild($root);
        $xmldoc->save($file_path);
        return $file_data;
    }

    function upload_all_master_and_transaction() {
        $file_data = $this->create_xml_sql_synchronized_upload();
        if (isset($file_data)) {
            $server_method_to_invoke = "upload_all_master_and_transaction";
            $uploaded_file = $this->create_curl_file_synchronization_upload($file_data['file_path']);
            $data = array(
                "uploaded_file" => $uploaded_file,
                "file_name" => $file_data['file_name']
            );

            $server_response = $this->get_curl($server_method_to_invoke, $data);
            $response = json_decode($server_response);
            if ($response != null && $response->success === true) {
                $this->load->model("synchronize/Model_integration");
                $this->Model_integration->update_synchronize_table();
                echo json_encode(array(
                    'success' => true,
                    'msg' => ""
                ));
            } else {
                echo json_encode(array(
                    'success' => false,
                    'msg' => "error synchronize upload data"
                ));
            }
        } else {
            echo json_encode(array(
                'success' => false,
                'msg' => "error create xml upload"
            ));
        }
    }

    function testScript() {
        $this->load->model("synchronize/Model_integration");
        $result = $this->Model_integration->testSQL();
        print_r($result);
        exit;
    }

}
