<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $login_type = $this->session->userdata('aname');
        if ($login_type != 'admin') {
            header('location:' . base_url() . 'admin/alogin');
        }
        $this->load->model('common_model');
        $this->load->library('upload');


    }

    public function index()
    {
        $sql = "SELECT * FROM `pages` ORDER BY sort_order asc";
        $data['List'] = $this->common_model->coreQueryObject($sql);

       // print_r($data['List']);die;
        //$data['List'] = $this->common_model->getData('tbl_college_stream_metadata','');
        $this->load->view('admin/header');
        $this->load->view('admin/page_list', $data);
        $this->load->view('admin/footer');
    }

    public function page_add(){
       
        $this->load->view('admin/header');
        $this->load->view('admin/page_add');
        $this->load->view('admin/footer');
    }

    public function savePage(){
       // print_r($_POST);die;
        if(!empty($_POST)){
     
            $insertArr = array('title '=>$_POST['title'],'name '=>$_POST['name'],'content '=>$_POST['content'],'create_date'=>date('Y-m-d H:i:s'),'visible'=>1);
            $lastId = $this->common_model->insertData('pages',$insertArr);

            $this->session->set_flashdata('msg', '<p style="color:green">Event added successfully!</p>');
                redirect('admin/Page');
        }else{
             $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Page');
        }
    }

    public function status1($testId = NULL,$status){
        $post = $testId;
        if($post != ''){
            if($status == 0){
                $status =1;
            }else{
                $status = 0;
            }
            $set = array('visible' => $status);
            //print_r($set);die;
            $whr = array('id'=> $post);
        $this->common_model->updateData('pages', $set, $whr);
       // echo $this->db->last_query();die;
            //$result = $this->mtestimonial->updateStatus($post,$status);
            
                $this->session->set_flashdata('msg', '<p style="color:green">Status Update successfully!</p>');
                redirect('admin/Page');
            
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Page');
        }
        //echo json_encode($data);
    }


    public function delete($courseId = NULL){
        if($courseId != ''){
            $whereArr = array('id'=>$courseId);
            $res = $this->common_model->deleteData('pages',$whereArr);
           
                $this->session->set_flashdata('msg', '<p style="color:green">Pages data successfully deleted!</p>');
                redirect('admin/Page');
         }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Page');
        }
    }

    public function Page_edit($courseId = NULL){
        if($courseId != ''){
            $whereArr = array('id'=>$courseId);
            $data['pageData'] = $this->common_model->getData('pages',$whereArr);
            //print_r($data['coursemetaDetails']);die;
            if($data['pageData'] != ''){
                
                $this->load->view('admin/header');
                $this->load->view('admin/page_add', $data);
                $this->load->view('admin/footer');           
            }else{
                redirect('admin/Page');    
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Page');
        } 
    }

    public function updatePage(){
        if(!empty($_POST)){
        $whereArr = array('id'=>$_POST['id']);
          $updateArr = array('title '=>$_POST['title'],'name '=>$_POST['name'],'content '=>$_POST['content']);
            //$this->common_model->insertData('news',$insertArr);
            $this->common_model->updateData('pages',$updateArr,$whereArr);
            $this->session->set_flashdata('msg', '<p style="color:green">Data successfully updated!</p>');
                redirect('admin/Page');
        }else{
             $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Page');
        }
        
    }

   

}
