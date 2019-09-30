<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_newsletter','newsletter');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{
		$this->load->view('admin/subscription/view');
	}
	public function get()
	{
		$result = $this->newsletter->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->news_email;
			$sub_array[] = $res->news_status;

			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->newsletter->get_all_data(),
						"recordsFiltered" => $this->newsletter->get_filtered_data(),
						"data"            => $data
					   );
		echo json_encode($output);
	}

}
?>
