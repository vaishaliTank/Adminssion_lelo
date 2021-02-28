<?php
class M_courses extends CI_Model{
    function __construct() {
        parent::__construct();
    }

    function getCourseList(){
        $this->db->select('*');
        $this->db->from('tbl_stream');
        $this->db->where('status', 1);
        $sql = $this->db->get();
        if($sql->num_rows() > 0){
            return $sql->result();
        }else{
            return '';
        }
    }

    function getCouseDetails($stream_name){
        $stream_name = ucwords(str_replace("-"," ",$stream_name));
        $this->db->select('*');
        $this->db->from('tbl_stream');
        $this->db->like('stream_name', $stream_name);
        $sql = $this->db->get();
        if($sql->num_rows() > 0){
            return $sql->row();
        }else{
            return '';
        }    
    }

    function getColleges($stream_id){
        $sqlQuery = "SELECT * FROM tbl_college WHERE `college_id` IN (SELECT DISTINCT college_id FROM tbl_course WHERE stream_id='$stream_id') LIMIT 0,9";
        $query = $this->db->query($sqlQuery);
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return '';
        }
    }

    function getCoursesList($stream_id){
        $sqlQuery = "SELECT DISTINCT course_name FROM tbl_course WHERE stream_id='$stream_id' LIMIT 0,36";
        $query = $this->db->query($sqlQuery);
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return '';
        }    
    }

}