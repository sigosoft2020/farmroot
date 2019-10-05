<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/Expense_category','category');
			$this->load->model('admin/M_expense','expense');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{
		$this->load->view('admin/expense/view');
	}
	public function category()
	{
		$this->load->view('admin/expense/category');
	}
	public function get()
	{
		$result = $this->expense->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->ExpenseName;
			$sub_array[] = $res->expense_category_name;
			$sub_array[] = $res->Amount;
			$sub_array[] = $res->Description;
			$sub_array[] = $res->EDate;
			// $sub_array[] = '<a class="btn btn-link" style="font-size:20px;color:blue" href="' . site_url('admin/expense/edit/'.$res->exp_id) . '"><i class="fa fa-edit"></i></a>';
            $sub_array[]   = '<a class="btn btn-link" style="font-size:20px;color:red" href="' . site_url('admin/expense/delete/'.$res->exp_id) . '"  onclick="return del()"><i class="fa fa-trash"></i></a>';
        
			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->expense->get_all_data(),
						"recordsFiltered" => $this->expense->get_filtered_data(),
						"data"            => $data
					   );
		echo json_encode($output);
	}

	public function get_category()
	{
		$result = $this->category->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->category_name;
			$sub_array[] = $res->status;
			$sub_array[] = '<button type="button" class="btn btn-link" style="font-size:20px;color:blue" onclick="edit(' . $res->exp_id . ')"><i class="fa fa-pencil"></i></button>';

			if($res->status == 'Active') 
			{
             $action  = '<a class="btn btn-link" style="font-size:16px;color:red" href="' . site_url('admin/expense/category_disable/'.$res->exp_id) . '"  onclick="return block()">Block</i></a>';
            } 
            else
            {
             $action = '<a class="btn btn-link" style="font-size:16px;color:orange" href="' . site_url('admin/expense/category_enable/'.$res->exp_id) . '"  onclick="return block()">Enable</a>';
            }
            
            $sub_array[]    = $action; 

			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->category->get_all_data(),
						"recordsFiltered" => $this->category->get_filtered_data(),
						"data"            => $data
					   );
		echo json_encode($output);
	}


	public function add()
	{   
		$data['category'] = $this->Common->get_details('expense_category',array('status'=>'Active'))->result();
		$this->load->view('admin/expense/add',$data);
	}
	public function edit($id)
	{
		$check = $this->Common->get_details('expense_table',array('exp_id' => $id));
		if ($check->num_rows() > 0) 
		{
			$data['expense'] = $check->row();
			$this->load->view('admin/expense/edit',$data);
		}
		else
		{
			redirect('expense');
		}
	}
	public function addCategory()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');

		$category_name = $this->security->xss_clean($this->input->post('category_name'));

		$vendor_check = $this->Common->get_details('expense_category',array('category_name'=>$category_name));
		if($vendor_check->num_rows()==0)
        {
			$array = [
						'category_name'    => $category_name,
						'status'           => 'Active',
						'timestamp'        => $timestamp
					];
			if ($this->Common->insert('expense_category',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'New category added..!');

				redirect('admin/expense/category');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add category..!');

				redirect('admin/expense/category');
			}		
        }
        else
        {
    	  $this->session->set_flashdata('alert_type', 'error');
		  $this->session->set_flashdata('alert_title', 'Failed');
		  $this->session->set_flashdata('alert_message', 'Category already exists..!');
          redirect('admin/expense/category');
        }			
	}

	public function category_update()
	{
		$expense_id  = $this->input->post('expense_id');
		$category    = $this->security->xss_clean($this->input->post('category'));
		$check       = $this->Common->get_details('expense_category',array('category_name' => $category , 'exp_id!=' => $expense_id))->num_rows();
		if ($check > 0) 
		{
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add category..!');

			redirect('admin/expense/category');
		}
		else 
		{
			$array = [
				       'category_name' => $category
			         ];
		
			if ($this->Common->update('exp_id',$expense_id,'expense_category',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/expense/category');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to edit category..!');

				redirect('admin/expense/category');
			}
	    }
	}

	public function category_disable($id)
	{
			$array = [
				       'status' => 'Blocked'
			         ];
		
			if ($this->Common->update('exp_id',$id,'expense_category',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Category blocked successfully..!');

				redirect('admin/expense/category');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to block category..!');

				redirect('admin/expense/category');
			}
	}

	public function category_enable($id)
	{
			$array = [
				       'status' => 'Active'
			         ];
		
			if ($this->Common->update('exp_id',$id,'expense_category',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Category activated successfully..!');

				redirect('admin/expense/category');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to activate category..!');

				redirect('admin/expense/category');
			}
	}
    
    public function addExpense()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');

		$expense_name  = $this->security->xss_clean($this->input->post('name'));
		$category      = $this->security->xss_clean($this->input->post('category'));
		$description   = $this->security->xss_clean($this->input->post('description'));
		$amount        = $this->security->xss_clean($this->input->post('amount'));
		$exp_date      = $this->security->xss_clean($this->input->post('exp_date'));
		$expense_category  = $this->Common->get_details('expense_category',array('exp_id'=>$category))->row()->category_name;
		
		$expense_check = $this->Common->get_details('expense_table',array('ExpenseName'=>$expense_name,'expense_category_id'=>$category,'amount'=>$amount,'EDate'=>$exp_date));
		if($expense_check->num_rows()==0)
        {
			$array = [
						'ExpenseName'          => $expense_name,
						'expense_category_id'  => $category,
						'expense_category_name'=> $expense_category,
						'Amount'               => $amount,
						'Description'          => $description,
						'EDate'                => $exp_date,
						'timestamp'            => $timestamp
					];
			if ($this->Common->insert('expense_table',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'New expense added..!');

				redirect('admin/expense');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add expense..!');

				redirect('admin/expense');
			}		
        }
        else
        {
    	  $this->session->set_flashdata('alert_type', 'error');
		  $this->session->set_flashdata('alert_title', 'Failed');
		  $this->session->set_flashdata('alert_message', 'Expense already added..!');
          redirect('admin/expense');
        }			
	}

	public function delete($id)
	{
		$check = $this->Common->get_details('expense_table',array('exp_id' => $id));
		if ($check->num_rows() > 0) {
			$banner = $check->row();
			if ($this->Common->delete('expense_table',array('exp_id' => $id))) {
				
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Expense deleted successfully..!');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to remove expense..!');
			}
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to remove expense..!');
		}
		redirect('admin/expense');
	}

	public function getCategoryById()
	{
		$id = $_POST['id'];
		$data = $this->Common->get_details('expense_category',array('exp_id' => $id))->row();
		print_r(json_encode($data));
	}
}
?>
