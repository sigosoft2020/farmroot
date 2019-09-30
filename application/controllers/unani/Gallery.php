<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('Common');
			$this->load->model('unani/M_gallery','gallery');
			// if (!unani()) {
			// 	redirect('app');
			// }
	}
	public function index()
	{
		$this->load->view('unani/gallery/view');
	}

	public function get()
	{
		$result = $this->gallery->make_datatables();
		$data = array();
		foreach ($result as $res) {

			$sub_array = array();
			$sub_array[] = '<img src="' . base_url() . $res->image . '" width="100px" height="100px">';
			$sub_array[] = $res->name;
			$sub_array[] = $res->description;
			$sub_array[] = '<a class="btn btn-link" style="font-size:24px;" href="' . site_url('unani/gallery/edit/'.$res->id) . '"><i class="fa fa-pencil-square-o"></i></a>';
			$sub_array[] = '<a class="btn btn-link" onclick="confirm(`Are you sure to delete this gallery?`)" style="font-size:24px;" href="' . site_url('unani/gallery/delete/'.$res->id) . '"><i style="color:red;" class="fa fa-trash"></i></a>';

			$data[] = $sub_array;
		}

		$output = array(
			"draw"   => intval($_POST['draw']),
			"recordsTotal" => $this->gallery->get_all_data(),
			"recordsFiltered" => $this->gallery->get_filtered_data(),
			"data" => $data
		);
		echo json_encode($output);
	}

	public function add()
	{
		$this->load->view('unani/gallery/add');
	}

	public function addgallery()
	{
		$name = $this->security->xss_clean($this->input->post('title'));
		$description = $this->security->xss_clean($this->input->post('description'));

		$image = $this->input->post('image');
		$img = substr($image, strpos($image, ",") + 1);

		$url = FCPATH.'uploads/unani/gallery/';
		$rand = $name . date('Ymd') . mt_rand(1001,9999);
		$userpath = $url.$rand.'.png';
		$path = "uploads/unani/gallery/".$rand.'.png';
		file_put_contents($userpath,base64_decode($img));

		$array = [
			'name' => $name,
			'description' => $description,
			'image' => $path
		];

		if ( $this->Common->insert('gallery',$array) ) {
			$this->session->set_flashdata('alert_type', 'success');
			$this->session->set_flashdata('alert_title', 'Success');
			$this->session->set_flashdata('alert_message', 'New gallery added..!');
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add gallery..!');
		}

		redirect('unani/gallery');
	}

	public function editgallery()
	{
		$id = $this->security->xss_clean($this->input->post('id'));

		$name = $this->security->xss_clean($this->input->post('title'));
		$description = $this->security->xss_clean($this->input->post('description'));
		$image = $this->input->post('image');

		$array = [
			'name' => $name,
			'description' => $description,
		];

		if ($image != '') {
			$img = $this->Common->get_details('gallery',array('id' => $id))->row();
			$remove_path = FCPATH . $img->image;

			$img = substr($image, strpos($image, ",") + 1);

			$url = FCPATH.'uploads/unani/gallery/';
			$rand = $name . date('Ymd') . mt_rand(1001,9999);
			$userpath = $url . $rand .'.png';
			$path = "uploads/unani/gallery/".$rand.'.png';
			file_put_contents($userpath,base64_decode($img));

			$array['image'] = $path;

			unlink($remove_path);
		}

		if ( $id = $this->Common->update('id',$id,'gallery',$array) ) {
			$this->session->set_flashdata('alert_type', 'success');
			$this->session->set_flashdata('alert_title', 'Success');
			$this->session->set_flashdata('alert_message', 'gallery updated..!');
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'gallery updation image..!');
		}

		redirect('unani/gallery');
	}

	public function edit($id)
	{
		$gallery = $this->Common->get_details('gallery',array('id' => $id));
		if ($gallery->num_rows() > 0) {
			$data['gallery'] = $gallery->row();
			$this->load->view('unani/gallery/edit',$data);
		}
		else {
			redirect('unani/gallery');
		}
	}

	public function delete($id)
	{
		$gallery = $this->Common->get_details('gallery',array('id' => $id))->row();
		if($this->Common->delete('gallery',array('id' => $id)))
		{
			$remove_path = FCPATH . $gallery->image;
			unlink($remove_path);

			$this->session->set_flashdata('alert_type', 'success');
			$this->session->set_flashdata('alert_title', 'Success');
			$this->session->set_flashdata('alert_message', 'gallery deleted successfully..!');
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to remove gallery..!');
		}

		redirect('unani/gallery');
	}

}
?>
