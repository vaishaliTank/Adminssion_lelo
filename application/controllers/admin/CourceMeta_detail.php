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


}
