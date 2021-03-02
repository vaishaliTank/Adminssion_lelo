<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Lead extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $login_type = $this->session->userdata('aname');
        if ($login_type != 'admin') {
            header('location:' . base_url() . 'admin/alogin');
        }
        $this->load->model('common_model');
        $this->load->library('upload');


    }

    public function ConsultList()
    {
        $sql = "select *,sum(ACount) as acount,sum(bcount) as bcount   from (select *,
                        case WHEN counselling_apply ='Y' THEN 1 else 0 end as ACount, 
                        case WHEN counselling_apply !='Y' THEN 1  else 0 end as bcount
                        from tbl_counselor )  as a group by counselor_email";
        $data['List'] = $this->common_model->coreQueryObject($sql);

        $this->load->view('admin/header');
        $this->load->view('admin/consult_list', $data);
        $this->load->view('admin/footer');
    }

    public function careerCounsellingList()
    {
       $fetch_category = "SELECT * FROM tbl_career_counselling WHERE id != 0 ORDER BY created_date DESC";
        $data['List'] = $this->common_model->coreQueryObject($fetch_category);

        $this->load->view('admin/header');
        $this->load->view('admin/career_counselling_list', $data);
        $this->load->view('admin/footer');
    }

    public function courseCounsellingList()
    {
       $fetch_category = "SELECT * FROM `tbl_course_counselling` ORDER BY created_date DESC";
        $data['List'] = $this->common_model->coreQueryObject($fetch_category);

        $this->load->view('admin/header');
        $this->load->view('admin/course_counselling_list', $data);
        $this->load->view('admin/footer');
    }

    public function africaList()
    {
       $fetch_category = "SELECT * FROM `tbl_africa_course_counselling` ORDER BY created_date DESC";
        $data['List'] = $this->common_model->coreQueryObject($fetch_category);

        $this->load->view('admin/header');
        $this->load->view('admin/africa_course_counselling_list', $data);
        $this->load->view('admin/footer');
    }

    public function MBAAdmissionList()
    {
       $fetch_category = "SELECT * FROM `tbl_mba_admission` WHERE id != 0 ORDER BY created_date DESC";
        $data['List'] = $this->common_model->coreQueryObject($fetch_category);

        $this->load->view('admin/header');
        $this->load->view('admin/mba_admission_list', $data);
        $this->load->view('admin/footer');
    }

    public function contactusList()
    {
       $fetch_category = "SELECT *  FROM `tbl_contactus` ORDER BY created_date DESC";
        $data['List'] = $this->common_model->coreQueryObject($fetch_category);

        $this->load->view('admin/header');
        $this->load->view('admin/contactus_list', $data);
        $this->load->view('admin/footer');
    }

    public function deleteContact($courseId = NULL){
         if($courseId != ''){
            $whereArr = array('contact_id'=>$courseId);
            $res = $this->common_model->deleteData('tbl_contactus',$whereArr);
           
                $this->session->set_flashdata('msg', '<p style="color:green">Contact successfully deleted!</p>');
                redirect('admin/Lead/contactusList');
         }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Lead/contactusList');
        }
    }

    public function newsletterList()
    {
       $fetch_category = "SELECT *  FROM `tbl_newsletter` ORDER BY created_date ASC";
        $data['List'] = $this->common_model->coreQueryObject($fetch_category);

        $this->load->view('admin/header');
        $this->load->view('admin/newsletter_list', $data);
        $this->load->view('admin/footer');
    }

     public function registrationList()
    {
       $fetch_category = "SELECT *  FROM `tbl_user` ORDER BY created_date DESC";
        $data['List'] = $this->common_model->coreQueryObject($fetch_category);

        $this->load->view('admin/header');
        $this->load->view('admin/registration_list', $data);
        $this->load->view('admin/footer');
    }

    public function deleteUser($courseId = NULL){
        if($courseId != ''){
            $whereArr = array('user_id'=>$courseId);
            $res = $this->common_model->deleteData('tbl_user',$whereArr);
           
                $this->session->set_flashdata('msg', '<p style="color:green">User successfully deleted!</p>');
                redirect('admin/Lead/registrationList');
         }else{
            $this->session->set_flashdata('msg', '<p style="color:red">Something went wrong, Please try again!</p>');
            redirect('admin/Lead/registrationList');
        }
    }
}