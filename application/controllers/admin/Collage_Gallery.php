<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Collage_Gallery extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $login_type = $this->session->userdata('aname');
        if ($login_type != 'admin') {
            header('location:' . base_url() . 'admin/alogin');
        }
        $this->load->model('madmin/M_ClgGallery', 'clggallery');
        $this->load->model('common_model');
        
    }

    public function index() { 
        $sql= "SELECT college_image.*,tbl_college.college_name, tbl_image_type.image_type_name FROM `college_image` left join tbl_college on tbl_college.college_id=college_image.college_id left join tbl_image_type on tbl_image_type.image_type_id = college_image.image_type  WHERE image_id != 0  group by college_name,image_type ORDER BY image_id ASC";
        $data['gallerylist'] = $this->common_model->coreQueryObject($sql);
        //echo "<PRE>";print_r($data['sociallist']);die;
        $this->load->view('admin/header');
        $this->load->view('admin/clg_gallery_list',$data);
        $this->load->view('admin/footer');
    }

    public function collegegallery_add(){
        $sql1 = "select college_id,college_name from tbl_college where status=1 order by college_name";
        $data['collage'] = $this->common_model->coreQueryObject($sql1);
        $sql2 = "select * from tbl_image_type order by image_type_name";
        $data['image'] = $this->common_model->coreQueryObject($sql2);
        $this->load->view('admin/header');
        $this->load->view('admin/clg_gallery_add',$data);
        $this->load->view('admin/footer');
    }

    public function saveCollage_gallery(){
        $post = $this->input->post();
        //echo "<PRE>";print_r($post);die;
        if(!empty($post)){
            $res = $this->clggallery->saveCollage_Gallery($post);
            //echo "<PRE>";print_r($res);die;
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Collage Gallery added successfully!</p>');
                redirect('admin/Collage_Gallery');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_Gallery');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_Gallery');
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

    

    public function delete($imageId = NULL,$imgtype){
        if($imageId != ''){
            $res = $this->clggallery->deleteClgGallery($imageId,$imgtype);
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Collage Gallery successfully deleted!</p>');
                redirect('admin/Collage_Gallery');
            }else{
                $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Collage_Gallery');
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Collage_Gallery');
        }
    }

    public function Gallery_View($imageid,$imaetype){
        $sql = "SELECT * FROM `college_image` WHERE image_id != 0 and college_id='".$imageid."' and image_type='".$imaetype."' ORDER BY image_id ASC ";
        $data['TotalData'] = $this->common_model->coreQueryObject($sql);
        $this->load->view('admin/header');
        $this->load->view('admin/galley_view',$data);
        $this->load->view('admin/footer');
    }
}
