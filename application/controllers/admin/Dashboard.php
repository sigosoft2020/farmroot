<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_dashboardAdmin','dash');
			if (!admin()) {
				redirect('app/admin');
			}
	}
	public function index()
	{
		$admin = $this->session->userdata['admin'];
		$admin_id = $admin['admin_id'];

		// $data['pending']   = $this->dash->pending_orders();
		// $data['cancelled'] = $this->dash->cancelled_orders();
		// $data['delivered'] = $this->dash->delivered_orders();
		// $data['total'] = $this->dash->total_orders();

		$this->load->view('admin/dashboard/dashboard');
	}
}
?>
