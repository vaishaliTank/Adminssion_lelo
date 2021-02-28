<?php
class M_colleges extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    
    function getAllColleges(){
        $this->db->select('*');
        $this->db->from('tbl_college');
        $this->db->where('status',1);
        $this->db->order_by('college_name', 'ASC');
        $sql = $this->db->get();
        if($sql->num_rows() > 0){
            return $sql->result();
        }else{
            return 0;
        }
    }

    function getSearchColleges($post){
        $search_array = array(
            'keyword_srch' => $post['freeserchvalue'],
            'srch_date' => date('Y-m-d H:i:s')
        );
        $sqlQuery = "select c.* from tbl_college as c left join tbl_college_course as tcc on tcc.college_id=c.college_id left join tbl_course as tc on tcc.course_id=tc.course_id where c.status=1 and (tc.course_name like '%".$post['freeserchvalue']."%' or c.college_name like '%".$post['freeserchvalue']."%' or c.state like '%".$post['freeserchvalue']."%')";
        $sqlQuery.= " group by c.college_name";
        $sqlQuery.= " order by c.college_name";
        $query = $this->db->query($sqlQuery);
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return '';
        }
    }

    function getCollegeDetails($clg_name){
        $splitName = explode("-",$clg_name);
        $clg_id = end($splitName);
        $this->db->select('*');
        $this->db->from('tbl_college');
        $this->db->where('college_id', $clg_id);
        $sql = $this->db->get();
        if($sql->num_rows() > 0){
            return $sql->row();
        }else{
            return '';
        }
    }
}