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
			$this->load->model('admin/Dispatched_orders','dispatched');
			$this->load->model('admin/Returned_orders','returned');
			$this->load->model('admin/Returned_cod_orders','cod');
			$this->load->model('admin/Refunded_orders','refunded');
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
			
			$sub_array[] = $res->OrderNO;
			$sub_array[] = $res->InvoiceNO;
			$sub_array[] = $res->BillingDet_Name;
			$sub_array[] = $res->BillingDet_Email;
			$sub_array[] = $res->BillingDet_Phone;
			$sub_array[] = $res->GrandTotal;
			$sub_array[] = $res->status;
			$sub_array[] = $res->type_of_sale;
			$sub_array[] = '<a class="btn btn-link" style="font-size:16px;color:blue" href="' . site_url('admin/orders/view/'.$res->OrderID) . '" ><i class="fa fa-eye"></i></a>';
			$sub_array[] = '<button type="button" class="btn btn-link" style="font-size:20px;color:blue" onclick="updater(' . $res->OrderID . ')" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></button>';

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
			
			$sub_array[] = $res->OrderNO;
			$sub_array[] = $res->InvoiceNO;
			$sub_array[] = $res->BillingDet_Name;
			$sub_array[] = $res->BillingDet_Email;
			$sub_array[] = $res->BillingDet_Phone;
			$sub_array[] = $res->GrandTotal;
			$sub_array[] = $res->status;
			$sub_array[] = $res->type_of_sale;
			$sub_array[] = '<a class="btn btn-link" style="font-size:16px;color:blue" href="' . site_url('admin/orders/view/'.$res->OrderID) . '" ><i class="fa fa-eye"></i></a>';
	
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

	public function dispatched()
	{
		$this->load->view('admin/orders/dispatched_orders');
	}
	public function get_dispatched()
	{
		$result = $this->dispatched->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->OrderNO;
			$sub_array[] = $res->InvoiceNO;
			$sub_array[] = $res->BillingDet_Name;
			$sub_array[] = $res->BillingDet_Email;
			$sub_array[] = $res->BillingDet_Phone;
			$sub_array[] = $res->GrandTotal;
			$sub_array[] = $res->status;
			$sub_array[] = $res->type_of_sale;
			$sub_array[] = '<a class="btn btn-link" style="font-size:16px;color:blue" href="' . site_url('admin/orders/view/'.$res->OrderID) . '" ><i class="fa fa-eye"></i></a>';
	
			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->dispatched->get_all_data(),
						"recordsFiltered" => $this->dispatched->get_filtered_data(),
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
			
			$sub_array[] = $res->OrderNO;
			$sub_array[] = $res->InvoiceNO;
			$sub_array[] = $res->BillingDet_Name;
			$sub_array[] = $res->BillingDet_Email;
			$sub_array[] = $res->BillingDet_Phone;
			$sub_array[] = $res->GrandTotal;
			$sub_array[] = $res->status;
			$sub_array[] = $res->type_of_sale;
			$sub_array[] = '<a class="btn btn-link" style="font-size:16px;color:blue" href="' . site_url('admin/orders/view/'.$res->OrderID) . '" ><i class="fa fa-eye"></i></a>';
	
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

    public function returned()
	{
		$this->load->view('admin/orders/returned_orders');
	}
	public function get_returned()
	{
		$result = $this->returned->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();

			$order       = $this->Common->get_details('app_orders',array('OrderNO'=>$res->order_no))->row();
			$sub_array[] = $order->OrderNO;
			$sub_array[] = $order->InvoiceNO;
			$sub_array[] = $order->BillingDet_Name;
			$sub_array[] = $order->BillingDet_Email;
			$sub_array[] = $order->BillingDet_Phone;
			$sub_array[] = $order->GrandTotal;
			$sub_array[] = $res->refund_total;
			$sub_array[] = $res->mode_of_pay;
			$sub_array[] = $res->reason;
			$sub_array[] = $order->payment_code;
			$sub_array[] = '<a class="btn btn-link" style="font-size:16px;color:blue" href="' . site_url('admin/orders/returned_order_view/'.$res->order_no) . '" ><i class="fa fa-eye"></i></a>';
			if($order->payment_code=='null')
			{
			   $payment = '<button type="button" class="btn btn-info" style="font-size:14px;color:blue" onclick="updater(' . $res->order_no . ')" data-toggle="modal" data-target="#myModal">Update</button>';
			}
			else
			{
               $payment = '<a href="razor/refund.php?oid=<?php echo $res->order_no;?>"><input type="submit" name="update" value="Refund" class="btn btn-primary"></a>';
			}	
			$sub_array[] = $payment;
	
			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->returned->get_all_data(),
						"recordsFiltered" => $this->returned->get_filtered_data(),
						"data"            => $data
					   );
		echo json_encode($output);
	}

	public function returned_cod()
	{   
		$returned_cod  = $this->cod->get_data();
		foreach($returned_cod as $cod)
		{  
		   $bank_check =$this->Common->get_details('bank_details',array('bank_id'=>$cod->bank_id));
		   if($bank_check->num_rows()>0)
		   {
		   	  $cod->bank = $bank_check->row()->bank_name;
		   }
		   else
		   {
		   	  $cod->bank = '';
		   } 
			
		}
		$data['returned_cod'] = $returned_cod;
		$this->load->view('admin/orders/returned_cod_orders',$data);
	}
	
	public function refunded()
	{   
		$refunded  = $this->refunded->get_data();
		$data['refunded'] = $refunded;
		$this->load->view('admin/orders/refunded_orders',$data);
	}

	public function view($id)
	{
      $check = $this->Common->get_details('app_orders',array('OrderID'=>$id));
      if($check->num_rows()>0)
      {
      	$order          = $check->row();
      	$order->items   = $this->Common->get_details('app_order_items',array('OrderID'=>$id))->result();
      	$data['order']   = $order;
      	$this->load->view('admin/orders/view_order',$data);
      }  
      else
      {
      	redirect('orders');
      }
	}

	public function refunded_order_view($id)
	{
      $check = $this->Common->get_details('app_orders',array('OrderNO'=>$id));
      if($check->num_rows()>0)
      {
      	$order          = $check->row();
      	$order->items   = $this->Common->get_details('app_order_items',array('OrderID'=>$order->OrderID))->result();
      	$data['order']   = $order;
      	$this->load->view('admin/orders/view_refunded_order',$data);
      }  
      else
      {
      	redirect('orders');
      }
	}

	public function returned_order_view($id)
	{ 
	  $current = date('Y-m-d');	
      $check   = $this->Common->get_details('app_orders',array('OrderNO'=>$id));
      if($check->num_rows()>0)
      {
      	$order          = $check->row();
      	$order->items   = $this->Common->get_details('app_order_items',array('OrderID'=>$order->OrderID))->result();
      	$data['order']   = $order;
      	$this->load->view('admin/orders/view_returned_order',$data);
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
				       'status'          => $status,
				       'delivery_status' => 'enable',
				       'delivered_date'  => $date
			         ];
		
			if ($this->Common->update('OrderID',$order_id,'app_orders',$array)) 
			{   
				$array2 = [
					        'ret_status' =>$status
				          ];
				$this->Common->update('OrderID',$order_id,'app_order_items',$array2);         
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/orders/delivered');
			}
			else 
			{
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to edit status..!');

				redirect('admin/orders');
			}
		}
		elseif($status=='Cancelled')
		{
			$array = [
				       'status'          => $status,
				       'delivery_status' => 'enable',
				       'cancelled_date'  => $date
			         ];
		
			if ($this->Common->update('OrderID',$order_id,'app_orders',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Order cancelled  successfully..!');

				redirect('admin/cancelled');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to cancel order..!');

				redirect('admin/cancelled');
			}	
		}
		elseif($status =='Returned')
		{
		   $array = [
				       'status'          => $status,
				       'delivery_status' => 'enable'
			         ];
		
			if ($this->Common->update('OrderID',$order_id,'app_orders',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Order cancelled  successfully..!');

				redirect('admin/returned');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to cancel order..!');

				redirect('admin/returned');
			}	
		}
		elseif($status =='Dispatched')
		{  
		   $shipment_date=date('Y-m-d');	
		   $array = [
				       'status'          => $status,
				       'delivery_status' => 'enable',
				       'shipment_date'   => $shipment_date
			         ];
		
			if ($this->Common->update('OrderID',$order_id,'app_orders',$array)) 
			{
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
		else
		{
		   $array = [
				       'status'          => $status,
				       'delivery_status' => 'enable'
			         ];
		
			if ($this->Common->update('OrderID',$order_id,'app_orders',$array)) {
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

	public function refund_update()
	{
		$order_no   = $this->input->post('order_id');
		$status     = $this->security->xss_clean($this->input->post('status'));
		
			$array = [
				       'status' => 'Refunded'
			         ];
		
			if ($this->Common->update('OrderNO',$order_no,'app_orders',$array)) {
				$array2 = [
					        'ret_status' => 'Refunded'
				          ];
				$this->Common->update('OrderNo',$order_no,'app_order_items',$array2); 

				$array3 = [
					        'rtn_status' => 'Refunded'
				          ];
				$this->Common->update('order_no',$order_no,'returned_orders',$array3);         
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/orders/returned');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to edit status..!');

				redirect('admin/orders/bulk');
			}
		
	}

	public function invoice($id)
	{
       $check = $this->Common->get_details('app_orders',array('OrderID'=>$id));
       if($check->num_rows()>0)
       {
	      	$order          = $check->row();
	      	$order->items   = $this->Common->get_details('app_order_items',array('OrderID'=>$id))->result();
	      	$data['order']   = $order;
	      	$this->load->view('admin/orders/invoice',$data);
       }  
       else
       {
       		redirect('orders');
       }
	}

}
?>
