<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->model('Common');
	}

	public function index()
	{
		redirect('app/login');
	}
	public function login()
	{
		if(isset($_COOKIE['admin_farmroot_id'])){
			$session = [
				'admin_id' => $_COOKIE['admin_farmroot_id'],
				'name' => $_COOKIE['admin_farmroot_name']
			];
			$this->session->set_userdata('admin',$session);
			redirect('admin/dashboard');
		}
		$this->load->view('login/admin/login');
	}
	public function adminLogin()
	{
		$username = $this->security->xss_clean($this->input->post('username'));
		$pass = $this->security->xss_clean($this->input->post('password'));
		$password = md5($pass);

		$details = [
			'UserName' => $username,
			'Password' => $password
		];

		$check = $this->Common->get_details('auth',$details);
		if ( $check->num_rows() > 0 ) 
		{
			$user = $check->row();
			$session = [
				'admin_id' => $user->AuthID,
				'name' => $user->UserName
			];
			$this->session->set_userdata('admin',$session);

			$hour = time() + 3600 * 24 * 30;
		    setcookie('admin_farmroot_id', $user->AuthID, $hour);
			setcookie('admin_farmroot_name', $user->UserName, $hour);
			redirect('admin/dashboard');
		}
		else 
		{
			$this->session->set_flashdata('message','Login failed..!');
			redirect('app');
		}

	}
	public function logout()
	{
		setcookie('admin_farmroot_id');
		setcookie('admin_farmroot_name');

		$this->session->unset_userdata('admin');

		redirect('app');
	}

}
