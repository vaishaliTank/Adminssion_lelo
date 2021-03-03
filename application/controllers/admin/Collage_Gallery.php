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

    public function collegeSG_edit($cid = NULL,$imgtype){
        if($cid != ''){
            $data['GalleryDetails'] = $this->clggallery->getClgGDetails($cid,$imgtype);
            //echo "<PRE>";print_r($data['FaciltyDetails']);die;
            if($data['GalleryDetails'] != ''){
                $this->load->view('admin/header');
                $this->load->view('admin/clg_gallery_add', $data);
                $this->load->view('admin/footer');           
            }else{
                redirect('admin/Collage_Gallery');    
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Collage_Gallery');
        } 
    }

    

    public function updateCollage_gallery(){
        $post = $this->input->post();
        //echo "<PRE>";print_r($post);die;
        if($post){
            $res = $this->clggallery->updateClgGallery($post);
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">College Gallery successfully updated!</p>');
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

    public function deleteImage($clgid,$img_type,$img_id){
        if($img_id != ''){
            $res = $this->clggallery->deleteClgGalleryImage($clgid,$img_type,$img_id);
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

    public function setFeatured(){
        $image_id=$_POST['image_id'];
        $cid=$_POST['cid'];
        $featured=$_POST['image_featured_vl'];
        $test_array = array(
            'featured' => $featured,
        );
        $this->db->update('college_image', $test_array, array('image_id' => $image_id));
        if($this->db->affected_rows()){
            echo "Success";
        }
        
    }

    public function setHomeFeatured(){
        $image_id=$_POST['image_id'];
        $cid=$_POST['cid'];
        $featured=$_POST['image_featured_vl'];
        $rest=0;
        if($featured==1){
            $where = array('home_featured'=>1);
            $checkcounsult = $this->common_model->getData('college_image',$where);
            //$checkcounsult=mysqli_query($con,"select * from college_image where home_featured='1'");
            if(count($checkcounsult)>=8){
                $rest=1;            
            }
        }
        if($rest==1){   
                echo "You can not featured image more than 8";
        }else{ 
            $test_array = array(
                'home_featured' => $featured,
            );
            $this->db->update('college_image', $test_array, array('image_id' => $image_id));
            if($this->db->affected_rows()){
                echo "Success";
            } 
            
        }
    }


}
