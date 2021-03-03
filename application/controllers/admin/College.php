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


   
}
