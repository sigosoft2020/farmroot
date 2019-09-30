<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('unani/M_dashboard','dash');
			// if (!owner()) {
			// 	redirect('app/owner');
			// }
	}
	public function index()
	{
		$data['user'] = $this->dash->getUserCount();
		$data['news'] = $this->dash->getNewsCount();
		$data['slider'] = $this->dash->getSliderCount();
		$data['gallery'] = $this->dash->getGalleryCount();
		
		$data['users'] = $this->dash->getUsers();
		$data['newses'] = $this->dash->getNewses();

		$this->load->view('unani/dashboard/dashboard',$data);
	}
}
?>
