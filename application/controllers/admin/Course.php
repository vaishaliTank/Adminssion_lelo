<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Course extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $login_type = $this->session->userdata('aname');
        if ($login_type != 'admin') {
            header('location:' . base_url() . 'admin/alogin');
        }
        $this->load->library('excel');
        $this->load->model('madmin/m_course', 'mcourse');
        $this->load->model('common_model');
    }

    public function index() {         
        $data['courseList'] = $this->mcourse->getCourseList();
        $this->load->view('admin/header');
        $this->load->view('admin/course_list',$data);
        $this->load->view('admin/footer');
    }

    public function course_add(){
        $data['streams'] = $this->mcourse->getStreams();
        $this->load->view('admin/header');
        $this->load->view('admin/course_add', $data);
        $this->load->view('admin/footer');
    }

    public function saveCourse(){
        $post = $this->input->post();
        if(!empty($post)){
            $res = $this->mcourse->saveCourse($post);
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Course added successfully!</p>');
                redirect('admin/course');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/course');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/course');
        }
    }

    public function course_edit($courseId = NULL){
        if($courseId != ''){
            $data['courseDetails'] = $this->mcourse->getCourseDetails($courseId);
            if($data['courseDetails'] != ''){
                $data['streams'] = $this->mcourse->getStreams();
                $this->load->view('admin/header');
                $this->load->view('admin/course_add', $data);
                $this->load->view('admin/footer');           
            }else{
                redirect('admin/course');    
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/course');
        } 
    }

    public function delete($courseId = NULL){
        if($courseId != ''){
            $res = $this->mcourse->deleteCourse($courseId);
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Course successfully deleted!</p>');
                redirect('admin/course');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/course');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/course');
        }
    }

    public function updateCourse(){
        $post = $this->input->post();
        if($post){
            $res = $this->mcourse->updateCourse($post);
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Stream successfully updated!</p>');
                redirect('admin/course');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/course');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/course');
        }
    }

    public function featured(){
        $post = $this->input->post();
        if($post['featured'] != '' && $post['stream_id'] != ''){
            $result = $this->mcourse->updateFetured($post);
            if($result){
                $data['flag'] = 1;
                $data['msg'] = 'Stream successfully updated!';
            }else{
                $data['flag'] = 0;
                $data['msg'] = 'Something went wrong, Please try again!';
            }
        }else{
            $data['flag'] = 0;
            $data['msg'] = 'Something went wrong, Please try again!';
        }
        echo json_encode($data);
    }

    public function status(){
        $post = $this->input->post();
        if($post['status'] != '' && $post['course_id'] != ''){
            $result = $this->mcourse->updateStatus($post);
            if($result){
                $data['flag'] = 1;
                $data['msg'] = 'Course successfully updated!';
            }else{
                $data['flag'] = 0;
                $data['msg'] = 'Something went wrong, Please try again!';
            }
        }else{
            $data['flag'] = 0;
            $data['msg'] = 'Something went wrong, Please try again!';
        }
        echo json_encode($data);
    }

    public function createxls(){
        // load excel library
        $this->load->library('excel');
       // $mobiledata = $this->Common_model->mobileList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'ID');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Course Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Stream ID');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Stream Name');
        $courseList = $this->mcourse->getCourseList();   
        //echo "<PRE>";print_r($courseList);die;
       $rowCount = 2;
        $b = 1;
        foreach ($courseList as $val) 
        {
            
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $b);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val->courseid);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val->course_name);
            
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val->stream_id);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val->stream_name);
            $rowCount++;
            $b++;
        }
        $fileName = 'CourseList.xlsx';
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName);              
    
    }

    public function uploadview(){
        $this->load->view('admin/header');
        $this->load->view('admin/uploadcsv_course');
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
                $source_array = array(
                    'course_name' => $value['C'],
                    'courseid' => $value['B'],
                    'stream_id' => $value['D'],
                    'status' => 1,
                    'created_date' => date('Y-m-d H:i:s'),
                    'updated_date' => date('Y-m-d H:i:s'),
                );
                $where = array('stream_id'=>$value['D'],'courseid'=>$value['B']);
                $getData = $this->common_model->getData('tbl_course',$where);
                if(count($getData) == 0){
                    $this->db->insert('tbl_course', $source_array);
                }else{
                    $this->db->update('tbl_course', $source_array, array('course_id' => $value['B']));
                }
            }
            $i++;
         }               
         $this->session->set_flashdata('msg', '<p style="color:green">Data Import successfully!</p>');
                redirect('admin/course');
         /*if($result){
           $this->session->set_flashdata('msg', '<p style="color:green">Data Import successfully!</p>');
                redirect('admin/course');
         }else{
           $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/course');
         }     */        
         
         
         
    }

}
