<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {

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
        $sql = "SELECT * FROM `banner` ORDER BY sort_order asc";
        $data['List'] = $this->common_model->coreQueryObject($sql);

       // print_r($data['List']);die;
        //$data['List'] = $this->common_model->getData('tbl_college_stream_metadata','');
        $this->load->view('admin/header');
        $this->load->view('admin/banner_list', $data);
        $this->load->view('admin/footer');
    }

    public function banner_add(){
       
        $this->load->view('admin/header');
        $this->load->view('admin/banner_add');
        $this->load->view('admin/footer');
    }

    public function saveBanner(){
       // print_r($_POST);die;
        $test_array = array();
        if(!empty($_POST)){
              if(!empty($_FILES['event_image']['name'])){
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
                }
             
            $insertArr = array('title '=>$_POST['title'],'url'=>$_POST['url'],'target '=>$_POST['target'],'sort_order'=>$_POST['sort'],'image'=>$test_array['event_image'],'add_date'=>date('Y-m-d H:i:s'),'status'=>$_POST['publish'],'DisplayTime'=>$_POST['status'],'timezone'=>$_POST['timezone'],'FromDate'=>$_POST['sdate'],'ToDate'=>$_POST['edate']);
            $lastId = $this->common_model->insertData('banner',$insertArr);

            $this->session->set_flashdata('msg', '<p style="color:green">Banner added successfully!</p>');
                redirect('admin/Banner');
        }else{
             $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Banner');
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
            $set = array('status' => $status);
            //print_r($set);die;
            $whr = array('id'=> $post);
        $this->common_model->updateData('banner', $set, $whr);
       // echo $this->db->last_query();die;
            //$result = $this->mtestimonial->updateStatus($post,$status);
            
                $this->session->set_flashdata('msg', '<p style="color:green">Status Update successfully!</p>');
                redirect('admin/Banner');
            
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
                redirect('admin/Banner');
        }
        //echo json_encode($data);
    }


    public function delete($courseId = NULL){
        if($courseId != ''){
            $whereArr = array('id'=>$courseId);
            $res = $this->common_model->deleteData('banner',$whereArr);
           
                $this->session->set_flashdata('msg', '<p style="color:green">Banners data successfully deleted!</p>');
                redirect('admin/Banner');
         }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Banner');
        }
    }

    public function Banner_edit($courseId = NULL){
        if($courseId != ''){
            $whereArr = array('id'=>$courseId);
            $data['eventData'] = $this->common_model->getData('banner',$whereArr);
            //print_r($data['coursemetaDetails']);die;
            if($data['eventData'] != ''){
                
                $this->load->view('admin/header');
                $this->load->view('admin/banner_add', $data);
                $this->load->view('admin/footer');           
            }else{
                redirect('admin/Banner');    
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Banner');
        } 
    }

    public function updateBanner(){
        if(!empty($_POST)){
            if(!empty($_FILES['event_image']['name'])){
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
                }else{
                    $test_array['event_image'] = $_POST['old_image'];
                }
                $whereArr = array('id'=>$_POST['id']);
          
            $updateArr = array('title '=>$_POST['title'],'url'=>$_POST['url'],'target '=>$_POST['target'],'sort_order'=>$_POST['sort'],'image'=>$test_array['event_image'],'status'=>$_POST['publish'],'DisplayTime'=>$_POST['status']);
            //$this->common_model->insertData('news',$insertArr);
            $this->common_model->updateData('banner',$updateArr,$whereArr);
            $this->session->set_flashdata('msg', '<p style="color:green">Data successfully updated!</p>');
                redirect('admin/Banner');
        }else{
             $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Banner');
        }
        
    }

   

}
