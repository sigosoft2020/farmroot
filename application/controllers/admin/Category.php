<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_category','category');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{
		$this->load->view('admin/category/view');
	}
	public function get()
	{
		$result = $this->category->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->category_name;
			$sub_array[] = '<img src="' . base_url() . $res->CategoryImage . '" height="100px">';
			$sub_array[] = $res->Cstatus;
			$sub_array[] = '<a class="btn btn-link" style="font-size:16px;color:blue" href="' . site_url('admin/category/edit/'.$res->category_id) . '"><i class="fa fa-pencil"></i></a>';
			$data[] = $sub_array;
		}

		$output = array(
			"draw"   => intval($_POST['draw']),
			"recordsTotal" => $this->category->get_all_data(),
			"recordsFiltered" => $this->category->get_filtered_data(),
			"data" => $data
		);
		echo json_encode($output);
	}

	public function add()
	{
		$this->load->view('admin/category/add');
	}
	public function edit($id)
	{
		$check = $this->Common->get_details('category',array('category_id' => $id));
		if ($check->num_rows() > 0) {
			$data['category'] = $check->row();
			$this->load->view('admin/category/edit',$data);
		}
		else {
			redirect('category');
		}
	}
	public function addCategory()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');

		$category = $this->security->xss_clean($this->input->post('name'));
		$image    = $this->input->post('image');
		$img      = substr($image, strpos($image, ",") + 1);

		$cat_check = $this->Common->get_details('category',array('category_name'=>$category));
		if($cat_check->num_rows()==0)
        {
        	$url      = FCPATH.'uploads/admin/category/';
			$rand     = $category.date('Ymd').mt_rand(1001,9999);
			$userpath = $url.$rand.'.png';
			$path     = "uploads/admin/category/".$rand.'.png';
			file_put_contents($userpath,base64_decode($img));

			$array = [
						'category_name'  => $category,
						'CategoryImage' => $path,
						'Cstatus'        => 'Active',
						'timestamp'      => $timestamp
					];
			if ($this->Common->insert('category',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'New category added..!');

				redirect('admin/category');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add category..!');

				redirect('admin/category/add');
			}		
        }
        else
        {
    	  $this->session->set_flashdata('alert_type', 'error');
		  $this->session->set_flashdata('alert_title', 'Failed');
		  $this->session->set_flashdata('alert_message', 'Category already exists..!');
          redirect('admin/category');
        }	
		
	}
	public function update()
	{
		$category_id = $this->input->post('category_id');
		$category    = $this->security->xss_clean($this->input->post('name'));
		$check       = $this->Common->get_details('category',array('category_name' => $category , 'category_id!=' => $category_id))->num_rows();
		if ($check > 0) {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add category..!');

			redirect('admin/category/edit/'.$category_id);
		}
		else {
			// Adding base64 file to server
			$image  = $this->input->post('image');
			$status = $this->input->post('status');
			if ($image != '') {
				$img = substr($image, strpos($image, ",") + 1);

				$url      = FCPATH.'uploads/admin/category/';
				$rand     = $category.date('Ymd').mt_rand(1001,9999);
				$userpath = $url.$rand.'.png';
				$path     = "uploads/admin/category/".$rand.'.png';
				file_put_contents($userpath,base64_decode($img));

				// Remove old image from the server
				$old = $this->Common->get_details('category',array('category_id' => $category_id))->row()->CategoryImage;
				$remove_path = FCPATH . $old;
				unlink($remove_path);

				$array = [
					'category_name' => $category,
					'CategoryImage' => $path,
					'Cstatus'       => $status
				];
			}
			else {
				$array = [
					'category_name' => $category,
					'Cstatus'       => $status
				];
			}

			if ($this->Common->update('category_id',$category_id,'category',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/category');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to update category..!');

				redirect('admin/category/edit/'.$category_id);
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
