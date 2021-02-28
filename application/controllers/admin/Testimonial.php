<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Testimonial extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $login_type = $this->session->userdata('aname');
        if ($login_type != 'admin') {
            header('location:' . base_url() . 'admin/alogin');
        }
        $this->load->model('madmin/m_testimonial', 'mtestimonial');
        $this->load->model('common_model');
        
    }

    public function index() { 
        $data['testimonialList'] = $this->mtestimonial->gettestimonialList();
        //echo "<PRE>";print_r($data['testimonialList']);die;
        $this->load->view('admin/header');
        $this->load->view('admin/testimonial_list',$data);
        $this->load->view('admin/footer');
    }

    public function testimonial_add(){
        $this->load->view('admin/header');
        $this->load->view('admin/testimonial_add');
        $this->load->view('admin/footer');
    }

    public function saveTestimonial(){
        $post = $this->input->post();
        if(!empty($post)){
            $res = $this->mtestimonial->saveTestimonial($post);
            //echo "<PRE>";print_r($res);die;
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Testimonial added successfully!</p>');
                redirect('admin/testimonial');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/testimonial');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/testimonial');
        }
    }

    public function testimonial_edit($testId = NULL){
        if($testId != ''){
            $data['testDetails'] = $this->mtestimonial->getTestimonialDetails($testId);
            //echo "<PRE>";print_r($data['testDetails']);die;
            if($data['testDetails'] != ''){
                $this->load->view('admin/header');
                $this->load->view('admin/testimonial_add', $data);
                $this->load->view('admin/footer');           
            }else{
                redirect('admin/testimonial');    
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/testimonial');
        } 
    }

    

    public function updateTestimonial(){
        $post = $this->input->post();
        if($post){
            $res = $this->mtestimonial->updateTestimonials($post);
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Testimonial successfully updated!</p>');
                redirect('admin/testimonial');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/testimonial');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/testimonial');
        }
    }

    

    public function status($testId = NULL,$status){
        $post = $testId;
        if($post != ''){
            $result = $this->mtestimonial->updateStatus($post,$status);
            if($result){
                $this->session->set_flashdata('msg', '<p style="color:green">Testimonial Update successfully!</p>');
                redirect('admin/testimonial');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/testimonial');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/testimonial');
        }
        //echo json_encode($data);
    }

    public function college_edit($collageId = NULL){
        if($streamId != ''){
            $where = array('college_id'=>$collageId);
            $data['streamDetails'] = $this->common_model->getData();
            if($data['streamDetails'] != ''){
                $this->load->view('admin/header');
                $this->load->view('admin/collage_edit', $data);
                $this->load->view('admin/footer');           
            }else{
                redirect('admin/college');    
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/college');
        } 
    }

    public function delete($testId = NULL){
        if($testId != ''){
            $res = $this->mtestimonial->deleteTestimonial($testId);
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Stream successfully deleted!</p>');
                redirect('admin/stream');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/stream');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/stream');
        }
    }
}
