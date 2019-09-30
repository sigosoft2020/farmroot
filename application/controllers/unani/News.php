<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('Common');
			$this->load->model('unani/M_news','news');
			// if (!unani()) {
			// 	redirect('app');
			// }
	}
	public function index()
	{
		$this->load->view('unani/news/view');
	}

	public function get()
	{
		$result = $this->news->make_datatables();
		$data = array();
		foreach ($result as $res) {

			$sub_array = array();
			$sub_array[] = '<img src="' . base_url() . $res->image . '" width="100px" height="100px">';
			$sub_array[] = $res->title;
			$sub_array[] = $res->description;
			$sub_array[] = '<a class="btn btn-link" style="font-size:24px;" href="' . site_url('unani/news/edit/'.$res->id) . '"><i class="fa fa-pencil-square-o"></i></a>';
			$sub_array[] = '<a class="btn btn-link" onclick="confirm(`Are you sure to delete this news?`)" style="font-size:24px;" href="' . site_url('unani/news/delete/'.$res->id) . '"><i style="color:red;" class="fa fa-trash"></i></a>';

			$data[] = $sub_array;
		}

		$output = array(
			"draw"   => intval($_POST['draw']),
			"recordsTotal" => $this->news->get_all_data(),
			"recordsFiltered" => $this->news->get_filtered_data(),
			"data" => $data
		);
		echo json_encode($output);
	}

	public function add()
	{
		$this->load->view('unani/news/add');
	}

	public function addNews()
	{
		$title = $this->security->xss_clean($this->input->post('title'));
		$description = $this->security->xss_clean($this->input->post('description'));

		$image = $this->input->post('image');
		$img = substr($image, strpos($image, ",") + 1);

		$url = FCPATH.'uploads/unani/news/';
		$rand = $title . date('Ymd') . mt_rand(1001,9999);
		$userpath = $url.$rand.'.png';
		$path = "uploads/unani/news/".$rand.'.png';
		file_put_contents($userpath,base64_decode($img));

		$array = [
			'title' => $title,
			'description' => $description,
			'image' => $path
		];

		if ( $this->Common->insert('news',$array) ) {
			$this->session->set_flashdata('alert_type', 'success');
			$this->session->set_flashdata('alert_title', 'Success');
			$this->session->set_flashdata('alert_message', 'New news added..!');
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add news..!');
		}

		redirect('unani/news');
	}

	public function editNews()
	{
		$id = $this->security->xss_clean($this->input->post('news_id'));

		$title = $this->security->xss_clean($this->input->post('title'));
		$description = $this->security->xss_clean($this->input->post('description'));
		$image = $this->input->post('image');

		$array = [
			'title' => $title,
			'description' => $description,
		];

		if ($image != '') {
			$img = $this->Common->get_details('news',array('id' => $id))->row();
			$remove_path = FCPATH . $img->image;

			$img = substr($image, strpos($image, ",") + 1);

			$url = FCPATH.'uploads/unani/news/';
			$rand = $title . date('Ymd') . mt_rand(1001,9999);
			$userpath = $url . $rand .'.png';
			$path = "uploads/unani/news/".$rand.'.png';
			file_put_contents($userpath,base64_decode($img));

			$array['image'] = $path;

			unlink($remove_path);
		}

		if ( $id = $this->Common->update('id',$id,'news',$array) ) {
			$this->session->set_flashdata('alert_type', 'success');
			$this->session->set_flashdata('alert_title', 'Success');
			$this->session->set_flashdata('alert_message', 'News updated..!');
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'News updation image..!');
		}

		redirect('unani/news');
	}

	public function edit($id)
	{
		$news = $this->Common->get_details('news',array('id' => $id));
		if ($news->num_rows() > 0) {
			$data['news'] = $news->row();
			$this->load->view('unani/news/edit',$data);
		}
		else {
			redirect('unani/news');
		}
	}

	public function delete($id)
	{
		$news = $this->Common->get_details('news',array('id' => $id))->row();
		if($this->Common->delete('news',array('id' => $id)))
		{
			$remove_path = FCPATH . $news->image;
			unlink($remove_path);

			$this->session->set_flashdata('alert_type', 'success');
			$this->session->set_flashdata('alert_title', 'Success');
			$this->session->set_flashdata('alert_message', 'News deleted successfully..!');
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to remove news..!');
		}

		redirect('unani/news');
	}

}
?>
