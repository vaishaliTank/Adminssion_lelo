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

    public function createxlsConsult(){
         $sql1 = "select *,sum(ACount) as acount,sum(bcount) as bcount   from (select *,
                        case WHEN counselling_apply ='Y' THEN 1 else 0 end as ACount, 
                        case WHEN counselling_apply !='Y' THEN 1  else 0 end as bcount
                        from tbl_counselor )  as a group by counselor_email";
        $ConsultList = $this->common_model->coreQueryObject($sql1);

        // load excel library
        $this->load->library('excel');
       // $mobiledata = $this->Common_model->mobileList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Mobile');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Stream');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Course');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Counselling Application'); 
         $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Last Updated'); 
          $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Course applied');       
        // set Row
        $rowCount = 2;
        $b=0;
        foreach ($ConsultList as $row) 
        {
            $stream = "SELECT * FROM tbl_stream WHERE stream_id='".$row->stream_id."'";
             //echo $stream;die;
             $streamData =  $this->common_model->coreQueryObject($stream);
            $course =  "SELECT * FROM tbl_course WHERE course_id='".$row->stream_id."'";
            $courseData =  $this->common_model->coreQueryObject($course);
           // print_r($college);
            //echo "<PRE>";print_r($stream);
            $streamName = '';
           if(!empty($streamData)){
            $streamName = $streamData[0]->stream_name;
           }
           $courseName = '';
           if(!empty($courseData)){
            $courseName = $courseData[0]->course_name;
           }

           $type = '';
            if($row->counselling_type == 'college'){
                $type = $courseName;
            }
            if($row->counselling_type =='stream'){
                $type = $row->course_id;
            }
            
            if($row->acount==1){$account ='Y';}else{ $account = 'N';}
             $newDate = date("d M Y  H:i", strtotime($row->updated_date));                                  

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row->counselor_email);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row->counselor_mobile);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row->counselor_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $streamName);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $type);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $account);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $newDate);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $row->bcount);
            $rowCount++;
             $b++;
        }
        $fileName = 'consult_list.xlsx';
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName);              
    
    }


    public function careerCounsellingList()
    {
       $fetch_category = "SELECT * FROM tbl_career_counselling WHERE id != 0 ORDER BY created_date DESC";
        $data['List'] = $this->common_model->coreQueryObject($fetch_category);

        $this->load->view('admin/header');
        $this->load->view('admin/career_counselling_list', $data);
        $this->load->view('admin/footer');
    }


    public function createxlsCounsle(){
       $sql2 = "SELECT * FROM tbl_career_counselling WHERE id != 0 ORDER BY created_date DESC";
        $CounsleList = $this->common_model->coreQueryObject($sql2);

        // load excel library
        $this->load->library('excel');
       // $mobiledata = $this->Common_model->mobileList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Mobile');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Date');     
        // set Row
        $rowCount = 2;
        $b=0;
        foreach ($CounsleList as $row) 
        {
            
             $newDate = date("d M Y  H:i", strtotime($row->created_date));                                  
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row->name);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row->email);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row->mobile);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $newDate);
           
            $rowCount++;
             $b++;
        }
        $fileName = 'career_counsle_list.xlsx';
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName); 
    }

    public function courseCounsellingList()
    {
       $fetch_category = "SELECT * FROM `tbl_course_counselling` ORDER BY created_date DESC";
        $data['List'] = $this->common_model->coreQueryObject($fetch_category);

        $this->load->view('admin/header');
        $this->load->view('admin/course_counselling_list', $data);
        $this->load->view('admin/footer');
    }

    public function createxlsCourse(){
        $sql3 = "SELECT * FROM `tbl_course_counselling` ORDER BY created_date DESC";
        $CourseList = $this->common_model->coreQueryObject($sql3);

        // load excel library
        $this->load->library('excel');
       // $mobiledata = $this->Common_model->mobileList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Mobile');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Stream');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Course');     
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Date');
        // set Row
        $rowCount = 2;
        $b=0;
        foreach ($CourseList as $row) 
        {
            
             $newDate = date("d M Y  H:i", strtotime($row->created_date));                                  
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row->name);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row->email);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row->mobile);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row->stream);
             $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row->course);
              $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $newDate);
           
            $rowCount++;
             $b++;
        }
        $fileName = 'course_counsle_list.xlsx';
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName); 
    }
    
    public function africaList()
    {
       $fetch_category = "SELECT * FROM `tbl_africa_course_counselling` ORDER BY created_date DESC";
        $data['List'] = $this->common_model->coreQueryObject($fetch_category);

        $this->load->view('admin/header');
        $this->load->view('admin/africa_course_counselling_list', $data);
        $this->load->view('admin/footer');
    }

    public function createxlsAfrica(){

        $sql4 = "SELECT * FROM `tbl_africa_course_counselling` ORDER BY created_date DESC";
        $africaCourseList = $this->common_model->coreQueryObject($sql4);

        // load excel library
        $this->load->library('excel');
       // $mobiledata = $this->Common_model->mobileList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Mobile');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Stream');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Course');     
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Date');
        // set Row
        $rowCount = 2;
        $b=0;
        foreach ($africaCourseList as $row) 
        {
            
             $newDate = date("d M Y  H:i", strtotime($row->created_date));                                  
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row->name);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row->email);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row->mobile);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row->stream);
             $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row->course);
              $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $newDate);
           
            $rowCount++;
             $b++;
        }
        $fileName = 'africaCourse_counsle_list.xlsx';
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName); 
    }

    public function MBAAdmissionList()
    {
       $fetch_category = "SELECT * FROM `tbl_mba_admission` WHERE id != 0 ORDER BY created_date DESC";
        $data['List'] = $this->common_model->coreQueryObject($fetch_category);

        $this->load->view('admin/header');
        $this->load->view('admin/mba_admission_list', $data);
        $this->load->view('admin/footer');
    }

    public function createxlsMBA(){

        $sql5 = "SELECT * FROM `tbl_mba_admission` WHERE id != 0 ORDER BY created_date DESC";
        $mbaList = $this->common_model->coreQueryObject($sql5);

        // load excel library
        $this->load->library('excel');
       // $mobiledata = $this->Common_model->mobileList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Mobile');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'City');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Course');     
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Date');
        // set Row
        $rowCount = 2;
        $b=0;
        foreach ($mbaList as $row) 
        {
            
             $newDate = date("d M Y  H:i", strtotime($row->created_date));                                  
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row->name);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row->email);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row->mobile);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row->city);
             $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row->course);
              $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $newDate);
           
            $rowCount++;
             $b++;
        }
        $fileName = 'MBA_counsle_list.xlsx';
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName);
    }

    public function contactusList()
    {
       $fetch_category = "SELECT *  FROM `tbl_contactus` ORDER BY created_date DESC";
        $data['List'] = $this->common_model->coreQueryObject($fetch_category);

        $this->load->view('admin/header');
        $this->load->view('admin/contactus_list', $data);
        $this->load->view('admin/footer');
    }

    public function createxlsContact(){

        $sql6 = "SELECT *  FROM `tbl_contactus` ORDER BY created_date DESC";
        $contactList = $this->common_model->coreQueryObject($sql6);

        // load excel library
        $this->load->library('excel');
       // $mobiledata = $this->Common_model->mobileList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Mobile');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Request Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Comments');     
        
        // set Row
        $rowCount = 2;
        $b=0;
        foreach ($contactList as $row) 
        {
            
             $newDate = date("d M Y  H:i", strtotime($row->created_date));                                  
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row->name);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row->email);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row->phone);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $newDate);
             $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row->comments);
            
           
            $rowCount++;
             $b++;
        }
        $fileName = 'Contact_list.xlsx';
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName);
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

    public function createxlsNews(){

        $sql7 = "SELECT *  FROM `tbl_newsletter` ORDER BY created_date ASC";
        $newsList = $this->common_model->coreQueryObject($sql7);

        // load excel library
        $this->load->library('excel');
       // $mobiledata = $this->Common_model->mobileList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Date');
          
        
        // set Row
        $rowCount = 2;
        $b=0;
        foreach ($newsList as $row) 
        {
            
             $newDate = date("d M Y  H:i", strtotime($row->created_date));                                  
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row->email);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $newDate);
           
            
           
            $rowCount++;
             $b++;
        }
        $fileName = 'newsLetter_list.xlsx';
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName);
    }

     public function registrationList()
    {
       $fetch_category = "SELECT *  FROM `tbl_user` ORDER BY created_date DESC";
        $data['List'] = $this->common_model->coreQueryObject($fetch_category);

        $this->load->view('admin/header');
        $this->load->view('admin/registration_list', $data);
        $this->load->view('admin/footer');
    }

    public function createxlsRegister(){
        $sql8 = "SELECT *  FROM `tbl_user` ORDER BY created_date DESC";
        $registerList = $this->common_model->coreQueryObject($sql8);

        // load excel library
        $this->load->library('excel');
       // $mobiledata = $this->Common_model->mobileList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', "Father's Name");
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Qualification');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Stream');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Email'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Phone');     
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Created On'); 
       
        // set Row
        $rowCount = 2;
        $b=0;
        foreach ($registerList as $row) 
        {
            
             $newDate = date("d M Y  H:i", strtotime($row->created_date));                                  
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row->uname);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row->fname);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row->qualification);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row->stream);
             $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row->email);
             $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $row->phone);
              $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $newDate);
           
            $rowCount++;
             $b++;
        }
        $fileName = 'register_list.xlsx';
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName);
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