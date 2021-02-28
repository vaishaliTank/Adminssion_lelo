<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('m_courses', 'mcourses');
    }

	public function index()
	{
		$data['courseList'] = $this->mcourses->getCourseList();
		$this->load->view('header');
		$this->load->view('courses', $data);
		$this->load->view('footer');
	}

	public function details($stream_name = NULL){
		if($stream_name != ''){
			$data['courseDetail'] = $this->mcourses->getCouseDetails($stream_name);
			if(!empty($data['courseDetail'])){
				$this->load->view('header');
				$this->load->view('course-detail', $data);
				$this->load->view('footer');
			}else{
				redirect('courses');
			}
		}else{
			redirect('courses');
		}
	}
}
