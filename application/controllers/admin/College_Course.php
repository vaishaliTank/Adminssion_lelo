<?php
require_once APPPATH."/third_party/PHPExcel.php"; 
defined('BASEPATH') OR exit('No direct script access allowed');

class College_Course extends CI_Controller {

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
        $sql = "SELECT tbl_college_course.*,tbl_college.college_name,tbl_course.course_name,tbl_stream.stream_name  FROM tbl_college_course left join tbl_college on tbl_college.college_id=tbl_college_course.college_id left join tbl_course on tbl_course.courseid=tbl_college_course.course_id left join tbl_stream on tbl_stream.stream_id=tbl_college_course.stream_id ORDER BY college_name ASC";
        $data['List'] = $this->common_model->coreQueryObject($sql);
       // print_r($data['List']);die;
        //$data['List'] = $this->common_model->getData('tbl_college_stream_metadata','');
        $this->load->view('admin/header');
        $this->load->view('admin/college_course_list', $data);
        $this->load->view('admin/footer');
    }

    public function course_add(){
        $data['streams'] = $this->common_model->getData('tbl_stream');
        $data['college'] = $this->common_model->getData('tbl_college');
        $data['course'] = $this->common_model->getData('tbl_course');
        $this->load->view('admin/header');
        $this->load->view('admin/college_course_add', $data);
        $this->load->view('admin/footer');
    }

    public function saveCollegeCourse(){
       // print_r($_POST);die;
        if(!empty($_POST)){
            $insertArr = array('college_id '=>$_POST['college'],'course_id '=>$_POST['Course'],'stream_id '=>$_POST['stream'],'duration'=>$_POST['duration'],'annual_fees'=>$_POST['annual'],'international_fees'=>$_POST['international'],'eligibility'=>$_POST['eligibility'],'status'=>$_POST['college_status'],'created_date' => date('Y-m-d H:i:s'),'updated_date' => date('Y-m-d H:i:s'));
            $this->common_model->insertData('tbl_college_course',$insertArr);
            $this->session->set_flashdata('msg', '<p style="color:green">College Course added successfully!</p>');
                redirect('admin/College_Course');
        }else{
             $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/College_Course');
        }
    }

    public function status($testId = NULL,$status){
        $post = $testId;
        if($post != ''){
             if($status == 0){
                $status =1;
            }else{
                $status = 0;
            }
            $set = array('status' => $status);
            $whr = array('id'=> $post);
        $this->common_model->updateData('tbl_college_course', $set, $whr);
            //$result = $this->mtestimonial->updateStatus($post,$status);
            
                $this->session->set_flashdata('msg', '<p style="color:green">Status Update successfully!</p>');
                redirect('admin/College_Course');
            
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/College_Course');
        }
        //echo json_encode($data);
    }


    public function delete($courseId = NULL){
        if($courseId != ''){
            $whereArr = array('id'=>$courseId);
            $res = $this->common_model->deleteData('tbl_college_course',$whereArr);
           
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
            $data['coursemetaDetails'] = $this->common_model->getData('tbl_college_course',$whereArr);
            //print_r($data['coursemetaDetails']);die;
            if($data['coursemetaDetails'] != ''){
                $data['streams'] = $this->common_model->getData('tbl_stream');
                $data['college'] = $this->common_model->getData('tbl_college');
                $data['course'] = $this->common_model->getData('tbl_course');
                $this->load->view('admin/header');
                $this->load->view('admin/college_course_add', $data);
                $this->load->view('admin/footer');           
            }else{
                redirect('admin/College_Course');    
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/College_Course');
        } 
    }

    public function updateCollegeCourse(){
        if(!empty($_POST)){
            $whereArr = array('id'=>$_POST['id']);
           $updateArr = array('college_id '=>$_POST['college'],'course_id '=>$_POST['Course'],'stream_id '=>$_POST['stream'],'duration'=>$_POST['duration'],'annual_fees'=>$_POST['annual'],'international_fees'=>$_POST['international'],'eligibility'=>$_POST['eligibility'],'status'=>$_POST['college_status'],'updated_date' => date('Y-m-d H:i:s'));
            $this->common_model->updateData('tbl_college_course',$updateArr,$whereArr);
            $this->session->set_flashdata('msg', '<p style="color:green">Data successfully updated!</p>');
                redirect('admin/College_Course');
        }else{
             $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/College_Course');
        }
        
    }

    public function createxls(){
        // load excel library
        $this->load->library('excel');
       // $mobiledata = $this->Common_model->mobileList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Colllage Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Course Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Stream Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Duration');
        
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Annual Fees');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'International Fees');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Eligibility');
        $sql = "SELECT tbl_college_course.*,tbl_college.college_name,tbl_course.course_name,tbl_stream.stream_name  FROM tbl_college_course left join tbl_college on tbl_college.college_id=tbl_college_course.college_id left join tbl_course on tbl_course.courseid=tbl_college_course.course_id left join tbl_stream on tbl_stream.stream_id=tbl_college_course.stream_id ORDER BY college_name ASC";
        $List = $this->common_model->coreQueryObject($sql);
        //echo "<PRE>";print_r($List);die;
       $rowCount = 2;
        $b = 1;
        foreach ($List as $val) 
        {
            
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $val->college_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val->course_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val->stream_name);
            
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val->duration);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val->annual_fees);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $val->international_fees);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $val->eligibility);
            
            $rowCount++;
            $b++;
        }
        $fileName = 'Collage_CourseList.xlsx';
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName);              
    
    }

    public function uploadview(){
        $this->load->view('admin/header');
        $this->load->view('admin/csv_college_course');
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
