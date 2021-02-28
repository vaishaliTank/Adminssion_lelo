<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Collage_Facility extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $login_type = $this->session->userdata('aname');
        if ($login_type != 'admin') {
            header('location:' . base_url() . 'admin/alogin');
        }
        $this->load->model('madmin/M_Clgfacility', 'clgfacility');
        $this->load->model('common_model');
        
    }

    public function index() { 
        $sql= "SELECT tbl_college_facility.*,tbl_college.college_name FROM `tbl_college_facility` left join tbl_college on tbl_college.college_id=tbl_college_facility.college_id WHERE facility_id != 0 ORDER BY facility_fname ASC";
        $data['facilitylist'] = $this->common_model->coreQueryObject($sql);
        //echo "<PRE>";print_r($data['facilitylist']);die;
        $this->load->view('admin/header');
        $this->load->view('admin/facility_list',$data);
        $this->load->view('admin/footer');
    }

    public function clgfacility_add(){
        $sql1 = "select college_id,college_name from tbl_college";
        $data['collage'] = $this->common_model->coreQueryObject($sql1);
        $this->load->view('admin/header');
        $this->load->view('admin/clgFacility_add',$data);
        $this->load->view('admin/footer');
    }

    public function saveCollage_Facility(){
        $post = $this->input->post();
        if(!empty($post)){
            $res = $this->clgfacility->saveCollage_Facility($post);
            //echo "<PRE>";print_r($res);die;
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Collage Facility added successfully!</p>');
                redirect('admin/Collage_Facility');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_Facility');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_Facility');
        }
    }

    public function clgfacility_edit($facility_id = NULL){
        if($facility_id != ''){
            $data['FaciltyDetails'] = $this->clgfacility->getFaciltyDetails($facility_id);
            $sql1 = "select college_id,college_name from tbl_college";
            $data['collage'] = $this->common_model->coreQueryObject($sql1);
            //echo "<PRE>";print_r($data['testDetails']);die;
            if($data['FaciltyDetails'] != ''){
                $this->load->view('admin/header');
                $this->load->view('admin/clgFacility_add', $data);
                $this->load->view('admin/footer');           
            }else{
                redirect('admin/Collage_Facility');    
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Collage_Facility');
        } 
    }

    

    public function updateCollage_Facility(){
        $post = $this->input->post();
        if($post){
            $res = $this->clgfacility->updateTestimonials($post);
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">College Facility successfully updated!</p>');
                redirect('admin/Collage_Facility');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_Facility');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/testimonial');
        }
    }

    

    public function status($listid = NULL,$status){
        $post = $listid;
        if($post != ''){
            $result = $this->clgfacility->updateStatus($post,$status);
            if($result){
                $this->session->set_flashdata('msg', '<p style="color:green">Testimonial Update successfully!</p>');
                redirect('admin/Collage_Facility');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_Facility');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_Facility');
        }
        //echo json_encode($data);
    }

    

    public function delete($clgId = NULL){
        if($clgId != ''){
            $res = $this->clgfacility->deleteFacility($clgId);
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Collage Facility successfully deleted!</p>');
                redirect('admin/Collage_Facility');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_Facility');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Collage_Facility');
        }
    }
}
