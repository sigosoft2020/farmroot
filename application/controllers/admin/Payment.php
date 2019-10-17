<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_payment','payment');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function app_orders()
	{    
	    $today      = date("Y-m-d"); 
	    if(isset($_POST['submit']))
	    {  
	       $date       = $this->input->post('date');	
	       $delivery_date = date('Y-m-d',strtotime($date));
	       // print_r($date);
           $app_orders = $this->payment->get_app_orders($delivery_date);
	    }
	    else
	    {
	    	$app_orders = $this->payment->get_app_orders($today);
	    }
		
		$data['app_orders']  = $app_orders;
		$this->load->view('admin/payment/app_orders',$data);
	}

	public function tele_orders()
	{    
	    $today      = date("Y-m-d"); 
	    if(isset($_POST['submit']))
	    {  
	       $date       = $this->input->post('date');	
	       $delivery_date = date('Y-m-d',strtotime($date));
	       // print_r($date);
           $tele_orders = $this->payment->get_tele_orders($delivery_date);
	    }
	    else
	    {
	    	$tele_orders = $this->payment->get_tele_orders($today);
	    }
		
		$data['tele_orders']  = $tele_orders;
		$this->load->view('admin/payment/tele_orders',$data);
	}

}
?>
