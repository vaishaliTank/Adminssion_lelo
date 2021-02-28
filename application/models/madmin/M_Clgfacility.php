<?php
class M_Clgfacility extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('upload');
    }

    function getClgList(){
    	$sqlQuery = "SELECT * FROM `tbl_college_facility`";
    	$sql = $this->db->query($sqlQuery);
    	if($sql->num_rows() > 0){
    		return $sql->result();
    	}else{
    		return '';
    	}
    }

    function saveCollage_Facility($post){
        $collage = addslashes(trim($post['collage']));
    	$fname = addslashes(trim($post['fname']));
		$lname = addslashes(trim($post['lname']));
        $designation = addslashes(trim($post['designation']));
        $bio = addslashes(trim($post['bio']));
		$status = isset($post['status']) ? 1 : 0;

    	$test_array = array(
    		'college_id' => $collage,
    		'facility_fname' => $fname,
            'facility_lname' => $lname,
            'designation' => $designation,
            'facility_bio' => $bio,
    		'status' => $status,
    		'created_date' => date('Y-m-d H:i:s'),
    	);

        
        //echo "<PRE>";print_r($test_array);die;
    	$this->db->insert('tbl_college_facility', $test_array);
    	$clgId = $this->db->insert_id();
    	if($clgId){
    		return $clgId;
    	}else{
    		return '';
    	}
    }

    function updateTestimonials($post){
    	$collage = addslashes(trim($post['collage']));
        $fname = addslashes(trim($post['fname']));
        $lname = addslashes(trim($post['lname']));
        $designation = addslashes(trim($post['designation']));
        $bio = addslashes(trim($post['bio']));
        $status = isset($post['status']) ? 1 : 0;

        $test_array = array(
            'college_id' => $collage,
            'facility_fname' => $fname,
            'facility_lname' => $lname,
            'designation' => $designation,
            'facility_bio' => $bio,
            'status' => $status,
            'created_date' => date('Y-m-d H:i:s'),
        );

        $this->db->update('tbl_college_facility', $test_array, array('facility_id' => $post['facility_id']));
        if($this->db->affected_rows()){
            return true;
        }else{
            return '';
        }
    }

    function deleteFacility($clgId){
    	$this->db->where('facility_id', $clgId);
    	$this->db->delete('tbl_college_facility');
    	if($this->db->affected_rows()){
    		return true;
    	}else{
    		return '';
    	}
    }

    function getFaciltyDetails($facilityid){
    	$this->db->select('*');
    	$this->db->from('tbl_college_facility');
    	$this->db->where('facility_id', $facilityid);
    	$sql = $this->db->get();
    	if($sql->num_rows() > 0){
    		return $sql->row();
    	}else{
    		return '';
    	}
    }

    
    function updateStatus($post,$status){
        if($status == 0){
            $status =1;
        }else{
            $status = 0;
        }
        $set = array('status' => $status);
    	$whr = array('facility_id'=> $post);
    	$this->db->update('tbl_college_facility', $set, $whr);
    	if($this->db->affected_rows()){
    		return true;
    	}else{
    		return '';
    	}
    }
}
    