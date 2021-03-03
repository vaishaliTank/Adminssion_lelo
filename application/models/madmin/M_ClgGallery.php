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

    function updateClgGallery($post){

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

    function getClgGDetails($cid,$type){
    	$this->db->select('*');
    	$this->db->from('college_image');
    	$this->db->where('college_id', $cid);
        $this->db->where('image_type', $type);
    	$sql = $this->db->get();
        //echo $this->db->last_query();die;
    	if($sql->num_rows() > 0){
    		return $sql->row();
    	}else{
    		return '';
    	}
    }

    public function deleteClgGalleryImage($clgid,$img_type,$img_id){
        $this->db->where('college_id', $clgid);
        $this->db->where('image_type', $img_type);
        $this->db->where('image_id', $img_id);
        $this->db->delete('college_image');
        if($this->db->affected_rows()){
            return true;
        }else{
            return '';
        }
    }
   
}
    