<?php
class M_stream extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('upload');
    }

    function getStreamList(){
    	$sqlQuery = "SELECT * FROM tbl_stream WHERE stream_id != 0 ORDER BY stream_name ASC";
    	$sql = $this->db->query($sqlQuery);
    	if($sql->num_rows() > 0){
    		return $sql->result();
    	}else{
    		return '';
    	}
    }

    function saveStream($post){
    	$stream_name = addslashes(trim($post['stream_name']));
		$stream_desc = addslashes(trim($post['stream_desc']));
		$stream_college_desc = addslashes(trim($post['stream_college_desc']));
		$stream_course_desc = addslashes(trim($post['stream_course_desc']));
		$status = isset($post['stream_status']) ? 1 : 0;

    	$stream_array = array(
    		'stream_name' => $stream_name,
    		'stream_desc' => $stream_desc,
    		'stream_college_desc' => $stream_college_desc,
    		'stream_course_desc' => $stream_course_desc,
    		'status' => $status,
    		'created_date' => date('Y-m-d H:i:s'),
    		'updated_date' => date('Y-m-d H:i:s'),
    	);

    	$config['upload_path'] = './upload/';
        $config['allowed_types'] = 'jpg|png|jpeg|JPG|PNG|JPEG';
        $config['file_name'] = random_string('alnum', 16);
        
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('stream_image')){
            $error = $this->upload->display_errors();
            $file_arr = array('error' => $error);
            $this->session->set_flashdata('msg', '<p style="color:red;">'.$file_arr.'</p>');
            return '';
        }else{
            $dt = array('upload_data'=>$this->upload->data());
            $stream_array['stream_img'] = $dt['upload_data']['file_name'];
        }
    	
    	$this->db->insert('tbl_stream', $stream_array);
    	$streamId = $this->db->insert_id();
    	if($streamId){
    		return $streamId;
    	}else{
    		return '';
    	}
    }

    function updateStream($post){
    	$stream_name = addslashes(trim($post['stream_name']));
		$stream_desc = addslashes(trim($post['stream_desc']));
		$stream_college_desc = addslashes(trim($post['stream_college_desc']));
		$stream_course_desc = addslashes(trim($post['stream_course_desc']));
		$status = isset($post['stream_status']) ? 1 : 0;

    	$stream_array = array(
    		'stream_name' => $stream_name,
    		'stream_desc' => $stream_desc,
    		'stream_college_desc' => $stream_college_desc,
    		'stream_course_desc' => $stream_course_desc,
    		'status' => $status,
    		'updated_date' => date('Y-m-d H:i:s'),
    	);

    	$config['upload_path'] = './upload/';
        $config['allowed_types'] = 'jpg|png|jpeg|JPG|PNG|JPEG';
        $config['file_name'] = random_string('alnum', 16);
        
        $this->upload->initialize($config);

        if($_FILES['stream_image']['name'] != ''){
        	$this->upload->do_upload('stream_image');
            $dt = array('upload_data'=>$this->upload->data());
            $stream_array['stream_img'] = $dt['upload_data']['file_name'];
        }
    	
    	$this->db->update('tbl_stream', $stream_array, array('stream_id' => $post['stream_id']));
    	if($this->db->affected_rows()){
    		return true;
    	}else{
    		return '';
    	}
    }

    function deleteStream($streamId){
    	$this->db->where('stream_id', $streamId);
    	$this->db->delete('tbl_stream');
    	if($this->db->affected_rows()){
    		return true;
    	}else{
    		return '';
    	}
    }

    function getStreamDetails($streamId){
    	$this->db->select('*');
    	$this->db->from('tbl_stream');
    	$this->db->where('stream_id', $streamId);
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
    	$whr = array('stream_id'=> $post['stream_id']);
    	$this->db->update('tbl_stream', $set, $whr);
    	if($this->db->affected_rows()){
    		return true;
    	}else{
    		return '';
    	}
    }
}
    