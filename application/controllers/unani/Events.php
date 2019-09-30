<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('Common');
			$this->load->model('unani/M_events','events');
	}
	public function index()
	{
		$this->load->view('unani/events/view');
	}
	public function get()
	{
		$result = $this->events->make_datatables();
		$data = array();
		foreach ($result as $res) {
			$sub_array = array();
			$sub_array[] = $res->title;
			$sub_array[] = $res->description;
			$sub_array[] = $res->date;
			$sub_array[] = $res->time;
			$sub_array[] = $res->days;
			$sub_array[] = $res->venue;
			$sub_array[] = $res->status;
			$sub_array[] = '<a class="btn btn-link" style="font-size:24px;" href="' . site_url('unani/events/edit/'.$res->id) . '"><i class="fa fa-pencil-square-o"></i></a>';
			$data[] = $sub_array;
		}

		$output = array(
			"draw"   => intval($_POST['draw']),
			"recordsTotal" => $this->events->get_all_data(),
			"recordsFiltered" => $this->events->get_filtered_data(),
			"data" => $data
		);
		echo json_encode($output);
	}

	public function add()
	{
		$this->load->view('unani/events/add');
	}

	public function edit($id)
	{
		$check = $this->Common->get_details('events',array('id' => $id));
		if ($check->num_rows() > 0) {
			$data['event'] = $check->row();
			$this->load->view('unani/events/edit',$data);
		}
		else 
		{
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to load event..!');

			redirect('unani/events');
		}
	}

	public function addEvent()
	{
		$title        = $this->security->xss_clean($this->input->post('name'));
		$description  = $this->security->xss_clean($this->input->post('description'));
		$date         = $this->security->xss_clean($this->input->post('date'));
		$time         = $this->security->xss_clean($this->input->post('time'));
		$venue        = $this->security->xss_clean($this->input->post('venue'));
		$no_of_days   = $this->security->xss_clean($this->input->post('no_of_days'));

		$event_check  = $this->Common->get_details('events',array('title'=>$title,'description'=>$description,'date'=>$date,'time'=>$time,'venue'=>$venue));
        if($event_check->num_rows()>0)
        {
        	$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add events..!');

			redirect('unani/events');
	    }
	    else		
        {
		    $array = [
						'title'       => $title,
						'description' => $description,
						'date'        => $date,
						'time'        => $time,
						'days'        => $no_of_days,
						'venue'       => $venue,
						'status'      => 'open'
				     ];

				if ($this->Common->insert('events',$array)) {
					$this->session->set_flashdata('alert_type', 'success');
					$this->session->set_flashdata('alert_title', 'Success');
					$this->session->set_flashdata('alert_message', 'New event added successfully..!');

					redirect('unani/events');
				}
				else {
					$this->session->set_flashdata('alert_type', 'error');
					$this->session->set_flashdata('alert_title', 'Failed');
					$this->session->set_flashdata('alert_message', 'Failed to add event..!');

					redirect('unani/events');
				}
		}
    }
	public function editEvent()
	{
		$id = $this->security->xss_clean($this->input->post('event_id'));

		$title        = $this->security->xss_clean($this->input->post('name'));
		$description  = $this->security->xss_clean($this->input->post('description'));
		$date         = $this->security->xss_clean($this->input->post('date'));
		$time         = $this->security->xss_clean($this->input->post('time'));
		$venue        = $this->security->xss_clean($this->input->post('venue'));
		$no_of_days   = $this->security->xss_clean($this->input->post('no_of_days'));
		$status       = $this->security->xss_clean($this->input->post('status'));
	    
	    $check       = $this->Common->get_details('category',array('category_name' => $category , 'category_id!=' => $category_id))->num_rows();
		if ($check > 0) 
		{
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add category..!');

			redirect('admin/category/edit/'.$category_id);
		}
		else 
		{
			   $array = [
						'title'       => $title,
						'description' => $description,
						'date'        => $date,
						'time'        => $time,
						'days'        => $no_of_days,
						'venue'       => $venue,
						'status'      => $status
				     ];


				if ($this->Common->update('id',$id,'events',$array)) 
				{
					$this->session->set_flashdata('alert_type', 'success');
					$this->session->set_flashdata('alert_title', 'Success');
					$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

					redirect('unani/events');
				}
				else {
					$this->session->set_flashdata('alert_type', 'error');
					$this->session->set_flashdata('alert_title', 'Failed');
					$this->session->set_flashdata('alert_message', 'Failed to update event..!');

					redirect('unani/events/edit/'.$id);
				}
			}
	}

	public function validation()
	{
		$email = $this->security->xss_clean($this->input->post('email'));
		$mobile = $this->security->xss_clean($this->input->post('mobile'));

		if ($email == '') {
			$checkEmail = 0;
		}
		else {
			$checkEmail = $this->Common->get_details('yunani_directory',array('email' => $email))->num_rows();
		}
		$checkMobile = $this->Common->get_details('yunani_directory',array('mobile' => $mobile))->num_rows();
		$array = [
			'mobile' => false,
			'email' => false
		];
		if ($checkMobile > 0) {
			$array['mobile'] = true;
		}
		if ($checkEmail > 0) {
			$array['email'] = true;
		}
		print_r(json_encode($array));
	}
	public function validationEdit()
	{
		$id = $this->security->xss_clean($this->input->post('id'));
		$email = $this->security->xss_clean($this->input->post('email'));
		$mobile = $this->security->xss_clean($this->input->post('mobile'));

		if ($email == '') {
			$checkEmail = 0;
		}
		else {
			$checkEmail = $this->Common->get_details('yunani_directory',array('email' => $email , 'id!=' => $id))->num_rows();
		}
		$checkMobile = $this->Common->get_details('yunani_directory',array('mobile' => $mobile , 'id!=' => $id))->num_rows();
		$array = [
			'mobile' => false,
			'email' => false
		];
		if ($checkMobile > 0) {
			$array['mobile'] = true;
		}
		if ($checkEmail > 0) {
			$array['email'] = true;
		}
		print_r(json_encode($array));
	}

	function getKey() 
	{
		while (true) {
			$key = $this->key();
			$cond = [
				'auth' => $key
			];

			$check = $this->Common->get_details('users',$cond);

			if ($check->num_rows() == 0) {
				break;
			}
		}
		return $key;
  }

	function key()
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 20; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
		return $randomString;
	}

	public function changePassword()
	{
		$id = $this->security->xss_clean($this->input->post('id'));
		$password = $this->security->xss_clean($this->input->post('password'));

		$array = [
			'password' => md5($password)
		];

		if ($this->Common->update('id',$id,'users',$array)) {
			$this->session->set_flashdata('alert_type', 'success');
			$this->session->set_flashdata('alert_title', 'Success');
			$this->session->set_flashdata('alert_message', 'Password changed successfully..!');
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to update user password..!');
		}
		redirect('unani/directories');
	}

	public function getdirectoryDetails()
	{
		$mobile = $this->security->xss_clean($this->input->post('mobile'));
		$get = $this->Common->get_details('users',array('mobile' => $mobile));
		if ($get->num_rows() > 0) {
			$return = [
				'user' => true,
				'id' => $get->row()->id,
				'name' => $get->row()->username,
				'mobile' => $get->row()->mobile
			];
		}
		else {
			$return = [
				'user' => false
			];
		}

		print_r(json_encode($return));
	}
}
?>
