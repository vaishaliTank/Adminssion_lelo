<?php
class M_ClgEventGallery extends CI_Model {

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

    function saveCollageEvent_Gallery($post){
        $test_array = array(
            'created_date' => date('Y-m-d H:i:s'),
            'updated_date' => date('Y-m-d H:i:s'),
        );
        $config['upload_path'] = './upload/gallery/';
        $config['allowed_types'] = 'jpg|png|jpeg|JPG|PNG|JPEG';
        $config['file_name'] = random_string('alnum', 16);
        
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('image_name')){
            $error = $this->upload->display_errors();
            $file_arr = array('error' => $error);
            $this->session->set_flashdata('msg', '<p style="color:red;">'.$file_arr.'</p>');
            return '';
        }else{
            $dt = array('upload_data'=>$this->upload->data());
            $test_array['gallery_image'] = $dt['upload_data']['file_name'];
        }
        
        //echo "<PRE>";print_r($test_array);die;
        $this->db->insert('gallery_image', $test_array);
    	$clgGId = $this->db->insert_id();
    	if($clgGId){
    		return $clgGId;
    	}else{
    		return '';
    	}
    }

    function updateClgGalleryEvent($post){
         $test_array = array(
            'created_date' => date('Y-m-d H:i:s'),
            'updated_date' => date('Y-m-d H:i:s'),
        );
    	if(!empty($_FILES['image_name']['name'])){
            $config['upload_path'] = './upload/gallery/';
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|PNG|JPEG';
            $config['file_name'] = random_string('alnum', 16);
            
            $this->upload->initialize($config);

            if(!$this->upload->do_upload('image_name')){
                $error = $this->upload->display_errors();
                $file_arr = array('error' => $error);
                $this->session->set_flashdata('msg', '<p style="color:red;">'.$file_arr.'</p>');
                return '';
            }else{
                $dt = array('upload_data'=>$this->upload->data());
                $test_array['gallery_image'] = $dt['upload_data']['file_name'];
            }
        }
        else{
            $test_array['gallery_image'] = $_POST['old_img'];
        }
        $this->db->update('gallery_image', $test_array, array('id' => $post['event_id']));
        //echo $this->db->last_query();die;
        if($this->db->affected_rows()){
            return true;
        }else{
            return '';
        }
    }

    function deleteClgGalleryEvent($imageid){
    	$this->db->where('id', $imageid);
    	$this->db->delete('gallery_image');
    	if($this->db->affected_rows()){
    		return true;
    	}else{
    		return '';
    	}
    }

    function getClgGEDetails($sid){
    	$this->db->select('*');
    	$this->db->from('gallery_image');
    	$this->db->where('id', $sid);
    	$sql = $this->db->get();
        //echo $this->db->last_query();die;
    	if($sql->num_rows() > 0){
    		return $sql->row();
    	}else{
    		return '';
    	}
    }

    
   
}
    