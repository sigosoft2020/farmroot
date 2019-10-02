<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategory extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_subcategory','subcategory');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{   
		$this->load->view('admin/subcategory/view');
	}
	public function get()
	{
		$result = $this->subcategory->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->subcategory_title;
			$sub_array[] = $res->Category_Title;
			$sub_array[] = '<img src="' . base_url() . $res->subcategory_image . '" height="100px">';
			$sub_array[] = $res->Status;
			$sub_array[] = '<a class="btn btn-link" style="font-size:16px;color:blue" href="' . site_url('admin/subcategory/edit/'.$res->subcategory_id) . '"><i class="fa fa-pencil"></i></a>';
			$data[] = $sub_array;
		}

		$output = array(
			"draw"   => intval($_POST['draw']),
			"recordsTotal" => $this->subcategory->get_all_data(),
			"recordsFiltered" => $this->subcategory->get_filtered_data(),
			"data" => $data
		);
		echo json_encode($output);
	}

	public function add()
	{   
		$data['category'] = $this->Common->get_details('category',array('CStatus'=>'Active'))->result();
		$this->load->view('admin/subcategory/add',$data);
	}
	public function edit($id)
	{
		$check = $this->Common->get_details('subcategory',array('subcategory_id' => $id));
		if ($check->num_rows() > 0) {
			$data['subcategory'] = $check->row();
			$data['category'] = $this->Common->get_details('category',array('CStatus'=>'Active'))->result();
			$this->load->view('admin/subcategory/edit',$data);
		}
		else {
			redirect('category');
		}
	}
	public function addData()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');

		$category    = $this->security->xss_clean($this->input->post('category'));
		$subcategory = $this->security->xss_clean($this->input->post('name'));
		$image       = $this->input->post('image');
		$img         = substr($image, strpos($image, ",") + 1);

		$sub_check = $this->Common->get_details('subcategory',array('subcategory_title'=>$subcategory,'category_id'=>$category));
		if($sub_check->num_rows()==0)
        {
        	$url      = FCPATH.'uploads/admin/subcategory/';
			$rand     = $subcategory.date('Ymd').mt_rand(1001,9999);
			$userpath = $url.$rand.'.png';
			$path     = "uploads/admin/subcategory/".$rand.'.png';
			file_put_contents($userpath,base64_decode($img));

			$array = [
						'subcategory_title'  => $subcategory,
						'subcategory_image'  => $path,
						'category_id'        => $category,
						'Status'             => 'Active',
						'Timestamp'          => $timestamp
					];
			if ($this->Common->insert('subcategory',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'New Subcategory added..!');

				redirect('admin/subcategory');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add Subcategory..!');

				redirect('admin/subcategory/add');
			}		
        }
        else
        {
    	  $this->session->set_flashdata('alert_type', 'error');
		  $this->session->set_flashdata('alert_title', 'Failed');
		  $this->session->set_flashdata('alert_message', 'Subcategory already exists..!');
          redirect('admin/subcategory');
        }	
		
	}
	public function update()
	{
		$subcategory_id = $this->input->post('subcategory_id');
		$category       = $this->security->xss_clean($this->input->post('category'));
		$subcategory    = $this->security->xss_clean($this->input->post('name'));
		$status         = $this->security->xss_clean($this->input->post('status'));
		$check          = $this->Common->get_details('subcategory',array('subcategory_title' => $subcategory ,'category_id'=>$category, 'subcategory_id!=' => $subcategory_id))->num_rows();
		if ($check > 0) {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add subcategory..!');

			redirect('admin/subcategory/edit/'.$subcategory_id);
		}
		else {
			// Adding base64 file to server
			$image  = $this->input->post('image');
			$status = $this->input->post('status');
			if ($image != '') {
				$img = substr($image, strpos($image, ",") + 1);

				$url      = FCPATH.'uploads/admin/subcategory/';
				$rand     = $category.date('Ymd').mt_rand(1001,9999);
				$userpath = $url.$rand.'.png';
				$path     = "uploads/admin/subcategory/".$rand.'.png';
				file_put_contents($userpath,base64_decode($img));

				// Remove old image from the server
				$old = $this->Common->get_details('subcategory',array('subcategory_id' => $subcategory_id))->row()->subcategory_image;
				$remove_path = FCPATH . $old;
				unlink($remove_path);

				$array = [
					'subcategory_title'  => $subcategory,
					'subcategory_image'  => $path,
					'category_id'        => $category,
					'Status'             => $status
				];
			}
			else {
				$array = [
					'subcategory_title'  => $subcategory,
					'category_id'        => $category,
					'Status'             => $status
				];
			}

			if ($this->Common->update('subcategory_id',$subcategory_id,'subcategory',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/subcategory');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to update category..!');

				redirect('admin/subcategory/edit/'.$subcategory_id);
			}
		}
	}
	
	public function getCategoryById()
	{
		$id = $_POST['id'];
		$data = $this->Common->get_details('category',array('category_id' => $id))->row();
		print_r(json_encode($data));
	}
}
?>
