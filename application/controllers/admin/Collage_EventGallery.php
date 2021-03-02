<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Collage_EventGallery extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $login_type = $this->session->userdata('aname');
        if ($login_type != 'admin') {
            header('location:' . base_url() . 'admin/alogin');
        }
        $this->load->model('madmin/M_ClgEventGallery', 'clgeventgallery');
        $this->load->model('common_model');
        
    }

    public function index() { 
        $sql= "SELECT *  FROM `gallery_image` ORDER BY id desc";
        $data['Eventgallerylist'] = $this->common_model->coreQueryObject($sql);
        //echo "<PRE>";print_r($data['sociallist']);die;
        $this->load->view('admin/header');
        $this->load->view('admin/clg_eventgallery_list',$data);
        $this->load->view('admin/footer');
    }

    public function collegegalleryE_add(){
        
        $this->load->view('admin/header');
        $this->load->view('admin/clg_galleryEvent_add');
        $this->load->view('admin/footer');
    }

    public function saveCollageE_gallery(){
        $post = $this->input->post();
        //echo "<PRE>";print_r($post);die;
        if(!empty($post)){
            $res = $this->clgeventgallery->saveCollageEvent_Gallery($post);
            //echo "<PRE>";print_r($res);die;
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Collage Event Gallery added successfully!</p>');
                redirect('admin/Collage_EventGallery');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_EventGallery');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_EventGallery');
        }
    }

    public function collegeGE_edit($sid = NULL){
        if($sid != ''){
            $data['eventGDetails'] = $this->clgeventgallery->getClgGEDetails($sid);
            
            //echo "<PRE>";print_r($data['FaciltyDetails']);die;
            if($data['eventGDetails'] != ''){
                $this->load->view('admin/header');
                $this->load->view('admin/clg_galleryEvent_add', $data);
                $this->load->view('admin/footer');           
            }else{
                redirect('admin/Collage_EventGallery');    
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Collage_EventGallery');
        } 
    }

    

    public function updateCollageE_gallery(){
        $post = $this->input->post();
        //echo "<PRE>";print_r($post);die;
        if($post){
            $res = $this->clgeventgallery->updateClgGalleryEvent($post);
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">College Gallery Event successfully updated!</p>');
                redirect('admin/Collage_EventGallery');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_EventGallery');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Collage_EventGallery');
        }
    }

    

    public function delete($imageId = NULL){
        if($imageId != ''){
            $res = $this->clgeventgallery->deleteClgGalleryEvent($imageId);
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Collage Gallery Event successfully deleted!</p>');
                redirect('admin/Collage_EventGallery');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_EventGallery');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Collage_EventGallery');
        }
    }

    
}
