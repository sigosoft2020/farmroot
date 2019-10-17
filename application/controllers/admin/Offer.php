<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offer extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_offer','offer');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{    
		$offers  = $this->offer->get_offers();
		foreach($offers as $offer)
		{
		  if($offer->type=='Product')
		  {
		  	$offer->data = $this->Common->get_details('products',array('ProductID' => $offer->item_id))->row()->ProductName;
		  }
		  elseif($offer->type=='Category')
		  {
		  	$offer->data = $this->Common->get_details('category',array('Category_Id' =>$offer->item_id))->row()->Category_Title;
		  }
		  elseif($offer->type=='Subcategory')
		  {
		  	$offer->data = $this->Common->get_details('subcategory',array('subcategory_id' =>$offer->item_id))->row()->subcategory_title;
		  }
		  else
		  {
		  	$offer->data = $this->Common->get_details('brands',array('BrandID' =>$offer->item_id))->row()->BrandName;
		  }
		}
		$data['offers']  = $offers;
		$this->load->view('admin/offer/view',$data);
	}
	
	public function addData()
	{
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');
        
		$type        = $this->security->xss_clean($this->input->post('type'));
        $data        = $this->security->xss_clean($this->input->post('data'));
        $percentage  = $this->security->xss_clean($this->input->post('percentage'));
        $date_from   = $this->security->xss_clean($this->input->post('date_from'));
        $date_to     = $this->security->xss_clean($this->input->post('date_to'));
        $time_fr     = $this->security->xss_clean($this->input->post('time_from'));
        $time_t      = $this->security->xss_clean($this->input->post('time_to'));
        $time_from   = date('H:i:s',strtotime($time_fr));
        $time_to     = date('H:i:s',strtotime($time_t));
        
        $offer_check = $this->Common->get_details('offer',array('type'=>$type,'item_id'=>$data));
        if($offer_check->num_rows()>0)
        { 
        	$offer_id = $offer_check->row()->offer_id;
            $array = [
						'percentage'   => $percentage,
						'start_time'   => $time_fr,
						'end_time'     => $time_t,
						'time_from'    => $time_from,
						'time_to'      => $time_to,
						'date_from'    => $date_from,
						'date_to'      => $date_to,
						'timestamp'    => $timestamp
		        ];
		  if ($this->Common->update('offer_id',$offer_id,'offer',$array)) 
			{
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Offer updated..!');

				redirect('admin/offer');
			}
		  else
			{
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add offer..!');

				redirect('admin/offer');
		    }
        }
        else
        {
        	 $array = [
        	 	        'type'         => $type,
        	 	        'item_id'      => $data,
						'percentage'   => $percentage,
						'time_from'    => $time_from,
						'time_to'      => $time_to,
						'date_from'    => $date_from,
						'start_time'   => $time_fr,
						'end_time'     => $time_t,
						'date_to'      => $date_to,
						'status'       =>'Active',
						'timestamp'    => $timestamp
		        ];
			if ($this->Common->insert('offer',$array)) 
			  {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'New offer added..!');

				redirect('admin/offer');
			  }
			else 
			  {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add offer..!');

				redirect('admin/offer');
			  }
        }
		
	}

	public function getOfferById()
	{
		$id   = $_POST['id'];
		$data = $this->Common->get_details('offer',array('offer_id' => $id))->row();
		print_r(json_encode($data));
	}

	public function Update()
	{
		$offer_id    = $this->security->xss_clean($this->input->post('offer_id'));
		$percentage  = $this->security->xss_clean($this->input->post('percentage'));
        $date_from   = $this->security->xss_clean($this->input->post('date_from'));
        $date_to     = $this->security->xss_clean($this->input->post('date_to'));
        $time_fr     = $this->security->xss_clean($this->input->post('time_from'));
        $time_t      = $this->security->xss_clean($this->input->post('time_to'));
        $time_from   = date('H:i:s',strtotime($time_fr));
        $time_to     = date('H:i:s',strtotime($time_t));
        $time        = date("H:i:s",strtotime($time_from));
		$timeto      = date("H:i:s",strtotime($time_to));

		{
			$array = [
						'percentage'   => $percentage,
						'time_from'    => $time_from,
						'time_to'      => $time_to,
						'date_from'    => $date_from,
						'start_time'   => $time_fr,
						'end_time'     => $time_t,
						'date_to'      => $date_to,
					];
		
			if ($this->Common->update('offer_id',$offer_id,'offer',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/offer');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to edit offer..!');

				redirect('admin/offer');
			}
	    }
	}

	public function disable($id)
	{
			$array = [
				       'status' => 'Blocked'
			         ];
		
			if ($this->Common->update('offer_id',$id,'offer',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Vendor blocked successfully..!');

				redirect('admin/offer');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to block offer..!');

				redirect('admin/offer');
			}
	}

	public function enable($id)
	{
			$array = [
				       'status' => 'Active'
			         ];
		
			if ($this->Common->update('offer_id',$id,'offer',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'offer activated successfully..!');

				redirect('admin/offer');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to activate offer..!');

				redirect('admin/offer');
			}
	}

	public function getData()
	{
		$id = $_POST['cat_id'];
          
        if($id =='Product')
        {
        	$array = $this->Common->get_details('products',array('ProductStatus' => 'Active'))->result();
			$string = '';
			foreach ($array as $list) {
				$string = $string . "<option value='".$list->ProductID."'>".$list->ProductName."</option>";
			}
			print_r(json_encode($string));
			
		}
		elseif($id=='Category'){
			$array = $this->Common->get_details('category',array('Cstatus' =>'Active'))->result();
			$string = '';
			foreach ($array as $list) {
				$string = $string . "<option value='".$list->Category_Id."'>".$list->Category_Title."</option>";
			}
			print_r(json_encode($string));
		}
		elseif($id=='Subcategory'){
			$array = $this->Common->get_details('subcategory',array('Status' =>'Active'))->result();
			$string = '';
			foreach ($array as $list) {
				$string = $string . "<option value='".$list->subcategory_id."'>".$list->subcategory_title."</option>";
			}
			print_r(json_encode($string));
		}
		else{
			$array = $this->Common->get_details('brands',array('BStatus' =>'Active'))->result();
			$string = '';
			foreach ($array as $list) {
				$string = $string . "<option value='".$list->BrandID."'>".$list->BrandName."</option>";
			}
			print_r(json_encode($string));
		}		
	}
}
?>
