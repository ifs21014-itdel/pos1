<?php
include APPPATH . 'third_party\PHPExcel\IOFactory.php';
class Excel extends MY_Controller {
    function __construct(){
        parent::__construct();
        //$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }
    
    public function index()
    {
        $this->load->view('master/excel/index');
    }
    
    public function upload(){
        $fileName = time().$_FILES['file']['name'];
        
         
        $config['upload_path'] = 'C:/xampp/htdocs/retail_dev/assets/upload/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
            $this->upload->display_errors();
             
            $media = $this->upload->data('file');
            $inputFileName = 'C:/xampp/htdocs/retail_dev/assets/upload/'.$media['file_name'];
//             var_dump($media);
//             var_dump($inputFileName);
//             die();
             
            try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
    
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
             
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                    NULL,
                    TRUE,
                    FALSE);
                 
                //Sesuaikan sama nama kolom tabel di database
                $data = array(
                    "id"=> $rowData[0][0],
                    "sku"=> $rowData[0][1],
                    "barcode"=> $rowData[0][2],
                    "name"=> $rowData[0][3],
                    "carton"=> $rowData[0][4],
                    "inner"=> $rowData[0][5],
                    "uom_id"=> $rowData[0][6],
                    "cost"=> $rowData[0][7],
                    "retail_price"=> $rowData[0][8],
                    "trading_price"=> $rowData[0][9],
                    "category1"=> $rowData[0][10],
                    "category2"=> $rowData[0][11],
                    "category3"=> $rowData[0][12],
                    "category4"=> $rowData[0][13],
                    "type"=> $rowData[0][14],
                    "taxed"=> $rowData[0][15],
                    "consignment"=> $rowData[0][16],
                    "created_date"=> $rowData[0][17],
                    "updated_state"=> $rowData[0][18],
                    "bom_status"=> $rowData[0][19],
                    "status_sku"=> $rowData[0][20]
                );
                //sesuaikan nama dengan nama tabel
                $insert = $this->db->insert("item",$data);
//                 var_dump($insert);
//                 die();
                delete_files($media['file_path']);      
            }
            //redirect('master/excel/index/');
    }
}