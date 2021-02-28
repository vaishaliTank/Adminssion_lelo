<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stream extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $login_type = $this->session->userdata('aname');
        if ($login_type != 'admin') {
            header('location:' . base_url() . 'admin/alogin');
        }
        $this->load->model('madmin/m_stream', 'mstream');
    }

    public function index() {         
        $data['streamList'] = $this->mstream->getStreamList();
        $this->load->view('admin/header');
        $this->load->view('admin/stream_list',$data);
        $this->load->view('admin/footer');
    }

    public function stream_add(){
        $this->load->view('admin/header');
        $this->load->view('admin/stream_add');
        $this->load->view('admin/footer');
    }

    public function saveStream(){
        $post = $this->input->post();
        if(!empty($post)){
            $res = $this->mstream->saveStream($post);
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Stream successfully added!</p>');
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

    public function stream_edit($streamId = NULL){
        if($streamId != ''){
            $data['streamDetails'] = $this->mstream->getStreamDetails($streamId);
            if($data['streamDetails'] != ''){
                $this->load->view('admin/header');
                $this->load->view('admin/stream_add', $data);
                $this->load->view('admin/footer');           
            }else{
                redirect('admin/stream');    
            }
        }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/stream');
        } 
    }

    public function delete($streamId = NULL){
        if($streamId != ''){
            $res = $this->mstream->deleteStream($streamId);
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

    public function updateStream(){
        $post = $this->input->post();
        if($post){
            $res = $this->mstream->updateStream($post);
            if($res){
                $this->session->set_flashdata('msg', '<p style="color:green">Stream successfully updated!</p>');
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

    public function featured(){
        $post = $this->input->post();
        if($post['featured'] != '' && $post['stream_id'] != ''){
            $result = $this->mstream->updateFetured($post);
            if($result){
                $data['flag'] = 1;
                $data['msg'] = 'Stream successfully updated!';
            }else{
                $data['flag'] = 0;
                $data['msg'] = 'Something went wrong, Please try again!';
            }
        }else{
            $data['flag'] = 0;
            $data['msg'] = 'Something went wrong, Please try again!';
        }
        echo json_encode($data);
    }

    public function status(){
        $post = $this->input->post();
        if($post['status'] != '' && $post['stream_id'] != ''){
            $result = $this->mstream->updateStatus($post);
            if($result){
                $data['flag'] = 1;
                $data['msg'] = 'Stream successfully updated!';
            }else{
                $data['flag'] = 0;
                $data['msg'] = 'Something went wrong, Please try again!';
            }
        }else{
            $data['flag'] = 0;
            $data['msg'] = 'Something went wrong, Please try again!';
        }
        echo json_encode($data);
    }
}
