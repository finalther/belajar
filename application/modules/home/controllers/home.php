<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		 if(!$this->session->userdata('isLogin'))
        { 
            redirect(site_url('welcome'));
            exit();
        }
	}

	public function index()
	{
		$this->template->set_layout('backend')
						->title('Home')
						->build('index');
	}

}

/* End of file Home.php */
/* Location: ./application/modules/welcome/controllers/Home.php */