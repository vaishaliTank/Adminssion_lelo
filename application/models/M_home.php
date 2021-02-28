<?php
class M_home extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    
    function getCollegeCounts($streamId){
        $this->db->distinct();
        $this->db->select('college_id');
        $this->db->from('tbl_college_course');
        $this->db->where('stream_id',$streamId);
        $sql = $this->db->get();
        if($sql->num_rows() > 0){
            return $sql->num_rows();
        }else{
            return 0;
        }
    }
    
    function getCourceCount($streamId){
        $this->db->distinct();
        $this->db->select('course_id');
        $this->db->from('tbl_college_course');
        $this->db->where('stream_id',$streamId);
        $sql = $this->db->get();
        if($sql->num_rows() > 0){
            return $sql->num_rows();
        }else{
            return 0;
        }
    }

    function getTestimonials(){
        $this->db->select('*');
        $this->db->from('testimonials');
        $this->db->order_by('created_date', 'ASC');
        $sql = $this->db->get();
        if($sql->num_rows() > 0){
            return $sql->result();
        }else{
            return '';
        }
    }

    function getCourseList(){
        $this->db->select('*');
        $this->db->from('tbl_stream');
        $this->db->where('status', 1);
        $this->db->limit(6);
        $sql = $this->db->get();
        if($sql->num_rows() > 0){
            return $sql->result();
        }else{
            return '';
        }
    }
}