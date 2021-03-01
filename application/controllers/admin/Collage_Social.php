<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Collage_Social extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $login_type = $this->session->userdata('aname');
        if ($login_type != 'admin') {
            header('location:' . base_url() . 'admin/alogin');
        }
        $this->load->model('madmin/M_ClgSocial', 'clgsocial');
        $this->load->model('common_model');
        
    }

    public function index() { 
        $sql= "SELECT tbl_social_link.*,tbl_college.college_name FROM `tbl_social_link` left join tbl_college on tbl_college.college_id=tbl_social_link.college_id WHERE social_id != 0 ORDER BY social_id ASC";
        $data['sociallist'] = $this->common_model->coreQueryObject($sql);
        //echo "<PRE>";print_r($data['sociallist']);die;
        $this->load->view('admin/header');
        $this->load->view('admin/clg_social_list',$data);
        $this->load->view('admin/footer');
    }

    public function collegesocial_add(){
        $sql1 = "select college_id,college_name from tbl_college";
        $data['collage'] = $this->common_model->coreQueryObject($sql1);
        $this->load->view('admin/header');
        $this->load->view('admin/clgSocialadd',$data);
        $this->load->view('admin/footer');
    }

    public function saveCollage_social(){
        $post = $this->input->post();
        if(!empty($post)){
            $res = $this->clgsocial->saveCollage_Social($post);
            //echo "<PRE>";print_r($res);die;
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Collage Social added successfully!</p>');
                redirect('admin/Collage_Social');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_Social');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_Social');
        }
    }

    public function collegeS_edit($sid = NULL){
        if($sid != ''){
            $data['SocialDetails'] = $this->clgsocial->getClgSDetails($sid);
            $sql1 = "select college_id,college_name from tbl_college";
            $data['collage'] = $this->common_model->coreQueryObject($sql1);
            //echo "<PRE>";print_r($data['FaciltyDetails']);die;
            if($data['SocialDetails'] != ''){
                $this->load->view('admin/header');
                $this->load->view('admin/clgSocialadd', $data);
                $this->load->view('admin/footer');           
            }else{
                redirect('admin/Collage_Social');    
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Collage_Social');
        } 
    }

    

    public function updateCollage_social(){
        $post = $this->input->post();
        //echo "<PRE>";print_r($post);die;
        if($post){
            $res = $this->clgsocial->updateClgSocial($post);
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">College Social successfully updated!</p>');
                redirect('admin/Collage_Social');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_Social');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Collage_Social');
        }
    }

    

    public function delete($sId = NULL){
        if($sId != ''){
            $res = $this->clgsocial->deleteClgSocial($sId);
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Collage Social successfully deleted!</p>');
                redirect('admin/Collage_Social');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_Social');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Collage_Social');
        }
    }
}
