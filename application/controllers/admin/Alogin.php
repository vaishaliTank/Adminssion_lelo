<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alogin extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('madmin/m_login', 'objlogin');
    }

    public function index() {
      	$this->load->view('admin/login');
    }

    public function authentication() {
        $username = $this->input->post('email');
        $password = $this->input->post('password');
       
        if (strlen(trim(preg_replace('/\xb2\xa0/', '', $username))) == 0 || strlen(trim(preg_replace('/\xb2\xa0/', '', $password))) == 0) {
            $this->session->set_flashdata('msg', '<div class="col-md-12 text-red" style="padding: 0 0 10px 0;">Please enter Username or Password</div><br>');
            header('location:' . base_url() . 'admin/alogin');
        } else {
            $arr = array(
                'user_name' => $username,
                'password' => md5($password)
            );
            $data = $this->objlogin->user_login($arr);
          
            if ($data) {
                $session = array(
                    'aid' => $data['id'],
                    'username' => $data['user_name'],
                    'aname' => 'admin'
                );
                // print_r($session);die;
                $this->session->set_userdata($session);
                header('location:' . base_url() . 'admin/dashboard');
            } else {
                $this->session->set_flashdata('msg', '<div class="col-md-12 text-red" style="padding: 0 0 10px 0;">Username or Password is Wrong.</div><br>');
               
                header('location:' . base_url() . 'admin/alogin');
            }
        }
    }

    function logout() {
        $this->session->unset_userdata('aid');
        $this->session->unset_userdata('aname');
        $this->session->unset_userdata('username');
        header('location:' . base_url() . 'admin/alogin');
    }
}
