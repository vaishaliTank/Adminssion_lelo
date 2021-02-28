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
        $this->load->model('madmin/m_course', 'mcourse');
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
}
