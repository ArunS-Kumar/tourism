<?php

class Tour extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
        $this->auth->check_access_permission();
		$this->load->helper('date');
		$this->load->model('Tour_model');
		$this->load->model('Common_model');
		$this->load->model('Search_model');
	}
	
	function index($field='id', $by='DESC', $code=0,$page=0)
	{
		$data['page_title']	= "Tour";
		
        $term				= false;
        $post				= $this->input->post(null, false);
        if($post)
        {
            $term			= json_encode($post);
            $code			= $this->Search_model->record_term($term);
            $data['code']	= $code;
        }
        elseif ($code)
        {
            $term			= $this->Search_model->get_term($code);
        }
		if(!empty($_POST) && !empty($_POST['tablelimit']) ) {
		    $limit = $_POST['tablelimit'];
		} else { 
		    $limit = 10; 
		}
		
		$data['tour']	       = $this->Tour_model->get_all_values($limit,$page, $field, $by,$term);
		$count_tour	    = $this->Tour_model->get_all_values(0,$page, $field, $by,$term);

		$this->load->library('pagination');

		$config['base_url']		    = base_url().'/'.$this->config->item('admin_folder').'/tour/index/'.$field.'/'.$by.'/'.$code;
		$config['total_rows']	    = count($count_tour);
		$config['per_page']		    = $limit;
		$config['uri_segment']	    = 7;
		$config['first_link']		= 'First';
		$config['first_tag_open']	= '<li>';
		$config['first_tag_close']	= '</li>';
		$config['last_link']		= 'Last';
		$config['last_tag_open']	= '<li>';
		$config['last_tag_close']	= '</li>';

		$config['full_tag_open']	= '<ul class="pagination pagination-sm no-margin pull-right">';
		$config['full_tag_close']	= '</ul>';
		$config['cur_tag_open']		= '<li class="active"><a href="#" class="pagechange">';
		$config['cur_tag_close']	= '</a></li>';
		
		$config['num_tag_open']		= '<li>';
		$config['num_tag_close']	= '</li>';
		
		$config['prev_link']		= '&laquo;';
		$config['prev_tag_open']	= '<li>';
		$config['prev_tag_close']	= '</li>';

		$config['next_link']		= '&raquo;';
		$config['next_tag_open']	= '<li>';
		$config['next_tag_close']	= '</li>';
		
		$this->pagination->initialize($config);
		
		$data['page']	= $page;
		$data['field']	= $field;
		$data['by']	    = $by;
		
		if(!empty($_POST) && $_POST['id'] == 'ajaxloaded') {
		   $this->view_ajax($this->config->item('admin_folder').'/masters/tour_ajax', $data);
		}else {
		    $this->view($this->config->item('admin_folder').'/masters/tour', $data);
		}
		
	}
	
	function form($id = false)
   	{
   		
        $config['upload_path']      = 'uploads/images/full';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_width']        = '5000';
        $config['max_height']       = '5000';
        $config['encrypt_name']     = true;
        $this->load->library('upload', $config);

        $data['page_title']         = "Add Tour";
        
        //default values are empty if the customer is new
        $data['id']                 = '';
        $data['name']               = '';
        $data['description']        = '';
        $data['activate']           = '';
        $data['image']              = '';
        $data['days']               = '';
        $data['tour_image']         = array();
        $data['day_values']         = array();
        $data['all_destination']    = $this->Common_model->get_destination();
        $data['all_tags']           = $this->Common_model->get_tags();
        
        if ($id)
        {   
            $tour                 = $this->Tour_model->get_category($id);

            if (!$tour) 
            {
                $this->session->set_flashdata('error', lang('error_not_found'));
                redirect($this->config->item('admin_folder').'/tour');
            }
            
            $data['id']                = $tour->id;
            $data['name']              = $tour->name;
            $data['image']             = $tour->image;
            $data['days']              = $tour->days;
            $data['description']       = $tour->description;
            $data['activate']          = $tour->activate;
            $data['destination']       = $tour->destination;
            if(!$this->input->post('submit'))
	        {
                $data['tour_image']	     = (array)json_decode($tour->tour_image);
                $data['day_values']	     = (array)json_decode($tour->day_values);
                $data['tags']	         = (array)json_decode($tour->tags);
	        }
        }

        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('description', 'lang:description', 'trim');
        $this->form_validation->set_rules('activate', 'lang:enabled', 'trim|numeric');
        
        if ($this->form_validation->run() == FALSE)
        {
		    $this->view($this->config->item('admin_folder').'/masters/tour_form', $data);
        }
        else
        {
        	$uploaded   = $this->upload->do_upload('image');
            if($uploaded){
                $save['image']               = $this->fullimage_upload($this->upload->data());
            }
            
            $save['id']                 = $id;
            $save['name']               = $this->input->post('name');
            $save['description']        = $this->input->post('description');
            $save['activate']           = $this->input->post('activate');
            $save['days']               = $this->input->post('days');
            $save['destination']        = $this->input->post('destination');
            $save['created_at']         = $this->session->userdata('admin')['id'];
	        $save['tour_image']	        = json_encode($this->input->post('tour_image'));
	        $save['day_values']	        = json_encode($this->input->post('day_values'));
	        $save['tags']	            = json_encode($this->input->post('tags'));
            
            if($id)
            $save['updated_at']         = date('Y-m-d H:i:s');
            
            $homebanner_id              = $this->Tour_model->save($save);
            $this->session->set_flashdata('message', lang('message_category_saved'));
            
            redirect($this->config->item('admin_folder').'/tour');
            // $this->view2($this->config->item('admin_folder').'/masters/close_popup', $data);
        }
    }
    
    function activate_dactivate()
	{
	    if(!empty($_POST)) 
	    { 
	        $val = '';
	        $id = $_POST['id'];
	        $tour       = $this->Tour_model->get_category($id);
	        if($tour->activate == 1) {
	            $this->Tour_model->activate_dactivate($id,0);
	            //$this->session->set_flashdata('message', 'Deactivated Successfully');
	            $val .= '2';
	        } else {
	            $this->Tour_model->activate_dactivate($id,1);
	            //$this->session->set_flashdata('message', 'Activated Successfully');
	            $val .=  '1';
	        }
	        
	        echo $val; exit;
	    }
	}
	
	
	function get_serial()
	{
	    if(!empty($_POST)) 
	    {
	        $serial = $_POST['serial'];
	        $this->Tour_model->organize_contents($serial);
        }
	}

	function tour_image_form()
	{
		$data['file_name'] = false;
		$data['error']	= false;
		$this->load->view($this->config->item('admin_folder').'/iframe/tour_image_uploader', $data);
	}
	
	
	function tour_image_upload()
	{
		$data['file_name']        = array();
        $data['error']	          = false;
        $config['allowed_types']  = 'gif|jpg|png';
        $config['upload_path']    = 'uploads/images/full';
        $config['encrypt_name']   = true;
        $config['remove_spaces']  = true;
        $this->load->library('upload', $config);
        $count = count($_FILES['userfile']['size']);

        foreach($_FILES as $files):
        for($i=0;$i<$count;$i++)
        {
            $_FILES['userfile']['name']=$files['name'][$i];
            $_FILES['userfile']['tmp_name']=$files['tmp_name'][$i];
            $_FILES['userfile']['size']=$files['size'][$i];
            $_FILES['userfile']['error']=$files['error'][$i];
            $_FILES['userfile']['type']=$files['type'][$i];
            
            if($this->upload->do_upload())
            {
                $data['file_name'][]  = $this->fullimage_upload($this->upload->data());
            }
            
            if($this->upload->display_errors() != '')
            {
                $data['error'] = $this->upload->display_errors();
            }
        }
        endforeach;	
		$this->load->view($this->config->item('admin_folder').'/iframe/tour_image_uploader', $data);
	}

}
