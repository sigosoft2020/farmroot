<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ask_doctor extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('unani/M_ask','ask');
			$this->load->model('Common');
	}
	
	public function index()
	{
		$this->load->view('unani/ask_doctor/view');
	}

	public function get()
	{
		$result = $this->ask->make_datatables();
		$data = array();
		foreach ($result as $res) {
            if($res->answer=='')
            {
              $answer = '<button type="button" class="btn btn-success" onclick="add(' . $res->id . ',`' . $res->question . '`)"><i class="fa fa-plus"></i></button>';	
            }
            else
            {
             $answer = '<button type="button" class="btn btn-success" onclick="edit(' . $res->id . ',`'.$res->answer .'`,`' . $res->question .'`)"><i class="fa fa-edit"></i></button>';
            }

			$sub_array = array();
			$sub_array[] = $res->name;
			$sub_array[] = $res->category;
			$sub_array[] = $res->question;
			$sub_array[] = $res->ask_status;
			$sub_array[] = $answer;

			$data[] = $sub_array;
		}

		$output = array(
			"draw"   => intval($_POST['draw']),
			"recordsTotal" => $this->ask->get_all_data(),
			"recordsFiltered" => $this->ask->get_filtered_data(),
			"data" => $data
		);
		echo json_encode($output);
	}

	public function add_answer()
	{   
		$id           = $this->security->xss_clean($this->input->post('ask_id'));
		$answer       = $this->security->xss_clean($this->input->post('answer'));

		$array = [
					'answer'    => $answer,
					'status'    => 'Answered'
			     ];
		if ($this->Common->update('id',$id,'ask_doctor',$array)) 
		{
			$this->session->set_flashdata('alert_type', 'success');
			$this->session->set_flashdata('alert_title', 'Success');
			$this->session->set_flashdata('alert_message', 'Answer added successfully..!');

			redirect('unani/ask_doctor');
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add answer..!');

			redirect('unani/ask_doctor');
		}
	}

	public function edit_answer()
	{   
		$id           = $this->security->xss_clean($this->input->post('qst_id'));
		$answer       = $this->security->xss_clean($this->input->post('answer'));

		$array = [
					'answer'    => $answer
			     ];
		if ($this->Common->update('id',$id,'ask_doctor',$array)) 
		{
			$this->session->set_flashdata('alert_type', 'success');
			$this->session->set_flashdata('alert_title', 'Success');
			$this->session->set_flashdata('alert_message', 'Answer edited successfully..!');

			redirect('unani/ask_doctor');
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to edit answer..!');

			redirect('unani/ask_doctor');
		}
	}
}
?>
