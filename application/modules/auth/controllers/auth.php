<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$query = $this->m_global->fetch('tb_user', array('nama'=>$username, 'password'=>$password));
		$total = $query->num_rows();

		if($total > 0){
			$row = $query->row();

			$ur =base_url('home');
			$msg="ok";
			if($row->role == 1){
                    $sessionUser['username'] = $row->nama;
                    $sessionUser['role'] = $row->role;
                    $sessionUser['id_user'] = $row->id_user;
                    $sessionUser['isLogin'] = TRUE;
                    $this->session->set_userdata($sessionUser);
					echo json_encode(array('url'=>$ur, 'message'=>$msg));
			}elseif($row->role == 2){
                    $sessionUser['username'] = $row->nama;
                    $sessionUser['role'] = $row->role;
                    $sessionUser['id_user'] = $row->id_user;
                    $sessionUser['isLogin'] = TRUE;
                    $this->session->set_userdata($sessionUser);
					echo json_encode(array('url'=>$ur, 'message'=>$msg));
			}elseif($row->role == 3){
                    $sessionUser['username'] = $row->nama;
                    $sessionUser['role'] = $row->role;
                    $sessionUser['id_user'] = $row->id_user;
                    $sessionUser['isLogin'] = TRUE;
                    $this->session->set_userdata($sessionUser);
					echo json_encode(array('url'=>$ur, 'message'=>$msg));
			}

		}else{
			$msg="Login gagal !";
			$ur =base_url('welcome');
			echo json_encode(array('url'=>$ur,'message'=>$msg));
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		$ur = base_url('welcome');
		echo json_encode(array('url'=>$ur));
	}


}

/* End of file Home.php */
/* Location: ./application/modules/welcome/controllers/Home.php */