<?php
class M_testimonial extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('upload');
    }

    function gettestimonialList(){
    	$sqlQuery = "SELECT * FROM `testimonials`";
    	$sql = $this->db->query($sqlQuery);
    	if($sql->num_rows() > 0){
    		return $sql->result();
    	}else{
    		return '';
    	}
    }

    function saveTestimonial($post){

    	$customer_name = addslashes(trim($post['customer_name']));
		$texttest = addslashes(trim($post['texttest']));
		$status = isset($post['status']) ? 1 : 0;

    	$test_array = array(
    		'customer_name' => $customer_name,
    		'message_text' => $texttest,
    		'status' => $status,
    		'created_date' => date('Y-m-d H:i:s'),
    	);

        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'jpg|png|jpeg|JPG|PNG|JPEG';
        $config['file_name'] = random_string('alnum', 16);
        
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('college_image')){
            $error = $this->upload->display_errors();
            $file_arr = array('error' => $error);
            $this->session->set_flashdata('msg', '<p style="color:red;">'.$file_arr.'</p>');
            return '';
        }else{
            $dt = array('upload_data'=>$this->upload->data());
            $test_array['customer_image'] = $dt['upload_data']['file_name'];
        }
        
        //echo "<PRE>";print_r($test_array);die;
    	$this->db->insert('testimonials', $test_array);
    	$testId = $this->db->insert_id();
    	if($testId){
    		return $testId;
    	}else{
    		return '';
    	}
    }

    function updateTestimonials($post){
    	$customer_name = addslashes(trim($post['customer_name']));
        $texttest = addslashes(trim($post['texttest']));
        $status = isset($post['status']) ? 1 : 0;
        //echo "<PRE>";print_r($_POST);die;
        $test_array = array(
            'customer_name' => $customer_name,
            'message_text' => $texttest,
            'status' => $status,
            'created_date' => date('Y-m-d H:i:s'),
        );
        //echo "<PRE>";print_r($test_array);die;
        if(!empty($_FILES['college_image'])){
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|PNG|JPEG';
            $config['file_name'] = random_string('alnum', 16);
            
            $this->upload->initialize($config);

            if(!$this->upload->do_upload('college_image')){
                $error = $this->upload->display_errors();
                $file_arr = array('error' => $error);
                $this->session->set_flashdata('msg', '<p style="color:red;">'.$file_arr.'</p>');
                return '';
            }else{
                $dt = array('upload_data'=>$this->upload->data());
                $test_array['customer_image'] = $dt['upload_data']['file_name'];
            }
        }
        else{
            $test_array['customer_image'] = $_POST['old_image'];
        }
        echo "<PRE>";print_r($test_array);die;
        $this->db->update('testimonials', $test_array, array('id' => $post['testiminial_id']));
        if($this->db->affected_rows()){
            return true;
        }else{
            return '';
        }
    }

    function deleteTestimonial($testId){
    	$this->db->where('id', $testId);
    	$this->db->delete('testimonials');
    	if($this->db->affected_rows()){
    		return true;
    	}else{
    		return '';
    	}
    }

    function getTestimonialDetails($testId){
    	$this->db->select('*');
    	$this->db->from('testimonials');
    	$this->db->where('id', $testId);
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
    	$whr = array('id'=> $post['course_id']);
    	$this->db->update('testimonials', $set, $whr);
    	if($this->db->affected_rows()){
    		return true;
    	}else{
    		return '';
    	}
    }
}
    