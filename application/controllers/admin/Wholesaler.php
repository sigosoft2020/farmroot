<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wholesaler extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_wholesaler','wholesaler');
			$this->load->model('admin/Wholesaler_request','request');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{
		$this->load->view('admin/wholesaler/view');
	}

	public function get()
	{
		$result = $this->wholesaler->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->name;
			$sub_array[] = $res->phone;
			$sub_array[] = $res->email;
			$sub_array[] = $res->city;
			$sub_array[] = '<button type="button" class="btn btn-link" style="font-size:20px;color:blue" onclick="view(' . $res->reg_id . ')"><i class="fa fa-eye"></i></button>';
            $sub_array[]    = '<a class="btn btn-link" style="font-size:24px;color:red" href="' . site_url('admin/wholesaler/delete/'.$res->reg_id) . '" onclick="return del()"><i class="fa fa-trash"></i></a>'; 

			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->wholesaler->get_all_data(),
						"recordsFiltered" => $this->wholesaler->get_filtered_data(),
						"data"            => $data
					   );
		echo json_encode($output);
	}

	public function request()
	{
		$this->load->view('admin/wholesaler/request');
	}
    
    public function get_request()
	{
		$result = $this->request->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->name;
			$sub_array[] = $res->phone;
			$sub_array[] = $res->email;
			$sub_array[] = $res->city;
			$sub_array[] = '<a class="btn btn-link" style="font-size:16px;color:green" href="' . site_url('admin/wholesaler/approve/'.$res->reg_id) . '" onclick="return approve()">Approve</a>';
            $sub_array[]    = '<a class="btn btn-link" style="font-size:24px;color:red" href="' . site_url('admin/wholesaler/delete_wholesaler/'.$res->reg_id) . '" onclick="return del()"><i class="fa fa-trash"></i></a>'; 

			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->request->get_all_data(),
						"recordsFiltered" => $this->request->get_filtered_data(),
						"data"            => $data
					   );
		echo json_encode($output);
	}

	public function delete($id)
	{
			$array = [
				       'stat' => 'disable'
			         ];
		
			if ($this->Common->update('reg_id',$id,'bulorder_register',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Wholesaler removed  successfully..!');

				redirect('admin/wholesaler');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to remove wholesaler..!');

				redirect('admin/wholesaler');
			}
	}

	public function approve($id)
	{
			$array = [
				       'stat' => 'active'
			         ];
		
			if ($this->Common->update('reg_id',$id,'bulorder_register',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Wholesaler approved  successfully..!');

				redirect('admin/wholesaler');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to approve wholesaler..!');

				redirect('admin/wholesaler');
			}
	}
    
    public function delete_wholesaler($id)
	{
			$array = [
				       'stat' => 'disable'
			         ];
		
			if ($this->Common->update('reg_id',$id,'bulorder_register',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Request removed  successfully..!');

				redirect('admin/wholesaler/request');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to remove request..!');

				redirect('admin/wholesaler/request');
			}
	}

	public function getWholesalerById()
	{
		$id = $_POST['id'];
		$data = $this->Common->get_details('bulorder_register',array('reg_id' => $id))->row();
		print_r(json_encode($data));
	}
}
?>
