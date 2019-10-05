<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_location extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/Delivery_locations','location');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{
		$this->load->view('admin/delivery_location/view');
	}
	public function get()
	{
		$result = $this->location->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->place_name;
			$sub_array[] = $res->district;
			// $sub_array[] = $res->latitude;
			// $sub_array[] = $res->longitude;
            $sub_array[]  = '<a class="btn btn-link" style="font-size:20px;color:red" href="' . site_url('admin/delivery_location/delete/'.$res->del_id) . '"  onclick="return del()"><i class="fa fa-trash"></i></a>';
         
			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->location->get_all_data(),
						"recordsFiltered" => $this->location->get_filtered_data(),
						"data"            => $data
					   );
		echo json_encode($output);
	}

	public function addData()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');

		$delivery_location = $this->security->xss_clean($this->input->post('delivery_location'));
		$district          = $this->security->xss_clean($this->input->post('district'));
		$latitude          = $this->security->xss_clean($this->input->post('latitude'));
		$longitude         = $this->security->xss_clean($this->input->post('longitude'));

		$location_check = $this->Common->get_details('delivery_locations',array('place_name'=>$delivery_location,'district'=>$district));
		if($location_check->num_rows()==0)
        {
			$array = [
						'place_name'     => $delivery_location,
						'district'       => $district,
						'latitude'       => $latitude,
						'longitude'      => $longitude,
						'status'         => 'Active',
				        'timestamp'      => $timestamp
					];
			if ($this->Common->insert('delivery_locations',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'New delivery location added..!');

				redirect('admin/delivery_location');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add delivery location..!');

				redirect('admin/delivery_location');
			}		
        }
        else
        {
    	  $this->session->set_flashdata('alert_type', 'error');
		  $this->session->set_flashdata('alert_title', 'Failed');
		  $this->session->set_flashdata('alert_message', 'Delivery location already exists..!');
          redirect('admin/delivery_location');
        }			
	}

	public function delete($id)
	{	
			$array = [
						'status'       => 'Blocked',
			         ];
		
			if ($this->Common->update('del_id',$id,'delivery_locations',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/delivery_location');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to edit delivery location..!');

				redirect('admin/delivery_location');
			}
	}

}
?>
