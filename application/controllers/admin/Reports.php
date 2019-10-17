<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_reports','reports');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function sales()
	{   
		$sales = $this->reports->get_sales();
		foreach($sales as $sale)
		{
			$sale->fresh_total    = $this->reports->get_fresh_total($sale->OrderID);
			$sale->veg_total      = $this->reports->get_veg_total($sale->OrderID);
			$sale->veg_total      = $this->reports->get_veg_total($sale->OrderID);
			$sale->grocery_total  = $this->reports->get_grocery_total($sale->OrderID);
			$sale->fruits_total   = $this->reports->get_fruits_total($sale->OrderID);
			$sale->babyfood_total = $this->reports->get_babyfood_total($sale->OrderID);
		}
		$data['sales']  = $sales;
		$this->load->view('admin/reports/sales',$data);
	}

	public function purchase()
	{
		$purchase         = $this->reports->get_purchase();
		$data['purchase'] = $purchase;
		$this->load->view('admin/reports/purchase',$data);
	}
    
    public function view_purchase($id)
    {
    	$items = $this->Common->get_details('vendor_purchase_items',array('VpurchaseID'=>$id))->result();
    	$data['items'] = $items;
    	$this->load->view('admin/reports/view_purchase', $data);
    }
}
?>
