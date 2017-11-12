<?php

class Product_finishes extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
        $this->auth->check_access_permission();
		$this->load->helper('date');
		$this->load->model('Product_finishes_model');
		$this->load->model('Search_model');
	}
	
	function index($field='id', $by='DESC', $code=0,$page=0)
	{
		$data['page_title']	= "Product Finishes";
		
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
		
		$data['product_finishes']	    = $this->Product_finishes_model->get_product_finishess($limit,$page, $field, $by,$term);
		$count_product_finishes	        = $this->Product_finishes_model->get_product_finishess(0,$page, $field, $by,$term);

		$this->load->library('pagination');

		$config['base_url']		    = base_url().'/'.$this->config->item('admin_folder').'/product_finishes/index/'.$field.'/'.$by.'/'.$code;
		$config['total_rows']	    = count($count_product_finishes);
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
		   $this->view_ajax($this->config->item('admin_folder').'/masters/product_finishes_ajax', $data);
		}else {
		    $this->view($this->config->item('admin_folder').'/masters/product_finishes', $data);
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
        
        $data['page_title']         = "Add Product Finishes";
        
        //default values are empty if the customer is new
        $data['id']                 = '';
        $data['name']               = '';
        $data['description']        = '';
        $data['image']              = '';
        $data['enabled']            = '';
       
        if ($id)
        {   
            $product_finishes                 = $this->Product_finishes_model->get_category($id);

            if (!$product_finishes) 
            {
                $this->session->set_flashdata('error', lang('error_not_found'));
                redirect($this->config->item('admin_folder').'/product_finishes');
            }
            
            $data['id']                = $product_finishes->id;
            $data['name']              = $product_finishes->name;
            $data['description']       = $product_finishes->description;
            $data['image']             = $product_finishes->image;
            $data['enabled']           = $product_finishes->enabled;
        }

        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('description', 'lang:description', 'trim');
        $this->form_validation->set_rules('image', 'lang:image', 'trim');
        $this->form_validation->set_rules('enabled', 'lang:enabled', 'trim|numeric');
        
        if ($this->form_validation->run() == FALSE)
        {
		    $this->view2($this->config->item('admin_folder').'/masters/product_finishes_form', $data);
        }
        else
        {
        
            $uploaded   = $this->upload->do_upload('image');
            if($uploaded){
                $save['image']         = $this->fullimage_upload($this->upload->data());
            }
            
            $save['id']                 = $id;
            $save['name']               = $this->input->post('name');
            $save['description']        = $this->input->post('description');
            $save['enabled']            = $this->input->post('enabled');
            $save['created_by']         = $this->session->userdata('admin')['id'];
            
            if($id)
            $save['modified_on']         = date('Y-m-d H:i:s');
            
            $homebanner_id              = $this->Product_finishes_model->save($save);
            $this->session->set_flashdata('message', lang('message_category_saved'));
            
            //redirect($this->config->item('admin_folder').'/product_finishes');
            $this->view2($this->config->item('admin_folder').'/masters/close_popup', $data);
        }
    }
    
    function activate_dactivate()
	{
	    if(!empty($_POST)) 
	    { 
	        $val = '';
	        $id = $_POST['id'];
	        $product_finishes       = $this->Product_finishes_model->get_category($id);
	        if($product_finishes->enabled == 1) {
	            $this->Product_finishes_model->activate_dactivate($id,0);
	            //$this->session->set_flashdata('message', 'Deactivated Successfully');
	            $val .= '2';
	        } else {
	            $this->Product_finishes_model->activate_dactivate($id,1);
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
	        $this->Product_finishes_model->organize_contents($serial);
        }
	}
	    
    

}
