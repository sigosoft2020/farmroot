<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_task','task');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{   
		$data['staffs'] = $this->Common->get_details('staff',array('status'=>'Active'))->result();
		$this->load->view('admin/task/view',$data);
	}
	public function get()
	{
		$result = $this->task->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->OrderNO;
			$sub_array[] = $res->InvoiceNO;
			$sub_array[] = $res->BillingDet_Name;
			$sub_array[] = $res->BillingDet_Address;
			$sub_array[] = $res->BillingDet_Land;
			$sub_array[] = $res->BillingDet_City;
			$sub_array[] = $res->BillingDet_Phone;
			$sub_array[] = $res->delivery_date;
			$sub_array[] = $res->type_of_sale;
			if($res->staff_status=='0')
			{
				$action = '<button type="button" class="btn btn-danger" style="font-size:12px;color:blue">Assigned</button>';
			}
            elseif($res->staff_status=='1')
			{
				$action = '<button type="button" class="btn btn-success" style="font-size:12px;color:blue">Delivered</button>';
			}
			else
		    {
		    	$action = '<button type="button" class="btn btn-primary" style="font-size:12px;color:blue" onclick="edit(' . $res->OrderID . ',' . $res->BillingDet_UserId . ')">Assign</button>';
		    }		
			$sub_array[] = $action;

		   $assign_check = $this->Common->get_details('tasks',array('order_id'=>$res->OrderID));
		   if($assign_check->num_rows()>0)
		   {
		   	 $staff          = $assign_check->row()->staff_id;
		   	 $assigned_staff = $this->Common->get_details('staff',array('staff_id'=>$staff))->row()->name;
		   	 $assigned_date  = $assign_check->row()->assigned_date;
		   }
		   else
		   {
		   	 $assigned_staff = '';
		   	 $assigned_date  = '';
		   }
           
           $sub_array[] = $assigned_staff;
           $sub_array[] = $assigned_date;

		   $data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->task->get_all_data(),
						"recordsFiltered" => $this->task->get_filtered_data(),
						"data"            => $data
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
	public function assign_task()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp   = date('Y-m-d H:i:s');

		$staff       = $this->security->xss_clean($this->input->post('staff'));
		$notes       = $this->security->xss_clean($this->input->post('notes'));
		$start_date  = $this->security->xss_clean($this->input->post('start_date'));
		$end_date    = $this->security->xss_clean($this->input->post('end_date'));
		$time        = $this->security->xss_clean($this->input->post('time'));
		$assigned_time = date("H:i:s",strtotime($time));
		$order_id    = $this->security->xss_clean($this->input->post('order_id'));
		$user_id     = $this->security->xss_clean($this->input->post('user_id'));
		$assigned_date = date('Y-m-d');
		$type        = "Permanent";
        $priority    = "Low";
        $stat        = "Pending";
		
		$task_check = $this->Common->get_details('tasks',array('staff_id'=>$staff,'order_id'=>$order_id));
		if($task_check->num_rows()==0)
        {
			$array = [
						'staff_id'         => $staff,
						'order_id'         => $order_id,
						'task_start_date'  => $start_date,
						'task_end_date'    => $end_date,
						'admin_notes'      => $notes, 
						'task_type'        => $type,
						'priority'         => $priority,
						'customer_id'      => $user_id,
						'assigned_date'    => $assigned_date,
						'assigned_time'    => $assigned_time,
						'flag'             => '1',
						'task_status'      => $stat
					];
			if ($this->Common->insert('tasks',$array)) {
                 $array2 = [
                 	         'assigned_staff_id' => $staff,
                 	         'staff_status'      => '0',
                 	         'assigned_date'     => $assigned_date,
                 	         'assigned_time'     => $assigned_time
                           ];
                $this->Common->update('OrderID',$order_id,'app_orders',$array2);

                $array3 = [
                	        'staff_id' => $staff
                          ];
                $this->Common->update('OrderID',$order_id,'app_order_items',$array3);

				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Task assigned successfully..!');

				redirect('admin/task');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to assign task..!');

				redirect('admin/task');
			}		
        }
        else
        {
    	  $this->session->set_flashdata('alert_type', 'error');
		  $this->session->set_flashdata('alert_title', 'Failed');
		  $this->session->set_flashdata('alert_message', 'Task already assigned..!');
          redirect('admin/task');
        }			
	}

	
}
?>
