<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_brand','brand');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{
		$this->load->view('admin/brands/view');
	}
	public function get()
	{
		$result = $this->brand->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->BrandName;
			$sub_array[] = '<img src="' . base_url() . $res->BrandImage . '" height="100px">';
			$sub_array[] = $res->BStatus;
			$sub_array[] = '<a class="btn btn-link" style="font-size:16px;color:blue" href="' . site_url('admin/brands/edit/'.$res->BrandID) . '"><i class="fa fa-pencil"></i></a>';
			$data[] = $sub_array;
		}

		$output = array(
			"draw"   => intval($_POST['draw']),
			"recordsTotal" => $this->brand->get_all_data(),
			"recordsFiltered" => $this->brand->get_filtered_data(),
			"data" => $data
		);
		echo json_encode($output);
	}

	public function add()
	{
		$this->load->view('admin/brands/add');
	}
	public function edit($id)
	{
		$check = $this->Common->get_details('brands',array('BrandID' => $id));
		if ($check->num_rows() > 0) {
			$data['brand'] = $check->row();
			$this->load->view('admin/brands/edit',$data);
		}
		else {
			redirect('brands');
		}
	}
	public function addBrand()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');

		$brand    = $this->security->xss_clean($this->input->post('name'));
		$image    = $this->input->post('image');
		$img      = substr($image, strpos($image, ",") + 1);

		$cat_check = $this->Common->get_details('brands',array('BrandName'=>$brand));
		if($cat_check->num_rows()==0)
        {
        	$url      = FCPATH.'uploads/admin/brands/';
			$rand     = $brand.date('Ymd').mt_rand(1001,9999);
			$userpath = $url.$rand.'.png';
			$path     = "uploads/admin/brands/".$rand.'.png';
			file_put_contents($userpath,base64_decode($img));

			$array = [
						'BrandName'       => $brand,
						'BrandImage'      => $path,
						'BStatus'         => 'Active',
						'Timestamp'       => $timestamp
					];
			if ($this->Common->insert('brands',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'New brand added..!');

				redirect('admin/brands');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add brand..!');

				redirect('admin/brands/add');
			}		
        }
        else
        {
    	  $this->session->set_flashdata('alert_type', 'error');
		  $this->session->set_flashdata('alert_title', 'Failed');
		  $this->session->set_flashdata('alert_message', 'Brand already exists..!');
          redirect('admin/brands');
        }			
	}
	public function update()
	{
		$brand_id    = $this->input->post('brand_id');
		$brand       = $this->security->xss_clean($this->input->post('name'));
		$status      = $this->security->xss_clean($this->input->post('status'));
		$check       = $this->Common->get_details('brands',array('BrandName' => $brand , 'BrandID!=' => $brand_id))->num_rows();
		if ($check > 0) {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add brand..!');

			redirect('admin/brands/edit/'.$brand_id);
		}
		else {
			// Adding base64 file to server
			$image  = $this->input->post('image');
			$status = $this->input->post('status');
			if ($image != '') {
				$img = substr($image, strpos($image, ",") + 1);

				$url      = FCPATH.'uploads/admin/brands/';
				$rand     = $category.date('Ymd').mt_rand(1001,9999);
				$userpath = $url.$rand.'.png';
				$path     = "uploads/admin/brands/".$rand.'.png';
				file_put_contents($userpath,base64_decode($img));

				// Remove old image from the server
				$old = $this->Common->get_details('brands',array('BrandID' => $brand_id))->row()->BrandImage;
				$remove_path = FCPATH . $old;
				unlink($remove_path);

				$array = [
					'BrandName'   => $brand,
					'BrandImage'  => $path,
					'BStatus'     => $status
				];
			}
			else {
				$array = [
					'BrandName'   => $brand,
					'BStatus'     => $status
				];
			}

			if ($this->Common->update('BrandID',$brand_id,'brands',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/brands');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to update brand..!');

				redirect('admin/brands/edit/'.$category_id);
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
