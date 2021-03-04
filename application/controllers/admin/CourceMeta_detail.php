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
         $i=0;
         //echo "<PRE>";print_r($allDataInSheet);die;
         foreach ($allDataInSheet as $value) {
            if($i != 1){
                $college_id = addslashes(trim($value[A]));
                $course_id = addslashes(trim($value[B]));
                $stream_id = addslashes(trim($value[C]));
                $duration = addslashes(trim($value[D]));
                $annual_fees = addslashes(trim($value[E]));
                $international_fees = addslashes(trim($value[F]));
                $eligibility = addslashes(trim($value[G]));
                $status = 1;
                $created_date = date('Y-m-d H:i:s');
                $updated_date = date('Y-m-d H:i:s');
                $query_count = "select id from tbl_college_course where college_id='".$college_id."' and stream_id='".$stream_id."' and course_id='".$course_id."'";
                $nums = $this->common_model->coreQueryObject($query_count);

               // $result_count   = custom_my_sql_query($con, $query_count) or die(custom_mysql_error($con));
               // $nums           = custom_my_sql_fetch_assoc($result_count);
                if(count($nums) > 0){
                    $id = $nums[0]->id;                  
                    $insert_cat = "update `tbl_college_course` set college_id='".$college_id."', course_id='".$course_id."', stream_id='".$stream_id."', duration='".$duration."', annual_fees='".$annual_fees."', international_fees='".$international_fees."', eligibility='".$eligibility."', status='".$status."',updated_date= '".$updated_date."' where id='".$id."'"; 
                    $nums1= $this->common_model->coreQueryObject($insert_cat); 
                    //echo $insert_cat."<br>";
                   /* $exe_insert_cat = custom_my_sql_query($con, $insert_cat) or die(custom_mysql_error($con));
                    $insert_id = custom_my_sql_insert_id($con); */                      
                }else{
                    $insert_cat = "INSERT INTO `tbl_college_course` set college_id='".$college_id."', course_id='".$course_id."', stream_id='".$stream_id."', duration='".$duration."', annual_fees='".$annual_fees."', international_fees='".$international_fees."', eligibility='".$eligibility."', status='".$status."',created_date= '".$created_date."',updated_date= '".$updated_date."'"; 
                    $nums2= $this->common_model->coreQueryObject($insert_cat); 
                   /* $exe_insert_cat = custom_my_sql_query($con, $insert_cat) or die(custom_mysql_error($con));
                    $insert_id = custom_my_sql_insert_id($con);*/
                }   
            }
            $i++;
         }               
         //$result = $this->mcourse->importdata($inserdata);   
         if($result){
           $this->session->set_flashdata('msg', '<p style="color:green">Data Import successfully!</p>');
                redirect('admin/College_Course');
         }else{
           $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/College_Course');
         }              
    }


}
