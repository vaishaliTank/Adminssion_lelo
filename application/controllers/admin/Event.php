<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

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
        $data['List'] = $this->common_model->getData('news','');
       // print_r($data['List']);die;
        //$data['List'] = $this->common_model->getData('tbl_college_stream_metadata','');
        $this->load->view('admin/header');
        $this->load->view('admin/event_list', $data);
        $this->load->view('admin/footer');
    }

    public function event_add(){
       
        $this->load->view('admin/header');
        $this->load->view('admin/event_add');
        $this->load->view('admin/footer');
    }

    public function saveEvent(){
       // print_r($_POST);die;
        if(!empty($_POST)){
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'jpg|png|jpeg|JPG|PNG|JPEG';
        $config['file_name'] = random_string('alnum', 16);
        
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('event_image')){
            $error = $this->upload->display_errors();
            $file_arr = array('error' => $error);
            $this->session->set_flashdata('msg', '<p style="color:red;">'.$file_arr.'</p>');
            return '';
        }else{
            $dt = array('upload_data'=>$this->upload->data());
            $test_array['event_image'] = $dt['upload_data']['file_name'];
        }


       /* //blob
         if(!$this->upload->do_upload('event_image')){
            $error = $this->upload->display_errors();
            $file_arr = array('error' => $error);
            $this->session->set_flashdata('msg', '<p style="color:red;">'.$file_arr.'</p>');
            return '';
        }else{
            $dt = array('upload_data'=>$this->upload->data());
            $test_array['event_image'] = $dt['upload_data']['file_name'];
        }*/


            $insertArr = array('title '=>$_POST['title'],'link_url '=>$_POST['url'],'start_date '=>$_POST['sdate'],'end_date'=>$_POST['edate'],'start_time'=>$_POST['start_time'],'end_time'=>$_POST['end_time'],'content'=>$_POST['content'],'status'=>$_POST['college_status'],'image'=>$test_array['event_image']);
            $this->common_model->insertData('news',$insertArr);
            $this->session->set_flashdata('msg', '<p style="color:green">Event added successfully!</p>');
                redirect('admin/Event');
        }else{
             $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Event');
        }
    }

    public function status($testId = NULL,$status){
        $post = $testId;
        if($post != ''){
             if($status == 0){
                $status =1;
            }else{
                $status = 0;
            }
            $set = array('status' => $status);
            $whr = array('id'=> $post);
        $this->common_model->updateData('news', $set, $whr);
            //$result = $this->mtestimonial->updateStatus($post,$status);
            
                $this->session->set_flashdata('msg', '<p style="color:green">Status Update successfully!</p>');
                redirect('admin/Event');
            
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Event');
        }
        //echo json_encode($data);
    }


    public function delete($courseId = NULL){
        if($courseId != ''){
            $whereArr = array('id'=>$courseId);
            $res = $this->common_model->deleteData('news',$whereArr);
           
                $this->session->set_flashdata('msg', '<p style="color:green">Event successfully deleted!</p>');
                redirect('admin/Event');
         }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Event');
        }
    }

    public function Event_edit($courseId = NULL){
        if($courseId != ''){
            $whereArr = array('id'=>$courseId);
            $data['eventData'] = $this->common_model->getData('news',$whereArr);
            //print_r($data['coursemetaDetails']);die;
            if($data['eventData'] != ''){
                
                $this->load->view('admin/header');
                $this->load->view('admin/event_add', $data);
                $this->load->view('admin/footer');           
            }else{
                redirect('admin/Event');    
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Event');
        } 
    }

    public function updateEvent(){
        if(!empty($_POST)){

             $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'jpg|png|jpeg|JPG|PNG|JPEG';
        $config['file_name'] = random_string('alnum', 16);
        
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('event_image')){
            $error = $this->upload->display_errors();
            $file_arr = array('error' => $error);
            $this->session->set_flashdata('msg', '<p style="color:red;">'.$file_arr.'</p>');
            return '';
        }else{
            $dt = array('upload_data'=>$this->upload->data());
            $test_array['event_image'] = $dt['upload_data']['file_name'];
        }


            $whereArr = array('id'=>$_POST['id']);
          $updateArr = array('title '=>$_POST['title'],'link_url '=>$_POST['url'],'start_date '=>$_POST['sdate'],'end_date'=>$_POST['edate'],'start_time'=>$_POST['start_time'],'end_time'=>$_POST['end_time'],'content'=>$_POST['content'],'status'=>$_POST['college_status'],'image'=>$test_array['event_image']);
            //$this->common_model->insertData('news',$insertArr);
            $this->common_model->updateData('news',$updateArr,$whereArr);
            $this->session->set_flashdata('msg', '<p style="color:green">Data successfully updated!</p>');
                redirect('admin/Event');
        }else{
             $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Event');
        }
        
    }

   

}
