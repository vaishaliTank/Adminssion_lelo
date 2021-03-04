<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CourceMeta_detail extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $login_type = $this->session->userdata('aname');
        if ($login_type != 'admin') {
            header('location:' . base_url() . 'admin/alogin');
        }
        $this->load->model('common_model');
          $this->load->library('upload');
           $this->load->library('excel');
    }

    public function index()
    {
        $data['List'] = $this->common_model->getData('tbl_college_stream_metadata','');
        $this->load->view('admin/header');
        $this->load->view('admin/course_detail_meta_list', $data);
        $this->load->view('admin/footer');
    }

    public function meta_add(){
        $data['streams'] = $this->common_model->getData('tbl_stream');
        $data['college'] = $this->common_model->getData('tbl_college');
        $this->load->view('admin/header');
        $this->load->view('admin/meta_add', $data);
        $this->load->view('admin/footer');
    }

    public function delete($courseId = NULL){
        if($courseId != ''){
            $whereArr = array('id'=>$courseId);
            $res = $this->common_model->deleteData('tbl_college_stream_metadata',$whereArr);
            echo $res;
   
                $this->session->set_flashdata('msg', '<p style="color:green">Course successfully deleted!</p>');
                redirect('admin/CourceMeta_detail');
         }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/CourceMeta_detail');
        }
    }

    public function course_meta_edit($courseId = NULL){
        if($courseId != ''){
            $whereArr = array('id'=>$courseId);
            $data['coursemetaDetails'] = $this->common_model->getData('tbl_college_stream_metadata',$whereArr);
            //print_r($data['coursemetaDetails']);die;
            if($data['coursemetaDetails'] != ''){
                $data['streams'] = $this->common_model->getData('tbl_stream');
                $data['college'] = $this->common_model->getData('tbl_college');
                $this->load->view('admin/header');
                $this->load->view('admin/meta_add', $data);
                $this->load->view('admin/footer');           
            }else{
                redirect('admin/CourceMeta_detail');    
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/CourceMeta_detail');
        } 
    }

    public function updateCourse(){
        if(!empty($_POST)){
            $whereArr = array('id'=>$_POST['id']);
            $updateArr = array('meta_title'=>$_POST['meta_title'],'meta_keyword'=>$_POST['meta_keyword'],'meta_description'=>$_POST['meta_description']);
            $this->common_model->updateData('tbl_college_stream_metadata',$updateArr,$whereArr);
            $this->session->set_flashdata('msg', '<p style="color:green">Data successfully updated!</p>');
                redirect('admin/CourceMeta_detail');
        }else{
             $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/CourceMeta_detail');
        }
        
    }

    public function saveCourse(){
        if(!empty($_POST)){
            $insertArr = array('stream_id'=>$_POST['stream'],'college_id'=>$_POST['college'],'meta_title'=>$_POST['meta_title'],'meta_keyword'=>$_POST['meta_keyword'],'meta_description'=>$_POST['meta_description']);
            $this->common_model->insertData('tbl_college_stream_metadata',$insertArr);
            $this->session->set_flashdata('msg', '<p style="color:green">Meta added successfully!</p>');
                redirect('admin/CourceMeta_detail');
        }else{
             $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/CourceMeta_detail');
        }
    }

    public function uploadview(){
        $this->load->view('admin/header');
        $this->load->view('admin/csv_course_meta');
        $this->load->view('admin/footer');
    }

    public function createxls(){
        // load excel library
        $this->load->library('excel');
       // $mobiledata = $this->Common_model->mobileList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'College');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Stream');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Meta Title');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Meta keyword');
        
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Meta Description');
        $List= $this->common_model->getData('tbl_college_stream_metadata','');
        //$List = $this->common_model->coreQueryObject($sql);
        //echo "<PRE>";print_r($List);die;
       $rowCount = 2;
        $b = 1;
        foreach ($List as $val) 
        {   
            $whereArr = array('college_id'=>$val->college_id);
            $whereArr1 = array('stream_id'=>$val->stream_id);
            $college = array();
            $stream = array();
            $college = $this->common_model->getData('tbl_college',$whereArr);
            $stream = $this->common_model->getData('tbl_stream',$whereArr1);
            $colName = '';
            if(!empty($college)){
                $colName = $college[0]->college_name;
            } 
            $strName ='';
            if(!empty($stream)){ $strName =  $stream[0]->stream_name; }
            
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $colName);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $strName);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val->meta_title);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val->meta_keyword);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val->meta_description);
            
            $rowCount++;
            $b++;
        }
        $fileName = 'Meta_CourseList.xlsx';
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName);              
    }

    public function upload_csv(){
        $config['upload_path'] = './upload/csv/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['file_name'] = random_string('alnum', 16);
        
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('image_name')){
            $error = $this->upload->display_errors();
            $file_arr = array('error' => $error);
            $this->session->set_flashdata('msg', '<p style="color:red;">'.$file_arr.'</p>');
            return '';
        }else{
            $dt = array('upload_data'=>$this->upload->data());
            $import_xls_file = $dt['upload_data']['file_name'];
        }
        $path = "./upload/csv/";
         $inputFileName = $path . $import_xls_file;
 
        
         $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
         $objReader = PHPExcel_IOFactory::createReader($inputFileType);
         $objPHPExcel = $objReader->load($inputFileName);
         $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
         $flag = true;
         $i=1;
         //echo "<PRE>";print_r($allDataInSheet);die;
         foreach ($allDataInSheet as $value) {
            if($i != 1){
                $stream_id = addslashes(trim($value['A']));
                $college_id = addslashes(trim($value['B']));
                $meta_title = addslashes(trim($value['C']));
                $meta_keyword = addslashes(trim($value['D']));
                $meta_description = addslashes(trim($value['E']));
                
                $insertArr = array('stream_id'=>$stream_id,'college_id'=>$college_id,'meta_title'=>$meta_title,'meta_keyword'=>$meta_keyword,'meta_description'=>$meta_description);
                $this->common_model->insertData('tbl_college_stream_metadata',$insertArr); 
                   /* $exe_insert_cat = custom_my_sql_query($con, $insert_cat) or die(custom_mysql_error($con));
                    $insert_id = custom_my_sql_insert_id($con);*/
                
            }
            $i++;
         }               
         //$result = $this->mcourse->importdata($inserdata);   
         $this->session->set_flashdata('msg', '<p style="color:green">Data Import successfully!</p>');
        redirect('admin/CourceMeta_detail');               
    }


}
