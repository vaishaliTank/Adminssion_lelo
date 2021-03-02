<?php
class M_ClgGallery extends CI_Model {

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

    function saveCollage_Gallery($post){
        $collage = addslashes(trim($post['collage']));
    	$image_type = addslashes(trim($post['image']));
		$image_name = $_FILES['image_name'];
        //echo "<PRE>";print_r($_FILES);die;

    	$test_array = array(
    		'college_id' => $collage,
    		'image_type' => $image_type,
    		'created_date' => date('Y-m-d H:i:s'),
            'updated_date' =>date('Y-m-d H:i:s'),
    	);
        $ImageCount = count($_FILES['image_name']['name']);
        //echo $ImageCount;die;
        
        for($i = 0; $i < $ImageCount; $i++){
            $_FILES['file']['name']       = $_FILES['image_name']['name'][$i];
            $_FILES['file']['type']       = $_FILES['image_name']['type'][$i];
            $_FILES['file']['tmp_name']   = $_FILES['image_name']['tmp_name'][$i];
            $_FILES['file']['error']      = $_FILES['image_name']['error'][$i];
            $_FILES['file']['size']       = $_FILES['image_name']['size'][$i];

            // File upload configuration
            $uploadPath = './upload/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|PNG|JPEG';
            $config['file_name'] = random_string('alnum', 16);

            // Load and initialize upload library
            
            $this->upload->initialize($config);

            // Upload file to server
            if($this->upload->do_upload('file')){
                // Uploaded file data
                $imageData = $this->upload->data();
                $uploadImgData[$i]['image_name'] = $imageData['file_name'];
            }
        }


        if(!empty($uploadImgData)){
            for($i = 0;$i<count($uploadImgData);$i++){
                $images = $uploadImgData[$i]['image_name'];
                $test_array['image_name'] = $images;
                //echo "<PRE>";print_r($test_array);die;
                $this->db->insert('college_image', $test_array);
            }
        }

        
        //echo "<PRE>";print_r($test_array);die;
    	
    	$clgGId = $this->db->insert_id();
    	if($clgGId){
    		return $clgGId;
    	}else{
    		return '';
    	}
    }

    function updateClgSocial($post){

    	$collage = addslashes(trim($post['collage']));
        $clgemail = addslashes(trim($post['clgemail']));
        $clgphone = addslashes(trim($post['clgphone']));
        $fblink = addslashes(trim($post['fblink']));
        $twlink = addslashes(trim($post['twlink']));
        $inlink = addslashes(trim($post['inlink']));
        $linlink = addslashes(trim($post['linlink']));
        $test_array = array(
            'college_id' => $collage,
            'college_email' => $clgemail,
            'college_phone' => $clgphone,
            'facebooklink' => $fblink,
            'twitterlink' => $twlink,
            'instagramlink' => $inlink,
            'linkedinlink' => $linlink,
            'created_date' => date('Y-m-d H:i:s'),
            'updated_date' =>date('Y-m-d H:i:s'),
        );
        //echo "<PRE>";print_r($post);die;
        if(!empty($_FILES['college_logo']['name'])){
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|PNG|JPEG';
            $config['file_name'] = random_string('alnum', 16);
            
            $this->upload->initialize($config);

            if(!$this->upload->do_upload('college_logo')){
                $error = $this->upload->display_errors();
                $file_arr = array('error' => $error);
                $this->session->set_flashdata('msg', '<p style="color:red;">'.$file_arr.'</p>');
                return '';
            }else{
                $dt = array('upload_data'=>$this->upload->data());
                $test_array['college_logo'] = $dt['upload_data']['file_name'];
            }
        }else{
            $test_array['college_logo'] = $_POST['old_logo'];
        }
        //echo "<PRE>";print_r($test_array);die;
        $this->db->update('tbl_social_link', $test_array, array('social_id' => $post['social_id']));
        //echo $this->db->last_query();die;
        if($this->db->affected_rows()){
            return true;
        }else{
            return '';
        }
    }

    function deleteClgGallery($imageid,$imagetype){
    	$this->db->where('college_id', $imageid);
        $this->db->where('image_type', $imagetype);
    	$this->db->delete('college_image');
    	if($this->db->affected_rows()){
    		return true;
    	}else{
    		return '';
    	}
    }

    function getClgSDetails($sid){
    	$this->db->select('*');
    	$this->db->from('tbl_social_link');
    	$this->db->where('social_id', $sid);
    	$sql = $this->db->get();
        //echo $this->db->last_query();die;
    	if($sql->num_rows() > 0){
    		return $sql->row();
    	}else{
    		return '';
    	}
    }

    
   
}
    