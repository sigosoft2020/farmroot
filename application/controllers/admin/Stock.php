<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_stock','stock');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{   
		$this->load->view('admin/stock/view');
	}
	public function get()
	{
		$result = $this->stock->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->ProductName;
            $sub_array[] = $res->BrandName;
            $sub_array[] = $res->Category_Title;
            $sub_array[] = $res->ProductStock;
            $stock  = $res->ProductStock;
            if($res->offer_price!='0')
            {
            	$rate   = $res->offer_price;
            	// /$total  = $rate*$stock;
            }
            else
            {
            	$rate   = $res->ProductMRP;   
            	// $total  = $rate*$stock;         	// $total  = $rate*$res->ProductStock;
            }
            $sub_array[] = $rate;
            $sub_array[] = $res->manufacturing_date;
            $sub_array[] = $res->expiry_date;
            $sub_array[] = $res->batch_number;
            // $sub_array[] = $total;
			$sub_array[] = '<button type="button" class="btn btn-link" style="font-size:20px;color:green" onclick="add(' . $res->ProductID . ',' . $res->ProductStock . ')"><i class="fa fa-plus"></i></button>';
			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->stock->get_all_data(),
						"recordsFiltered" => $this->stock->get_filtered_data(),
						"data"            => $data
					  );
		echo json_encode($output);
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
	public function addStock()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');

		$product_id       = $this->security->xss_clean($this->input->post('product_id'));
		$current_stock    = $this->security->xss_clean($this->input->post('current_stock'));
		$new_stock        = $this->security->xss_clean($this->input->post('new_stock'));
		$stock            = $current_stock+$new_stock;
		
    	  $array = [
						'ProductStock'       => $stock 
					];
			if ($this->Common->update('ProductID',$product_id,'products',$array)) 
			{   
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Stock added successfully..!');

				redirect('admin/stock');
			}
			else 
			{
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add stock..!');

				redirect('admin/stock');
			}					
	}

	public function history()
	{  
		$data['vendors'] = $this->Common->get_details('vendor_details',array('status'=>'Active'))->result();
		$this->load->view('admin/stock/history',$data);
	}

	public function view()
	{
      $this->load->view('admin/stock/view');
	}

	public function get_stock()
	{   
        $vendor_id  = $this->security->xss_clean($this->input->post('vendor_id'));
        $data['vendor'] = $this->Common->get_details('vendor_details',array('vender_id'=>$vendor_id))->row()->vendor_name;
        $history    = $this->Common->get_details('stock_history',array('history_vendor_id'=>$vendor_id))->result();
        foreach($history as $his)
         {  
         	$product_check = $this->Common->get_details('products',array('product_id'=>$his->product_id));
         	if($product_check->num_rows()>0)
         	{
         		$his->product = $product_check->row()->product_name;
         	}
         	else
         	{
         		$his->product = '';
         	}        		
       	}	
        $data['history'] =  $history;
        $this->load->view('admin/stock/history_view',$data);
	}

	
	public function getCategoryById()
	{
		$id = $_POST['id'];
		$data = $this->Common->get_details('category',array('category_id' => $id))->row();
		print_r(json_encode($data));
	}
}
?>
