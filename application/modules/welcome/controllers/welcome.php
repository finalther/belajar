<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MX_Controller {

	
	public function index()
	{
		$this->template->set_layout('backend')
						->title('Home - Klorofil')
						->build('index');
	}


}

/* End of file Home.php */
/* Location: ./application/modules/welcome/controllers/Home.php */