<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_voucher','voucher');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{
		$this->load->view('admin/voucher/view');
	}
	public function get()
	{
		$result = $this->voucher->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = $res->voucher_name;
			$sub_array[] = $res->voucher_code;
			$sub_array[] = $res->amount;
			$sub_array[] = $res->valid_from;
			$sub_array[] = $res->valid_to;
			$sub_array[] = $res->time;
			$sub_array[] = $res->time_to;
			$sub_array[] = $res->minimum_cart_value;
			$sub_array[] = '<button type="button" class="btn btn-link" style="font-size:20px;color:blue" onclick="edit(' . $res->voucher_id . ')"><i class="fa fa-pencil"></i></button>';
            $sub_array[] = '<a class="btn btn-link" style="font-size:24px;color:red" href="' . site_url('admin/voucher/delete/'.$res->voucher_id) . '" onclick="return del()"><i class="fa fa-trash"></i></a>';

			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->voucher->get_all_data(),
						"recordsFiltered" => $this->voucher->get_filtered_data(),
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
	public function addVoucher()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');

		$voucher_name = $this->security->xss_clean($this->input->post('voucher_name'));
        $code         = $this->security->xss_clean($this->input->post('code'));
        $amount       = $this->security->xss_clean($this->input->post('amount'));
        $date_from    = $this->security->xss_clean($this->input->post('date_from'));
        $end_date     = $this->security->xss_clean($this->input->post('end_date'));
        $time_from    = $this->security->xss_clean($this->input->post('time_from'));
        $time_to      = $this->security->xss_clean($this->input->post('time_to'));
        $cart_value   = $this->security->xss_clean($this->input->post('cart_value'));

        $time   = date("H:i:s",strtotime($time_from));
		$timeto = date("H:i:s",strtotime($time_to));

		$t1=strtotime("$date_from $time_from");
		$t2=strtotime("$end_date $time_to");

			$array = [
						'voucher_name'    => $voucher_name,
						'voucher_code'    => $code,
						'amount'          => $amount,
						'valid_from'      => $date_from,
						'valid_to'        => $end_date,
						'time'            => $time,
						'time_to'         => $timeto,
						'minimum_cart_value' => $cart_value,
						'str_time_from'   => $t1,
						'str_time_to'     => $t2,
						'status'          => 'Active'
					];
			if ($this->Common->insert('voucher',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'New voucher added..!');

				redirect('admin/voucher');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add voucher..!');

				redirect('admin/voucher');
			}			
	}

	public function update()
	{
		$voucher_id   = $this->security->xss_clean($this->input->post('voucher_id'));
		$voucher_name = $this->security->xss_clean($this->input->post('voucher_name'));
        $code         = $this->security->xss_clean($this->input->post('code'));
        $amount       = $this->security->xss_clean($this->input->post('amount'));
        $date_from    = $this->security->xss_clean($this->input->post('date_from'));
        $end_date     = $this->security->xss_clean($this->input->post('end_date'));
        $time_from    = $this->security->xss_clean($this->input->post('time_from'));
        $time_to      = $this->security->xss_clean($this->input->post('time_to'));
        $cart_value   = $this->security->xss_clean($this->input->post('cart_value'));

        $time   = date("H:i:s",strtotime($time_from));
		$timeto = date("H:i:s",strtotime($time_to));

		$t1=strtotime("$date_from $time_from");
		$t2=strtotime("$end_date $time_to");
		
		{
			$array = [
						'voucher_name'    => $voucher_name,
						'amount'          => $amount,
						'valid_from'      => $date_from,
						'valid_to'        => $end_date,
						'time'            => $time,
						'time_to'         => $timeto,
						'minimum_cart_value' => $cart_value,
						'str_time_from'   => $t1,
						'str_time_to'     => $t2
					];
		
			if ($this->Common->update('voucher_id',$voucher_id,'voucher',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/voucher');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to edit voucher..!');

				redirect('admin/voucher');
			}
	    }
	}

	public function delete($id)
	{
			$array = [
				       'status' => 'Blocked'
			         ];
		
			if ($this->Common->update('voucher_id',$id,'voucher',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Voucher deleted successfully..!');

				redirect('admin/voucher');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to delete voucher..!');

				redirect('admin/voucher');
			}
	}

	
	public function getVoucherById()
	{
		$id = $_POST['id'];
		$data = $this->Common->get_details('voucher',array('voucher_id' => $id))->row();
		print_r(json_encode($data));
	}
}
?>
