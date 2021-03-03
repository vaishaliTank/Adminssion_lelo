<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Collage_Video extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $login_type = $this->session->userdata('aname');
        if ($login_type != 'admin') {
            header('location:' . base_url() . 'admin/alogin');
        }
        $this->load->model('madmin/M_ClgVideo', 'clgvideo');
        $this->load->model('common_model');
        
    }

    public function index() { 
        $sql= "SELECT tbl_college_video.*,tbl_college.college_name FROM `tbl_college_video` left join tbl_college on tbl_college.college_id=tbl_college_video.college_id WHERE video_id != 0 ORDER BY video_name ASC";
        $data['videolist'] = $this->common_model->coreQueryObject($sql);
        //echo "<PRE>";print_r($data['facilitylist']);die;
        $this->load->view('admin/header');
        $this->load->view('admin/clg_video_list',$data);
        $this->load->view('admin/footer');
    }

    public function collegevideo_add(){
        $sql1 = "select college_id,college_name from tbl_college where status=1 order by college_name";
        $data['collage'] = $this->common_model->coreQueryObject($sql1);
        $this->load->view('admin/header');
        $this->load->view('admin/clgVideoadd',$data);
        $this->load->view('admin/footer');
    }

    public function saveCollage_video(){
        $post = $this->input->post();
        if(!empty($post)){
            $res = $this->clgvideo->saveCollage_Video($post);
            //echo "<PRE>";print_r($res);die;
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Collage Video added successfully!</p>');
                redirect('admin/Collage_Video');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_Video');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_Video');
        }
    }

    public function collegeV_edit($vid = NULL){
        if($vid != ''){
            $data['VideoDetails'] = $this->clgvideo->getClgVDetails($vid);
            $sql1 = "select college_id,college_name from tbl_college where status=1 order by college_name";
            $data['collage'] = $this->common_model->coreQueryObject($sql1);
            //echo "<PRE>";print_r($data['FaciltyDetails']);die;
            if($data['VideoDetails'] != ''){
                $this->load->view('admin/header');
                $this->load->view('admin/clgVideoadd', $data);
                $this->load->view('admin/footer');           
            }else{
                redirect('admin/Collage_Video');    
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Collage_Video');
        } 
    }

    

    public function updateCollage_video(){
        $post = $this->input->post();
        if($post){
            $res = $this->clgvideo->updateClgVideo($post);
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">College Video successfully updated!</p>');
                redirect('admin/Collage_Video');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_Video');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Collage_Video');
        }
    }

    

    public function status($vid = NULL,$status){
        $post = $vid;
        if($post != ''){
            $result = $this->clgvideo->updateStatus($post,$status);
            if($result){
                $this->session->set_flashdata('msg', '<p style="color:green">College Video Update successfully!</p>');
                redirect('admin/Collage_Video');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_Video');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_Video');
        }
        //echo json_encode($data);
    }

    

    public function delete($vid = NULL){
        if($vid != ''){
            $res = $this->clgvideo->deleteClgVideo($vid);
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Collage Facility successfully deleted!</p>');
                redirect('admin/Collage_Video');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_Video');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Collage_Video');
        }
    }
}
