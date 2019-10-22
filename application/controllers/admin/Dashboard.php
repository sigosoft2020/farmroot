<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_dashboard','dash');
			if (!admin()) {
				redirect('app/admin');
			}
	}
	public function index()
	{   
		$current  = date('Y-m-d');
		$admin = $this->session->userdata['admin'];
		$admin_id = $admin['admin_id'];

		$data['pending']   = $this->dash->pending_orders();
		$data['cancelled'] = $this->dash->cancelled_orders();
		$data['delivered'] = $this->dash->delivered_orders();
		$data['total']     = $this->dash->total_orders();

		$data['pending_today']   = $this->dash->pending_today($current);
		$data['cancelled_today'] = $this->dash->cancelled_today($current);
		$data['delivered_today'] = $this->dash->delivered_today($current);
		$data['total_today']     = $this->dash->total_today($current);

		$this->load->view('admin/dashboard/dashboard',$data);
	}
}
?>
