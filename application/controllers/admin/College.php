<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class College extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $login_type = $this->session->userdata('aname');
        if ($login_type != 'admin') {
            header('location:' . base_url() . 'admin/alogin');
        }
        $this->load->library('excel');
        $this->load->model('madmin/m_college', 'mcollege');
         $this->load->model('common_model');
        
    }

    public function index() {         
        $data['collegeList'] = $this->mcollege->getCollegeList();
        $this->load->view('admin/header');
        $this->load->view('admin/college_list',$data);
        $this->load->view('admin/footer');
    }

    public function college_add(){
        $this->load->view('admin/header');
        $this->load->view('admin/college_add');
        $this->load->view('admin/footer');
    }

    public function saveCollege(){
        $post = $this->input->post();
        if(!empty($post)){
            $res = $this->mcollege->saveCollage($post);
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Collage added successfully!</p>');
                redirect('admin/college');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/college');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/college');
        }
    }

    public function college_edit($courseId = NULL){
        if($courseId != ''){
            $whereArr = array('college_id'=>$courseId);
            $data['collegeDetails'] = $this->common_model->getData('tbl_college',$whereArr);
            if($data['collegeDetails'] != ''){
                //print_r($data['collegeDetails']);die;
                //$data['streams'] = $this->mcourse->getStreams();
                $this->load->view('admin/header');
                $this->load->view('admin/college_add', $data);
                $this->load->view('admin/footer');           
            }else{
                redirect('admin/College');    
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/College');
        } 
    }

   public function delete($courseId = NULL){
        if($courseId != ''){
            $whereArr = array('college_id'=>$courseId);
            $res = $this->common_model->deleteData('tbl_college',$whereArr);
           
                $this->session->set_flashdata('msg', '<p style="color:green">College successfully deleted!</p>');
                redirect('admin/College');
         }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/College');
        }
    }

    public function updateCollege(){
        $post = $this->input->post();
        if($post){
            $res = $this->mcollege->updateCollege($post);
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Stream successfully updated!</p>');
                redirect('admin/College');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/College');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/College');
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
            $set = array('featured' => $status);
            $whr = array('college_id'=> $post);
        $this->common_model->updateData('tbl_college', $set, $whr);
            //$result = $this->mtestimonial->updateStatus($post,$status);
            
                $this->session->set_flashdata('msg', '<p style="color:green">Featured Update successfully!</p>');
                redirect('admin/College');
            
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/College');
        }
        //echo json_encode($data);
    }

     public function status1($testId = NULL,$status){
        $post = $testId;
        if($post != ''){
             if($status == 0){
                $status =1;
            }else{
                $status = 0;
            }
            $set = array('status' => $status);
            $whr = array('college_id'=> $post);
        $this->common_model->updateData('tbl_college', $set, $whr);
            //$result = $this->mtestimonial->updateStatus($post,$status);
            
                $this->session->set_flashdata('msg', '<p style="color:green">Status Update successfully!</p>');
                redirect('admin/College');
            
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/College');
        }
        //echo json_encode($data);
    }

    public function uploadview(){
        $this->load->view('admin/header');
        $this->load->view('admin/uploadcsv_collage');
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
         $i=1;
         //echo "<PRE>";print_r($allDataInSheet);die;
         foreach ($allDataInSheet as $value) {
            if($i != 1){
                $clg_array = array(
                        'college_name' => $value['A'],
                        'address1' => $value['B'],
                        'address2' => $value['C'],
                        'city' => $value['D'],
                        'state' =>$value['E'],
                        'zipcode' => $value['F'],
                        'phone1' => $value['G'],
                        'phone2' => $value['H'],
                        'fax' => $value['I'],
                        'aboutus' =>$value['J'],
                        'promotercontent' =>$value['K'],
                        'infrastructurecontent' =>$value['L'],
                        'sportscontent' =>$value['M'],
                        'transportationcontent' =>$value['N'],
                        'cafetariacontent' =>$value['O'],
                        'acivementcontent' =>$value['P'],
                        'placementcontent' =>$value['Q'],
                        'librarycontent' =>$value['R'],
                        'hostelcontent' =>$value['S'],
                        'meta_title' =>$value['T'],
                        'meta_keyword' =>$value['U'],
                        'meta_description' =>$value['V'],
                        'status'=> 1,
                        'created_date' => date('Y-m-d H:i:s'),
                        'updated_date' => date('Y-m-d H:i:s'),

                    );
                
                    $this->db->insert('tbl_college', $clg_array);

                
            }
            $i++;
         }               
         $this->session->set_flashdata('msg', '<p style="color:green">Data Import successfully!</p>');
                redirect('admin/college');
         /*if($result){
           $this->session->set_flashdata('msg', '<p style="color:green">Data Import successfully!</p>');
                redirect('admin/course');
         }else{
           $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/course');
         }     */        
         
         
         
    }
   
}
