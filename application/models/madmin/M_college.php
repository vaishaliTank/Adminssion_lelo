<?php
class M_college extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('upload');
    }

    function getCollegeList(){
    	$sqlQuery = "SELECT * FROM `tbl_college` WHERE college_id != 0 ORDER BY college_name";
    	$sql = $this->db->query($sqlQuery);
    	if($sql->num_rows() > 0){
    		return $sql->result();
    	}else{
    		return '';
    	}
    }

    function saveCollage($post){
    	$collage_name = addslashes(trim($post['college_name']));
		$address1 = addslashes(trim($post['address1']));
		$address2 = addslashes(trim($post['address2']));
        $city = addslashes(trim($post['city']));
        $state = addslashes(trim($post['state']));
        $zipcode = addslashes(trim($post['zipcode']));
        $phone1 = addslashes(trim($post['phone1']));
        $phone2 = addslashes(trim($post['phone2']));
        $fax = addslashes(trim($post['fax']));
       // $feature = addslashes(trim($post['featured']));
        $aboutus = addslashes(trim($post['aboutus']));
        $promotercontent = addslashes(trim($post['promotercontent']));
        $infrastructurecontent = addslashes(trim($post['infrastructurecontent']));
        $sportscontent = addslashes(trim($post['sportscontent']));
        $transportationcontent = addslashes(trim($post['transportationcontent']));
        $cafetariacontent = addslashes(trim($post['cafetariacontent']));
        $acivementcontent = addslashes(trim($post['acivementcontent']));
        $placementcontent = addslashes(trim($post['placementcontent']));
        $librarycontent = addslashes(trim($post['librarycontent']));
        $hostelcontent = addslashes(trim($post['hostelcontent']));
        $meta_title = addslashes(trim($post['metatitle']));
        $meta_keyword = addslashes(trim($post['metakeyword']));
        $meta_description = addslashes(trim($post['metadescription']));
		$status = isset($post['college_status']) ? 1 : 0;
        $featured = isset($post['featured']) ? 1 : 0;



        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'jpg|png|jpeg|JPG|PNG|JPEG';
        $config['file_name'] = random_string('alnum', 16);
        
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('college_image')){
            $error = $this->upload->display_errors();
            $file_arr = array('error' => $error);
            $this->session->set_flashdata('msg', '<p style="color:red;">'.$file_arr.'</p>');
            return '';
        }else{
            $dt = array('upload_data'=>$this->upload->data());
            $test_array['college_image'] = $dt['upload_data']['file_name'];
        }

    	$clg_array = array(
    		'college_name' => $collage_name,
    		'address1' => $address1,
    		'address2' => $address2,
    		'city' => $city,
            'state' => $state,
            'zipcode' => $zipcode,
            'phone1' => $phone1,
            'phone2' => $phone2,
            'fax' => $fax,
            'college_image' => $test_array['college_image'],
            'aboutus' =>$aboutus,
            'promotercontent' =>$promotercontent,
            'infrastructurecontent' =>$infrastructurecontent,
            'sportscontent' =>$sportscontent,
            'transportationcontent' =>$transportationcontent,
            'cafetariacontent' =>$cafetariacontent,
            'acivementcontent' =>$acivementcontent,
            'placementcontent' =>$placementcontent,
            'librarycontent' =>$librarycontent,
            'hostelcontent' =>$hostelcontent,
            'meta_title' =>$meta_title,
            'meta_keyword' =>$meta_keyword,
            'meta_description' =>$meta_description,
            'status'=> $status,
            'featured' =>$featured,
    		'created_date' => date('Y-m-d H:i:s'),
    		'updated_date' => date('Y-m-d H:i:s'),

    	);

    	$this->db->insert('tbl_college', $clg_array);
       // echo $this->db->last_query();die;
    	$collageId = $this->db->insert_id();
    	if($courseId){
    		return $collageId;
    	}else{
    		return '';
    	}
    }

    function updateCollege($post){
        if(!empty($_FILES['college_image']['name'])){
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|PNG|JPEG';
            $config['file_name'] = random_string('alnum', 16);
            
            $this->upload->initialize($config);

            if(!$this->upload->do_upload('college_image')){
                $error = $this->upload->display_errors();
                $file_arr = array('error' => $error);
                $this->session->set_flashdata('msg', '<p style="color:red;">'.$file_arr.'</p>');
                return '';
            }else{
                $dt = array('upload_data'=>$this->upload->data());
                $test_array['college_image'] = $dt['upload_data']['file_name'];
            }
        }else{
            $test_array['college_image'] = $_POST['old_image'];
        }

    	$collage_name = addslashes(trim($post['college_name']));
        $address1 = addslashes(trim($post['address1']));
        $address2 = addslashes(trim($post['address2']));
        $city = addslashes(trim($post['city']));
        $state = addslashes(trim($post['state']));
        $zipcode = addslashes(trim($post['zipcode']));
        $phone1 = addslashes(trim($post['phone1']));
        $phone2 = addslashes(trim($post['phone2']));
        $fax = addslashes(trim($post['fax']));
       // $feature = addslashes(trim($post['featured']));
        $aboutus = addslashes(trim($post['aboutus']));
        $promotercontent = addslashes(trim($post['promotercontent']));
        $infrastructurecontent = addslashes(trim($post['infrastructurecontent']));
        $sportscontent = addslashes(trim($post['sportscontent']));
        $transportationcontent = addslashes(trim($post['transportationcontent']));
        $cafetariacontent = addslashes(trim($post['cafetariacontent']));
        $acivementcontent = addslashes(trim($post['acivementcontent']));
        $placementcontent = addslashes(trim($post['placementcontent']));
        $librarycontent = addslashes(trim($post['librarycontent']));
        $hostelcontent = addslashes(trim($post['hostelcontent']));
        $meta_title = addslashes(trim($post['metatitle']));
        $meta_keyword = addslashes(trim($post['metakeyword']));
        $meta_description = addslashes(trim($post['metadescription']));
        $status = isset($post['college_status']) ? 1 : 0;
        $featured = isset($post['featured']) ? 1 : 0;

        $clg_array = array(
            'college_name' => $collage_name,
            'address1' => $address1,
            'address2' => $address2,
            'city' => $city,
            'state' => $state,
            'zipcode' => $zipcode,
            'phone1' => $phone1,
            'phone2' => $phone2,
            'fax' => $fax,
            'college_image' => $test_array['college_image'],
            'aboutus' =>$aboutus,
            'promotercontent' =>$promotercontent,
            'infrastructurecontent' =>$infrastructurecontent,
            'sportscontent' =>$sportscontent,
            'transportationcontent' =>$transportationcontent,
            'cafetariacontent' =>$cafetariacontent,
            'acivementcontent' =>$acivementcontent,
            'placementcontent' =>$placementcontent,
            'librarycontent' =>$librarycontent,
            'hostelcontent' =>$hostelcontent,
            'meta_title' =>$meta_title,
            'meta_keyword' =>$meta_keyword,
            'meta_description' =>$meta_description,
            'status'=> $status,
            'featured' =>$featured,
            'created_date' => date('Y-m-d H:i:s'),
            'updated_date' => date('Y-m-d H:i:s'),

        );

        $this->db->update('tbl_college', $clg_array, array('college_id' => $post['college_id']));
        //echo $this->db->last_query();die;
        if($this->db->affected_rows()){
            return true;
        }else{
            return '';
        }
    }

    function deleteCourse($courseId){
    	$this->db->where('course_id', $courseId);
    	$this->db->delete('tbl_course');
    	if($this->db->affected_rows()){
    		return true;
    	}else{
    		return '';
    	}
    }

    function getCourseDetails($courseId){
    	$this->db->select('*');
    	$this->db->from('tbl_course');
    	$this->db->where('course_id', $courseId);
    	$sql = $this->db->get();
    	if($sql->num_rows() > 0){
    		return $sql->row();
    	}else{
    		return '';
    	}
    }

    function updateFetured($post){
    	$set = array('featured' => $post['featured']);
    	$whr = array('stream_id'=> $post['stream_id']);
    	$this->db->update('tbl_stream', $set, $whr);
    	if($this->db->affected_rows()){
    		return true;
    	}else{
    		return '';
    	}
    }

    function updateStatus($post){
    	$set = array('status' => $post['status']);
    	$whr = array('course_id'=> $post['course_id']);
    	$this->db->update('tbl_course', $set, $whr);
    	if($this->db->affected_rows()){
    		return true;
    	}else{
    		return '';
    	}
    }
}
    