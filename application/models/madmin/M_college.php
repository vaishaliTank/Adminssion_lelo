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

    function saveCourse($post){
    	$course_name = addslashes(trim($post['course_name']));
		$courseid = addslashes(trim($post['course_id']));
		$stream_id = addslashes(trim($post['stream_id']));
		$status = isset($post['course_status']) ? 1 : 0;

    	$stream_array = array(
    		'course_name' => $course_name,
    		'courseid' => $courseid,
    		'stream_id' => $stream_id,
    		'status' => $status,
    		'created_date' => date('Y-m-d H:i:s'),
    		'updated_date' => date('Y-m-d H:i:s'),
    	);

    	$this->db->insert('tbl_course', $stream_array);
    	$courseId = $this->db->insert_id();
    	if($courseId){
    		return $courseId;
    	}else{
    		return '';
    	}
    }

    function updateCourse($post){
    	$course_name = addslashes(trim($post['course_name']));
        $courseid = addslashes(trim($post['course_id']));
        $stream_id = addslashes(trim($post['stream_id']));
        $status = isset($post['course_status']) ? 1 : 0;

        $stream_array = array(
            'course_name' => $course_name,
            'courseid' => $courseid,
            'stream_id' => $stream_id,
            'status' => $status,
            'updated_date' => date('Y-m-d H:i:s'),
        );

        $this->db->update('tbl_course', $stream_array, array('course_id' => $post['cid']));
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
    