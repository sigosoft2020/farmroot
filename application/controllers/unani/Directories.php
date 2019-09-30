<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Directories extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('Common');
			$this->load->model('unani/M_directories','directory');
			// if (!unani()) {
			// 	redirect('app');
			// }
	}
	public function index()
	{
		$this->load->view('unani/directories/view');
	}
	public function get()
	{
		$result = $this->directory->make_datatables();
		$data = array();
		foreach ($result as $res) {
			if ($res->block == '0') {
				$status = "Active";
			}
			else {
				$status = "Blocked";
			}
			$sub_array = array();
			$sub_array[] = '<img src="' . base_url() . $res->image . '" width="100px" height="100px">';
			$sub_array[] = $res->name;
			$sub_array[] = $res->designation;
			$sub_array[] = $res->mobile;
			$sub_array[] = $res->email;
			$sub_array[] = $res->description;
			$sub_array[] = $status;
			$sub_array[] = '<a class="btn btn-link" style="font-size:24px;" href="' . site_url('unani/directories/edit/'.$res->id) . '"><i class="fa fa-pencil-square-o"></i></a>';

			$data[] = $sub_array;
		}

		$output = array(
			"draw"   => intval($_POST['draw']),
			"recordsTotal" => $this->directory->get_all_data(),
			"recordsFiltered" => $this->directory->get_filtered_data(),
			"data" => $data
		);
		echo json_encode($output);
	}
	public function add()
	{
		$this->load->view('unani/directories/add');
	}

	public function edit($id)
	{
		$check = $this->Common->get_details('yunani_directory',array('id' => $id));
		if ($check->num_rows() > 0) {
			$data['user'] = $check->row();
			$this->load->view('unani/directories/edit',$data);
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to load directory..!');

			redirect('unani/directories');
		}
	}

	public function addDirectory()
	{
		$name = $this->security->xss_clean($this->input->post('name'));
		$email = $this->security->xss_clean($this->input->post('email'));
		$mobile = $this->security->xss_clean($this->input->post('mobile'));
		$designation = $this->security->xss_clean($this->input->post('designation'));
		$description = $this->security->xss_clean($this->input->post('description'));

		$image = $this->input->post('image');
		if ($image != '') {
			$img = substr($image, strpos($image, ",") + 1);

			$url = FCPATH.'uploads/unani/directory/';
			$rand = $username . date('Ymd').mt_rand(1001,9999);
			$userpath = $url.$rand.'.png';
			$path = "uploads/unani/directory/".$rand.'.png';
			file_put_contents($userpath,base64_decode($img));
		}
		else {
			$path = "uploads/profile/user.png";
		}

		$array = [
			'name' => $name,
			'designation' => $designation,
			'email' => $email,
			'mobile' => $mobile,
			'description' => $description,
			'image' => $path
		];

		if ($this->Common->insert('yunani_directory',$array)) {
			$this->session->set_flashdata('alert_type', 'success');
			$this->session->set_flashdata('alert_title', 'Success');
			$this->session->set_flashdata('alert_message', 'New directory added successfully..!');

			redirect('unani/directories');
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add directory..!');

			redirect('unani/directories/add');
		}
	}

	public function editdirectory()
	{
		$id = $this->security->xss_clean($this->input->post('id'));

		$name = $this->security->xss_clean($this->input->post('name'));
		$email = $this->security->xss_clean($this->input->post('email'));
		$mobile = $this->security->xss_clean($this->input->post('mobile'));
		$designation = $this->security->xss_clean($this->input->post('designation'));
		$description = $this->security->xss_clean($this->input->post('description'));
		$status = $this->security->xss_clean($this->input->post('status'));

		$image = $this->input->post('image');
		if ($image != '') {

			$img = substr($image, strpos($image, ",") + 1);

			$url = FCPATH.'uploads/unani/directory/';
			$rand = $username . date('Ymd').mt_rand(1001,9999);
			$userpath = $url.$rand.'.png';
			$path = "uploads/unani/directory/".$rand.'.png';
			file_put_contents($userpath,base64_decode($img));

			// Remove file from the server

			$user = $this->Common->get_details('yunani_directory',array('id' => $id))->row();
			$cr_image = "uploads/unani/directory/user.png";
			if ($cr_image != $user->image) {
				$remove_path = FCPATH . $user->image;
				unlink($remove_path);
			}

			$array = [
				'name' => $name,
				'designation' => $designation,
				'email' => $email,
				'mobile' => $mobile,
				'description' => $description,
				'image' => $path,
				'block' => $status
			];

		}
		else {
			$array = [
				'name' => $name,
				'designation' => $designation,
				'email' => $email,
				'mobile' => $mobile,
				'description' => $description,
				'block' => $status
			];
		}

		if ($this->Common->update('id',$id,'yunani_directory',$array)) {
			$this->session->set_flashdata('alert_type', 'success');
			$this->session->set_flashdata('alert_title', 'Success');
			$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

			redirect('unani/directories');
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to update directory..!');

			redirect('unani/directories/edit/'.$id);
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

	function getKey() {
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
