<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $login_type = $this->session->userdata('aname');
        if ($login_type != 'admin') {
            header('location:' . base_url() . 'admin/alogin');
        }
         $this->load->model('madmin/m_dashboard', 'mdashboard');
    }

    public function index() {
         
        $data['total_user'] = 1;
        $this->load->view('admin/header');
        $this->load->view('admin/dashboard',$data);
        $this->load->view('admin/footer');
    }

}
