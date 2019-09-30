<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_testimonial','testimonial');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{
		$this->load->view('admin/testimonial/view');
	}
	public function get()
	{
		$result = $this->testimonial->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = '<img src="' . base_url() . $res->image . '" height="100px">';
			$sub_array[] = $res->name;
			$sub_array[] = $res->position;
			$sub_array[] = $res->description;
			$sub_array[] = $res->status;
			$sub_array[] = '<a class="btn btn-link" style="font-size:16px;color:blue" href="' . site_url('admin/testimonial/edit/'.$res->id) . '"><i class="fa fa-pencil"></i></a>';
            $sub_array[]    = '<a class="btn btn-link" style="font-size:16px;color:red" href="' . site_url('admin/testimonial/delete/'.$res->id) . '"  onclick="return del()"><i class="fa fa-trash"></i></a>'; 

			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->testimonial->get_all_data(),
						"recordsFiltered" => $this->testimonial->get_filtered_data(),
						"data"            => $data
					   );
		echo json_encode($output);
	}

	public function add()
	{
		$this->load->view('admin/testimonial/add');
	}
	public function edit($id)
	{
		$check = $this->Common->get_details('testimonial',array('id' => $id));
		if ($check->num_rows() > 0) {
			$data['testimonial'] = $check->row();
			$this->load->view('admin/testimonial/edit',$data);
		}
		else {
			redirect('testimonial');
		}
	}
	public function addTestimonial()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');

		$name         = $this->security->xss_clean($this->input->post('name'));
		$position     = $this->security->xss_clean($this->input->post('position'));
		$description  = $this->security->xss_clean($this->input->post('description'));
		$image        = $this->input->post('image');
		$img          = substr($image, strpos($image, ",") + 1);

		$check = $this->Common->get_details('testimonial',array('name'=>$name,'position'=>$position,'description'=>$description));
		if($check->num_rows()==0)
        {
        	$url      = FCPATH.'uploads/admin/testimonial/';
			$rand     = $name.date('Ymd').mt_rand(1001,9999);
			$userpath = $url.$rand.'.png';
			$path     = "uploads/admin/testimonial/".$rand.'.png';
			file_put_contents($userpath,base64_decode($img));

			$array = [
						'name'           => $name,
						'image'          => $path,
						'position'       => $position,
						'description'    => $description,
						'status'         => 'Active',
						'timestamp'      => $timestamp
					];
			if ($this->Common->insert('testimonial',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'New testimonial added..!');

				redirect('admin/testimonial');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add testimonial..!');

				redirect('admin/testimonial/add');
			}		
        }
        else
        {
    	  $this->session->set_flashdata('alert_type', 'error');
		  $this->session->set_flashdata('alert_title', 'Failed');
		  $this->session->set_flashdata('alert_message', 'Testimonial already added..!');
          redirect('admin/testimonial');
        }	
	}

	public function update()
	{
		$testimonial_id = $this->input->post('testimonial_id');
		$name         = $this->security->xss_clean($this->input->post('name'));
		$position     = $this->security->xss_clean($this->input->post('position'));
		$description  = $this->security->xss_clean($this->input->post('description'));

		$check          = $this->Common->get_details('testimonial',array('name' => $name,'position'=>$position,'description'=>$description,'id!=' => $testimonial_id))->num_rows();
		if ($check > 0) {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add testimonial..!');

			redirect('admin/testimonial/edit/'.$testimonial_id);
		}
		else {
			// Adding base64 file to server
			$image  = $this->input->post('image');
			$status = $this->input->post('status');
			if ($image != '') {
				$img = substr($image, strpos($image, ",") + 1);

				$url      = FCPATH.'uploads/admin/testimonial/';
				$rand     = $name.date('Ymd').mt_rand(1001,9999);
				$userpath = $url.$rand.'.png';
				$path     = "uploads/admin/testimonial/".$rand.'.png';
				file_put_contents($userpath,base64_decode($img));

				// Remove old image from the server
				$old = $this->Common->get_details('testimonial',array('id' => $testimonial_id))->row()->image;
				$remove_path = FCPATH . $old;
				unlink($remove_path);

				$array = [
					'name'        => $name,
					'image'       => $path,
					'position'    => $position,
					'description' => $description,
					'status'      => $status
				];
			}
			else {
				$array = [
					'name'        => $name,
					'position'    => $position,
					'description' => $description,
					'status'      => $status
				];
			}

			if ($this->Common->update('id',$testimonial_id,'testimonial',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/testimonial');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to update testimonial..!');

				redirect('admin/testimonial/edit/'.$testimonial_id);
			}
		}
	}
  
   public function delete($id)
	{
		$check = $this->Common->get_details('testimonial',array('id' => $id));
		if ($check->num_rows() > 0) {
			if ($this->Common->delete('testimonial',array('id' => $id))) {
				
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Testimonial deleted successfully..!');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to remove testimonial..!');
			}
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to remove testimonial..!');
		}
		redirect('admin/testimonial');
	}
	
}
?>
