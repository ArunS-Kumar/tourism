<?php

class Application extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
        $this->auth->check_access_permission();
		$this->load->helper('date');
		$this->load->model('Application_model');
		$this->load->model('Search_model');
	}
	
	function index($field='id', $by='DESC', $code=0,$page=0)
	{
		$data['page_title']	= "Application";
		
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
		
		$data['application']	    = $this->Application_model->get_applications($limit,$page, $field, $by,$term);
		$count_application	    = $this->Application_model->get_applications(0,$page, $field, $by,$term);

		$this->load->library('pagination');

		$config['base_url']		    = base_url().'/'.$this->config->item('admin_folder').'/application/index/'.$field.'/'.$by.'/'.$code;
		$config['total_rows']	    = count($count_application);
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
		   $this->view_ajax($this->config->item('admin_folder').'/masters/application_ajax', $data);
		}else {
		    $this->view($this->config->item('admin_folder').'/masters/application', $data);
		}
		
	}
	
	function form($id = false)
   	{
        
        $data['page_title']         = "Add Application";
        
        //default values are empty if the customer is new
        $data['id']                 = '';
        $data['name']               = '';
        $data['description']        = '';
        $data['enabled']            = '';
       
        if ($id)
        {   
            $application                 = $this->Application_model->get_category($id);

            if (!$application) 
            {
                $this->session->set_flashdata('error', lang('error_not_found'));
                redirect($this->config->item('admin_folder').'/application');
            }
            
            $data['id']                = $application->id;
            $data['name']              = $application->name;
            $data['description']       = $application->description;
            $data['enabled']           = $application->enabled;
        }

        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('description', 'lang:description', 'trim');
        $this->form_validation->set_rules('enabled', 'lang:enabled', 'trim|numeric');
        
        if ($this->form_validation->run() == FALSE)
        {
		    $this->view2($this->config->item('admin_folder').'/masters/application_form', $data);
        }
        else
        {
        
            
            $save['id']                 = $id;
            $save['name']               = $this->input->post('name');
            $save['description']        = $this->input->post('description');
            $save['enabled']            = $this->input->post('enabled');
            $save['created_by']         = $this->session->userdata('admin')['id'];
            
            if($id)
            $save['modified_on']         = date('Y-m-d H:i:s');
            
            $homebanner_id              = $this->Application_model->save($save);
            $this->session->set_flashdata('message', lang('message_category_saved'));
            
            //redirect($this->config->item('admin_folder').'/application');
            $this->view2($this->config->item('admin_folder').'/masters/close_popup', $data);
        }
    }
    
    function activate_dactivate()
	{
	    if(!empty($_POST)) 
	    { 
	        $val = '';
	        $id = $_POST['id'];
	        $application       = $this->Application_model->get_category($id);
	        if($application->enabled == 1) {
	            $this->Application_model->activate_dactivate($id,0);
	            //$this->session->set_flashdata('message', 'Deactivated Successfully');
	            $val .= '2';
	        } else {
	            $this->Application_model->activate_dactivate($id,1);
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
	        $this->Application_model->organize_contents($serial);
        }
	}
	    
    

}
