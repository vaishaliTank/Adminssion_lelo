<?php
class M_ClgVideo extends CI_Model {

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

    function saveCollage_Video($post){
        $collage = addslashes(trim($post['collage']));
    	$videoname = addslashes(trim($post['videoname']));
		$vlink = addslashes(trim($post['videolink']));
        
		$status = isset($post['status']) ? 1 : 0;

    	$test_array = array(
    		'college_id' => $collage,
    		'video_name' => $videoname,
            'video_link' => $vlink,
    		'status' => $status,
    		'created_date' => date('Y-m-d H:i:s'),
            'updated_date' =>date('Y-m-d H:i:s'),
    	);

        
        //echo "<PRE>";print_r($test_array);die;
    	$this->db->insert('tbl_college_video', $test_array);
    	$clgVId = $this->db->insert_id();
    	if($clgVId){
    		return $clgVId;
    	}else{
    		return '';
    	}
    }

    function updateClgVideo($post){
    	$collage = addslashes(trim($post['collage']));
        $videoname = addslashes(trim($post['videoname']));
        $vlink = addslashes(trim($post['videolink']));
        
        $status = isset($post['status']) ? 1 : 0;

        $test_array = array(
            'college_id' => $collage,
            'video_name' => $videoname,
            'video_link' => $vlink,
            'status' => $status,
            'created_date' => date('Y-m-d H:i:s'),
            'updated_date' =>date('Y-m-d H:i:s'),
        );
        
        $this->db->update('tbl_college_video', $test_array, array('video_id' => $post['video_id']));
        //echo $this->db->last_query();die;
        if($this->db->affected_rows()){
            return true;
        }else{
            return '';
        }
    }

    function deleteClgVideo($vId){
    	$this->db->where('video_id', $vId);
    	$this->db->delete('tbl_college_video');
    	if($this->db->affected_rows()){
    		return true;
    	}else{
    		return '';
    	}
    }

    function getClgVDetails($vid){
    	$this->db->select('*');
    	$this->db->from(' tbl_college_video');
    	$this->db->where('video_id', $vid);
    	$sql = $this->db->get();
        //echo $this->db->last_query();die;
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
    	$whr = array('video_id'=> $post);
    	$this->db->update(' tbl_college_video', $set, $whr);
        //echo $this->db->last_query();die;
    	if($this->db->affected_rows()){
    		return true;
    	}else{
    		return '';
    	}
    }
}
    