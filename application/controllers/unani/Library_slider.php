<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library_slider extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('unani/M_sliders','sliders');
			$this->load->model('Common');
			// if (!unani()) {
			// 	redirect('app');
			// }
	}
	
	public function index()
	{
		$this->load->view('unani/library_slider/view');
	}

	public function get()
	{
		$result = $this->sliders->make_datatables();
		$data = array();
		foreach ($result as $res) {
			$sub_array = array();
			$sub_array[] = '<img src="' . base_url() . $res->image . '" height="100px">';
			$sub_array[] = $res->title;
			$sub_array[] = '<a class="btn btn-link" style="font-size:24px;color:red" href="' . site_url('unani/library_slider/delete/'.$res->lib_id) . '" onclick="return del()"><i class="fa fa-trash"></i></a>';

			$data[] = $sub_array;
		}

		$output = array(
			"draw"   => intval($_POST['draw']),
			"recordsTotal" => $this->sliders->get_all_data(),
			"recordsFiltered" => $this->sliders->get_filtered_data(),
			"data" => $data
		);
		echo json_encode($output);
	}

	public function add()
	{   
		$data['library'] = $this->Common->get_details('yunani_library',array('status'=>'Active'))->result();
		$this->load->view('unani/library_slider/add',$data);
	}

	public function addslider()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');

		$library = $this->security->xss_clean($this->input->post('library'));
		$image   = $this->input->post('image');
		$img     = substr($image, strpos($image, ",") + 1);

		$url      = FCPATH.'uploads/unani/library/images/slides/';
		$rand     = $slider.date('Ymd').mt_rand(1001,9999);
		$userpath = $url.$rand.'.png';
		$path     = "uploads/unani/library/images/slides/".$rand.'.png';
		file_put_contents($userpath,base64_decode($img));

		$array = [
			'library_id' => $library,
			'image'      => $path,
			'timestamp'  => $timestamp
		];
		if ($this->Common->insert('library_slider',$array)) {
			$this->session->set_flashdata('alert_type', 'success');
			$this->session->set_flashdata('alert_title', 'Success');
			$this->session->set_flashdata('alert_message', 'New slider added..!');

			redirect('unani/library_slider');
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add slider..!');

			redirect('unani/library_slider/add');
		}
	}

	public function delete($slider_id)
	{
		$check = $this->Common->get_details('library_slider',array('id' => $slider_id));
		if ($check->num_rows() > 0) 
		{
			$slider = $check->row();
			if ($this->Common->delete('library_slider',array('id' => $slider_id))) {
				$remove_path = FCPATH . $slider->image;
				unlink($remove_path);

				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'slider deleted successfully..!');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to remove slider..!');
			}
		}
		else 
		{
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to remove slider..!');
		}
		redirect('unani/library_slider');
	}
}
?>
