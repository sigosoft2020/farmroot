<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/Live_orders','live');
			$this->load->model('admin/Delivered_orders','delivered');
			$this->load->model('admin/Cancelled_orders','cancelled');
			$this->load->model('admin/Bulk_orders','bulk');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{
		$this->load->view('admin/orders/live_orders');
	}
	public function get()
	{
		$result = $this->live->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->order_no;
			$sub_array[] = $res->invoice_no;
			$sub_array[] = $res->name;
			$sub_array[] = $res->email;
			$sub_array[] = $res->phone;
			$sub_array[] = $res->status;
			$sub_array[] = '<a class="btn btn-link" style="font-size:16px;color:blue" href="' . site_url('admin/orders/view/'.$res->order_id) . '" ><i class="fa fa-eye"></i></a>';
			$sub_array[] = '<button type="button" class="btn btn-link" style="font-size:20px;color:blue" onclick="updater(' . $res->order_id . ')" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></button>';
            
	
			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->live->get_all_data(),
						"recordsFiltered" => $this->live->get_filtered_data(),
						"data"            => $data
					   );
		echo json_encode($output);
	}
    
    public function delivered()
	{
		$this->load->view('admin/orders/delivered_orders');
	}
	public function get_delivered()
	{
		$result = $this->delivered->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->order_no;
			$sub_array[] = $res->invoice_no;
			$sub_array[] = $res->name;
			$sub_array[] = $res->email;
			$sub_array[] = $res->phone;
			$sub_array[] = $res->grand_total;
			$sub_array[] = $res->status;
			$sub_array[] = '<a class="btn btn-link" style="font-size:16px;color:blue" href="' . site_url('admin/orders/view/'.$res->order_id) . '" ><i class="fa fa-eye"></i></a>';
	
			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->delivered->get_all_data(),
						"recordsFiltered" => $this->delivered->get_filtered_data(),
						"data"            => $data
					   );
		echo json_encode($output);
	}

	public function cancelled()
	{
		$this->load->view('admin/orders/cancelled_orders');
	}
	public function get_cancelled()
	{
		$result = $this->cancelled->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->order_no;
			$sub_array[] = $res->invoice_no;
			$sub_array[] = $res->name;
			$sub_array[] = $res->email;
			$sub_array[] = $res->phone;
			$sub_array[] = $res->status;
			$sub_array[] = '<a class="btn btn-link" style="font-size:16px;color:blue" href="' . site_url('admin/orders/view/'.$res->order_id) . '" ><i class="fa fa-eye"></i></a>';
	
			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->cancelled->get_all_data(),
						"recordsFiltered" => $this->cancelled->get_filtered_data(),
						"data"            => $data
					   );
		echo json_encode($output);
	}

    public function bulk()
	{
		$this->load->view('admin/orders/bulk_orders');
	}
	public function get_bulk()
	{
		$result = $this->bulk->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->order_no;
			$sub_array[] = $res->invoice_no;
			$product     = $this->Common->get_details('products',array('product_id'=>$res->product_id));
			if($product->num_rows()>0)
			{
			   $product_name = $product->row()->product_name;;
			}
			else
			{
			   $product_name = '';
			}	
			
			$sub_array[] = $product_name;
			$sub_array[] = $res->qty;
			$sub_array[] = $res->price;
			$sub_array[] = $res->total;
			$sub_array[] = $res->name;
			$sub_array[] = $res->address;
			$sub_array[] = $res->email;
			$sub_array[] = $res->phone;
			$sub_array[] = $res->status;
			$sub_array[] = '<button type="button" class="btn btn-link" style="font-size:20px;color:blue" onclick="updater(' . $res->bulk_id . ')" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></button>';
	
			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->bulk->get_all_data(),
						"recordsFiltered" => $this->bulk->get_filtered_data(),
						"data"            => $data
					   );
		echo json_encode($output);
	}

	public function view($id)
	{
      $check = $this->Common->get_details('orders',array('order_id'=>$id));
      if($check->num_rows()>0)
      {
      	$order          = $check->row();
      	$order->items   = $this->Common->get_details('order_items',array('order_id'=>$id))->result();
      	foreach($order->items as $item)
      	{
      	  $product      = $this->Common->get_details('products',array('product_id'=>$item->product_id))->row();	
      	  $item->price  = $product->b2b_price;	
      	}
      	$data['order']   = $order;
      	$this->load->view('admin/orders/view_order.php',$data);
      }  
      else
      {
      	redirect('orders');
      }
	}

	public function update()
	{
		$order_id   = $this->input->post('order_id');
		$status     = $this->security->xss_clean($this->input->post('status'));
		
		if($status =='Delivered')
		{
			$array = [
				       'status' => $status
			         ];
		
			if ($this->Common->update('order_id',$order_id,'orders',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/orders/delivered');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to edit status..!');

				redirect('admin/orders');
			}
		}
		else
		{
		   $array = [
				       'status' => $status
			         ];
		
			if ($this->Common->update('order_id',$order_id,'orders',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Order cancelled  successfully..!');

				redirect('admin/orders');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to cancel order..!');

				redirect('admin/orders');
			}	
		}	
	}

	public function bulk_update()
	{
		$order_id   = $this->input->post('order_id');
		$status     = $this->security->xss_clean($this->input->post('status'));
		
			$array = [
				       'status' => $status
			         ];
		
			if ($this->Common->update('bulk_id',$order_id,'bulk_order',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/orders/bulk');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to edit status..!');

				redirect('admin/orders/bulk');
			}
		
	}

	public function disable($id)
	{
			$array = [
				       'salesman_status' => 'Blocked'
			         ];
		
			if ($this->Common->update('s_id',$id,'salesman',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Vendor blocked successfully..!');

				redirect('admin/salesman');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to block vendor..!');

				redirect('admin/salesman');
			}
	}

	public function enable($id)
	{
			$array = [
				       'salesman_status' => 'Active'
			         ];
		
			if ($this->Common->update('s_id',$id,'salesman',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Vendor activated successfully..!');

				redirect('admin/salesman');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to activate vendor..!');

				redirect('admin/salesman');
			}
	}


	public function getsalesmanById()
	{
		$id = $_POST['id'];
		$data = $this->Common->get_details('salesman',array('s_id' => $id))->row();
		print_r(json_encode($data));
	}
}
?>
