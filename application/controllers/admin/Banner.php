<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_banners','banner');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{
		$this->load->view('admin/banners/view');
	}
	public function get()
	{
		$result = $this->banner->make_datatables();
		$data = array();
		foreach ($result as $res) {
			$sub_array = array();
			$sub_array[] = '<img src="' . base_url() . $res->OfferImage . '" height="100px">';
			$sub_array[] = '<a class="btn btn-link" style="font-size:24px;color:red" href="' . site_url('admin/banner/delete/'.$res->OfferImageID) . '" onclick="return del()"><i class="fa fa-trash"></i></a>';

			$data[] = $sub_array;
		}

		$output = array(
			"draw"   => intval($_POST['draw']),
			"recordsTotal" => $this->banner->get_all_data(),
			"recordsFiltered" => $this->banner->get_filtered_data(),
			"data" => $data
		);
		echo json_encode($output);
	}
	public function add()
	{
		$this->load->view('admin/banners/add');
	}
	
	public function addBanner()
	{
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');
        
		$type      = $this->security->xss_clean($this->input->post('slt'));
        $data      = $this->security->xss_clean($this->input->post('data'));
        $position  = $this->security->xss_clean($this->input->post('position'));
		if($type=='0')
		{
		    $selt = "category";
		}
		else
		{
		   $selt = "product"; 
		}

		$image     = $this->input->post('image');
		$img       = substr($image, strpos($image, ",") + 1);

		$url      = FCPATH.'uploads/admin/offer_image/';
		$rand     = $banner.date('Ymd').mt_rand(1001,9999);
		$userpath = $url.$rand.'.png';
		$path     = "uploads/admin/offer_image/".$rand.'.png';
		file_put_contents($userpath,base64_decode($img));

		$array = [
					'item'       => $selt,
					'OfferImage' => $path,
					'item_id'    => $data,
					'position'   => $position,
					'Timestamp'  => $timestamp
		        ];
		if ($this->Common->insert('offer_image',$array)) {
			$this->session->set_flashdata('alert_type', 'success');
			$this->session->set_flashdata('alert_title', 'Success');
			$this->session->set_flashdata('alert_message', 'New banner added..!');

			redirect('admin/banner');
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add banner..!');

			redirect('admin/banner/add');
		}
	}
	
	public function delete($banner_id)
	{
		$check = $this->Common->get_details('offer_image',array('OfferImageID' => $banner_id));
		if ($check->num_rows() > 0) {
			$banner = $check->row();
			if ($this->Common->delete('offer_image',array('OfferImageID' => $banner_id))) {
				
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Banner deleted successfully..!');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to remove banner..!');
			}
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to remove banner..!');
		}
		redirect('admin/banner');
	}

	public function getData()
	{
		$id = $_POST['cat_id'];
          
        if($id =='0')
        {
			$array = $this->Common->get_details('category',array('Cstatus' =>'Active'))->result();
			$string = '';
			foreach ($array as $list) {
				$string = $string . "<option value='".$list->category_id."'>".$list->category_name."</option>";
			}
			print_r(json_encode($string));
		}
		else
		{
			$array = $this->Common->get_details('products',array('status' => 'Active'))->result();
			$string = '';
			foreach ($array as $list) {
				$string = $string . "<option value='".$list->product_id."'>".$list->product_name."</option>";
			}
			print_r(json_encode($string));
		}	
	}
}
?>
