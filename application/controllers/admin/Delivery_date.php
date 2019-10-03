<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_date extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/Delivery_dates','date');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{
		$this->load->view('admin/delivery_date/view');
	}
	public function get()
	{
		$result = $this->date->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$date        = date('d-M-Y',strtotime($res->delivery_date)); 
			$sub_array[] = $date;
			$sub_array[] = $res->category;
			$sub_array[] = '<a class="btn btn-link" style="font-size:20px;color:blue" href="' . site_url('admin/delivery_date/edit/'.$res->delivery_id) . '" ><i class="fa fa-edit"></i></a>';
            $sub_array[]  = '<a class="btn btn-link" style="font-size:20px;color:red" href="' . site_url('admin/delivery_date/delete/'.$res->delivery_id) . '"  onclick="return del()"><i class="fa fa-trash"></i></a>';
         
			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->date->get_all_data(),
						"recordsFiltered" => $this->date->get_filtered_data(),
						"data"            => $data
					   );
		echo json_encode($output);
	}

	public function edit($id)
	{
		$check = $this->Common->get_details('delivery',array('delivery_id' => $id));
		if ($check->num_rows() > 0) {
			$data['date'] = $check->row();
			$this->load->view('admin/delivery_date/edit',$data);
		}
		else {
			redirect('delivery_date');
		}
	}
	public function addData()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');

		$delivery_date = $this->security->xss_clean($this->input->post('delivery_date'));
		$category      = $this->security->xss_clean($this->input->post('category'));
		
		$date_check = $this->Common->get_details('delivery',array('delivery_date'=>$delivery_date,'category'=>$category));
		if($date_check->num_rows()==0)
        {
			$array = [
						'delivery_date'  => $delivery_date,
						'category'       => $category,
				        'timestamp'      => $timestamp
					];
			if ($this->Common->insert('delivery',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'New delivery date added..!');

				redirect('admin/delivery_date');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add delivery date..!');

				redirect('admin/delivery_date');
			}		
        }
        else
        {
    	  $this->session->set_flashdata('alert_type', 'error');
		  $this->session->set_flashdata('alert_title', 'Failed');
		  $this->session->set_flashdata('alert_message', 'Delivery date already exists..!');
          redirect('admin/delivery_date');
        }			
	}

	public function update()
	{
		$delivery_id   = $this->input->post('delivery_id');
		$category      = $this->security->xss_clean($this->input->post('category'));
		$delivery_date = $this->security->xss_clean($this->input->post('delivery_date'));
		$check         = $this->Common->get_details('delivery',array('category' => $category,'delivery_date'=>$delivery_date,'delivery_id!=' => $delivery_id))->num_rows();
		if ($check > 0) 
		{
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add delivery date..!');

			redirect('admin/delivery_date');
		}
		else 
		{
			$array = [
				        'delivery_date'  => $delivery_date,
						'category'       => $category,
			         ];
		
			if ($this->Common->update('delivery_id',$delivery_id,'delivery',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/delivery_date');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to edit delivery date..!');

				redirect('admin/delivery_date');
			}
	    }
	}

	public function getVendorById()
	{
		$id = $_POST['id'];
		$data = $this->Common->get_details('vendors',array('VendorID' => $id))->row();
		print_r(json_encode($data));
	}

	public function delete($id)
	{
		$check = $this->Common->get_details('delivery',array('delivery_id' => $id));
		if ($check->num_rows() > 0) 
		{
			$banner = $check->row();
			if ($this->Common->delete('delivery',array('delivery_id' => $id))) {
				
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Delivery date deleted successfully..!');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to remove delivery date..!');
			}
		}
		else 
		{
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to remove delivery date..!');
		}
		redirect('admin/delivery_date');
	}

}
?>
