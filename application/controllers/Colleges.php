<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colleges extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('m_colleges', 'mcollege');
    }

	public function index()
	{
		$post = $this->input->post();
		if(!empty($post) && $post != ''){
			$data['collegeList'] = $this->mcollege->getSearchColleges($post);
		}else{
			$data['collegeList'] = $this->mcollege->getAllColleges();
		}

		$this->load->view('header');
		$this->load->view('colleges', $data);
		$this->load->view('footer');
	}

	public function details($college_name = NULL){
		if($college_name != ''){
			$data['collegeDetails'] = $this->mcollege->getCollegeDetails($college_name);
			if($data['collegeDetails'] != ''){
				$this->load->view('header');
				$this->load->view('college-detail', $data);
				$this->load->view('footer');
			}else{
				redirect('colleges');
			}
		}else{
			redirect('colleges');
		}
	}
}
