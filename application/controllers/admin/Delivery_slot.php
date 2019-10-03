<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_slot extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/Delivery_slots','slot');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{
		$this->load->view('admin/delivery_slot/view');
	}
	public function get()
	{
		$result = $this->slot->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->delivery_slot;
			$sub_array[] = $res->category;
			$sub_array[] = '<a class="btn btn-link" style="font-size:20px;color:blue" href="' . site_url('admin/delivery_slot/edit/'.$res->slot_id) . '" ><i class="fa fa-edit"></i></a>';
            $sub_array[]  = '<a class="btn btn-link" style="font-size:20px;color:red" href="' . site_url('admin/delivery_slot/delete/'.$res->slot_id) . '"  onclick="return del()"><i class="fa fa-trash"></i></a>';
         
			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->slot->get_all_data(),
						"recordsFiltered" => $this->slot->get_filtered_data(),
						"data"            => $data
					   );
		echo json_encode($output);
	}

	public function edit($id)
	{
		$check = $this->Common->get_details('delivery_slot',array('slot_id' => $id));
		if ($check->num_rows() > 0) {
			$data['slot'] = $check->row();
			$this->load->view('admin/delivery_slot/edit',$data);
		}
		else {
			redirect('delivery_slot');
		}
	}
	public function addData()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');

		$delivery_slot = $this->security->xss_clean($this->input->post('delivery_slot'));
		$category      = $this->security->xss_clean($this->input->post('category'));
		
		$slot_check = $this->Common->get_details('delivery_slot',array('delivery_slot'=>$delivery_slot,'category'=>$category));
		if($slot_check->num_rows()==0)
        {
			$array = [
						'delivery_slot'  => $delivery_slot,
						'category'       => $category,
				        'timestamp'      => $timestamp
					];
			if ($this->Common->insert('delivery_slot',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'New delivery slot added..!');

				redirect('admin/delivery_slot');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add delivery slot..!');

				redirect('admin/delivery_slot');
			}		
        }
        else
        {
    	  $this->session->set_flashdata('alert_type', 'error');
		  $this->session->set_flashdata('alert_title', 'Failed');
		  $this->session->set_flashdata('alert_message', 'Delivery slot already exists..!');
          redirect('admin/delivery_slot');
        }			
	}

	public function update()
	{
		$slot_id       = $this->input->post('slot_id');
		$category      = $this->security->xss_clean($this->input->post('category'));
		$delivery_slot = $this->security->xss_clean($this->input->post('delivery_slot'));
		$check         = $this->Common->get_details('delivery_slot',array('category' => $category,'delivery_slot'=>$delivery_slot,'slot_id!=' => $slot_id))->num_rows();
		if ($check > 0) 
		{
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add delivery slot..!');

			redirect('admin/delivery_slot');
		}
		else 
		{
			$array = [
				        'delivery_slot'  => $delivery_slot,
						'category'       => $category,
			         ];
		
			if ($this->Common->update('slot_id',$slot_id,'delivery_slot',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/delivery_slot');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to edit delivery slot..!');

				redirect('admin/delivery_slot');
			}
	    }
	}

	public function delete($id)
	{
		$check = $this->Common->get_details('delivery_slot',array('slot_id' => $id));
		if ($check->num_rows() > 0) 
		{
			$banner = $check->row();
			if ($this->Common->delete('delivery_slot',array('slot_id' => $id))) {
				
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Delivery slot deleted successfully..!');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to remove delivery slot..!');
			}
		}
		else 
		{
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to remove delivery slot..!');
		}
		redirect('admin/delivery_slot');
	}

}
?>
