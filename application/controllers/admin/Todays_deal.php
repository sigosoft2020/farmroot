<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todays_deal extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_deal','deal');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{    
		$offers  = $this->deal->get_deals();
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
		$this->load->view('admin/todays_deal/view',$data);
	}
	
	public function addData()
	{
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');
        
		$type        = $this->security->xss_clean($this->input->post('type'));
        $data        = $this->security->xss_clean($this->input->post('data'));
        $percentage  = $this->security->xss_clean($this->input->post('percentage'));
        $date        = $this->security->xss_clean($this->input->post('date_from'));
        $time_fr     = $this->security->xss_clean($this->input->post('time_from'));
        $time_t      = $this->security->xss_clean($this->input->post('time_to'));
        $time_from   = date('H:i:s',strtotime($time_fr));
        $time_to     = date('H:i:s',strtotime($time_t));
        
        $offer_check = $this->Common->get_details('todays_deal',array('type'=>$type,'item_id'=>$data,'deal_date'=>$date));
        if($offer_check->num_rows()>0)
        { 
        	$deal_id = $offer_check->row()->deal_id;
            $array = [
						'percentage'   => $percentage,
						'start_time'   => $time_fr,
						'end_time'     => $time_t,
						'time_from'    => $time_from,
						'time_to'      => $time_to,
						'deal_date'    => $date,
						'timestamp'    => $timestamp
		        ];
		  if ($this->Common->update('deal_id',$deal_id,'todays_deal',$array)) 
			{
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Deal updated..!');

				redirect('admin/todays_deal');
			}
		  else
			{
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add deal..!');

				redirect('admin/todays_deal');
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
						'deal_date'    => $date,
						'start_time'   => $time_fr,
						'end_time'     => $time_t,
						'status'       =>'Active',
						'timestamp'    => $timestamp
		        ];
			if ($this->Common->insert('todays_deal',$array)) 
			  {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'New deal added..!');

				redirect('admin/todays_deal');
			  }
			else 
			  {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add deal..!');

				redirect('admin/todays_deal');
			  }
        }
		
	}

	public function getDealById()
	{
		$id   = $_POST['id'];
		$data = $this->Common->get_details('todays_deal',array('deal_id' => $id))->row();
		print_r(json_encode($data));
	}

	public function Update()
	{
		$deal_id     = $this->security->xss_clean($this->input->post('deal_id'));
		$percentage  = $this->security->xss_clean($this->input->post('percentage'));
        $date        = $this->security->xss_clean($this->input->post('date_from'));
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
						'deal_date'    => $date,
						'start_time'   => $time_fr,
						'end_time'     => $time_t
					];
		
			if ($this->Common->update('deal_id',$deal_id,'todays_deal',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/todays_deal');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to edit deal..!');

				redirect('admin/todays_deal');
			}
	    }
	}

	public function disable($id)
	{
			$array = [
				       'status' => 'Blocked'
			         ];
		
			if ($this->Common->update('deal_id',$id,'todays_deal',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Deal blocked successfully..!');

				redirect('admin/todays_deal');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to block deal..!');

				redirect('admin/todays_deal');
			}
	}

	public function enable($id)
	{
			$array = [
				       'status' => 'Active'
			         ];
		
			if ($this->Common->update('deal_id',$id,'todays_deal',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Deal activated successfully..!');

				redirect('admin/todays_deal');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to activate deal..!');

				redirect('admin/todays_deal');
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
