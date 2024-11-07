<?php
 
class Csv extends MY_Controller  {
 
    function __construct() {
        parent::__construct();
        $this->load->model('csv_model');
        $this->load->library('Getcsv');
    }
 
    function index() {
        $data['item'] = $this->csv_model->get_item();
        $this->load->view('master/csv/index', $data);
    }
    
    function update() {
        $data['item'] = $this->csv_model->get_item();
        $this->load->view('master/csv/update', $data);
    }
 
    function uploadcsv(){
            $fileName = time().$_FILES['file']['name'];
            $config['upload_path'] = './assets/upload/'; //buat folder dengan nama assets di root folder
            $config['file_name'] = $fileName;
            $config['allowed_types'] = 'csv';
             
            $this->load->library('upload');
            $this->upload->initialize($config);
        
            if(! $this->upload->do_upload('file') ){
                $this->upload->display_errors();
            }else{
                $media = $this->upload->data('file');
                $inputFileName = './assets/upload/'.$fileName;
                $handle= fopen($inputFileName, "r");
                $firstRow=true;
                while(($filesop=fgetcsv($handle,1000,","))!==false)
                {
                    if($firstRow){
                        $firstRow=false;
                    }
                    else{
//                         $cat1= $filesop[10];
//                         $query="SELECT id FROM category Where name ilike'$cat1'";
//                         $c1=$this->db->query($query)->result();
                        
//                         $temp1 = json_decode($c1, true);
//                         $cate1= $temp1[0];
//                         var_dump($cate1);
//                         die();
//                         var_dump($c1);
//                         die();
                    $data=array(
                        'id'=>$filesop[0],
                        'sku'=>$filesop[1],
                        'barcode'=>$filesop[2],
                        'name'=>$filesop[3],
                        'carton'=>$filesop[4],
                        'inner'=>$filesop[5],
                        'uom_id'=>$filesop[6],
                        'cost'=>$filesop[7],
                        'retail_price'=>$filesop[8],
                        'trading_price'=>$filesop[9],
                        'category1'=>$filesop[10],
                        'category2'=>$filesop[11],
                        'category3'=>$filesop[12],
                        'category4'=>$filesop[13],
                        'type'=>$filesop[14],
                        'taxed'=>($filesop[15]=='1'?'True':'False'),
                        'consignment'=>$filesop[16],
                        'created_date'=>($filesop[17]==''?NULL:$filesop[17]),
                        'updated_date'=>($filesop[18]==''?NULL:$filesop[18]),
                        'bom_status'=>($filesop[19]=='1'?'True':'False'),
                        'status_sku'=>$filesop[20],
                    );
                    
                    $this->db->insert("item",$data);
                    echo 'Succes';
                }
              }
            }
        }
    
    function updatecsv(){
            $fileName = time().$_FILES['file']['name'];
            $config['upload_path'] = './assets/upload/'; //buat folder dengan nama assets di root folder
            $config['file_name'] = $fileName;
            $config['allowed_types'] = 'csv';
             
            $this->load->library('upload');
            $this->upload->initialize($config);
        
            if(! $this->upload->do_upload('file') ){
                $this->upload->display_errors();
            }else{
                $media = $this->upload->data('file');
                $inputFileName = './assets/upload/'.$fileName;
                $handle= fopen($inputFileName, "r");
                $firstRow=true;
                while(($filesop=fgetcsv($handle,1000,","))!==false)
                {
                    if($firstRow){
                        $firstRow=false;
                    }
                    else{
                        $data=array(
                            'id'=>$filesop[0],
                            'sku'=>$filesop[1],
                            'barcode'=>$filesop[2],
                            'name'=>$filesop[3],
                            'carton'=>$filesop[4],
                            'inner'=>$filesop[5],
                            'uom_id'=>$filesop[6],
                            'cost'=>$filesop[7],
                            'retail_price'=>$filesop[8],
                            'trading_price'=>$filesop[9],
                            'category1'=>$filesop[10],
                            'category2'=>$filesop[11],
                            'category3'=>$filesop[12],
                            'category4'=>$filesop[13],
                            'type'=>$filesop[14],
                            'taxed'=>($filesop[15]=='1'?'True':'False'),
                            'consignment'=>$filesop[16],
                            'bom_status'=>($filesop[19]=='1'?'True':'False'),
                            'status_sku'=>$filesop[20],
                        );
                            $taxed = ($filesop[15]=='1'?'True':'False');
                            $consignment = ($filesop[16]=='1'?'True':'False');
                            $bom_status= ($filesop[19]=='1'?'True':'False');
                           $sql = "UPDATE item SET id=$filesop[0], sku=$filesop[1], barcode=$filesop[2], name='$filesop[3]', carton=$filesop[4], \"inner\"=$filesop[5], 
                                   uom_id=$filesop[6], cost=$filesop[7], retail_price=$filesop[8], trading_price=$filesop[9], category1=$filesop[10], category2=$filesop[11],
                                   category3=$filesop[12], category4=$filesop[13], type=$filesop[14], taxed=$taxed , consignment=$consignment, bom_status= $bom_status, 
                                   status_sku= '$filesop[20]'WHERE id=$filesop[0]";
                           $this->db->query($sql);
                          redirect('Home');

                    }
                }
            }
        }       
}