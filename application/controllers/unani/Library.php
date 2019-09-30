<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('unani/M_library','library');
			$this->load->model('Common');
			
	}
	public function index()
	{
		$this->load->view('unani/library/view');
	}
	public function get()
	{
		$result = $this->library->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = '<img src="' . base_url() . $res->cover . '" height="100px">';
			$sub_array[] = $res->title;
			$sub_array[] = $res->description;
			$sub_array[] = $res->status;
			$sub_array[] = '<a class="btn btn-link" style="font-size:16px;color:blue" href="' . site_url('unani/library/edit/'.$res->id) . '"><i class="fa fa-pencil"></i></a>';
			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->library->get_all_data(),
						"recordsFiltered" => $this->library->get_filtered_data(),
						"data"            => $data
					   );
		echo json_encode($output);
	}

	public function add()
	{
		$this->load->view('unani/library/add');
	}
	public function edit($id)
	{
		$check = $this->Common->get_details('yunani_library',array('id' => $id));
		if ($check->num_rows() > 0) {
			$data['library'] = $check->row();
			$this->load->view('unani/library/edit',$data);
		}
		else {
			redirect('library');
		}
	}
	public function addLibrary()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');

		$title        = $this->security->xss_clean($this->input->post('name'));
		$description  = $this->security->xss_clean($this->input->post('description'));
		$image        = $this->input->post('image');
		$img          = substr($image, strpos($image, ",") + 1);

		$check = $this->Common->get_details(' yunani_library',array('title'=>$title,'description'=>$description));
		if($check->num_rows()==0)
        {
        	$url      = FCPATH.'uploads/unani/library/images/cover/';
			$rand     = $title.date('Ymd').mt_rand(1001,9999);
			$userpath = $url.$rand.'.png';
			$path     = "uploads/unani/library/images/cover/".$rand.'.png';
			file_put_contents($userpath,base64_decode($img));

			$file     = $_FILES['full'];	       	
			$tar      = "uploads/unani/library/doc/full/";
			$rand     = $title.date('Ymd').mt_rand(1001,9999);
			$tar_file = $tar . $rand . basename($file['name']);
			move_uploaded_file($file['tmp_name'], $tar_file);

			$file1     = $_FILES['preview'];	       	
			$tar1      = "uploads/unani/library/doc/preview/";
			$rand1     = $title.date('Ymd').mt_rand(1001,9999);
			$tar_file1 = $tar1 . $rand1 . basename($file1['name']);
			move_uploaded_file($file1['tmp_name'], $tar_file1);

			$array = [
						'title'           => $title,
						'cover'           => $path,
						'full'            => $tar_file,
						'preview'         => $tar_file1,
						'description'     => $description,
						'status'          => 'Active',
						'timestamp'       => $timestamp
					];
			if ($this->Common->insert('yunani_library',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'New library added..!');

				redirect('unani/library');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add library..!');

				redirect('unani/library/add');
			}		
        }
        else
        {
    	  $this->session->set_flashdata('alert_type', 'error');
		  $this->session->set_flashdata('alert_title', 'Failed');
		  $this->session->set_flashdata('alert_message', 'Library already added..!');
          redirect('unani/library');
        }	
	}

	public function update()
	{
		$library_id = $this->input->post('library_id');
		$title        = $this->security->xss_clean($this->input->post('name'));
		$description  = $this->security->xss_clean($this->input->post('description'));

		$check          = $this->Common->get_details('yunani_library',array('title' => $title,'description'=>$description,'id!=' => $library_id))->num_rows();
		if ($check > 0) {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add library..!');

			redirect('unani/library/edit/'.$library_id);
		}
		else {
			$lib_data = $this->Common->get_details('yunani_library',array('id'=>$library_id))->row();

			    $file     = $_FILES['full'];
				if($file['name']!='')
				{
					$tar      = "uploads/unani/library/doc/full/";
					$rand     = $title.date('Ymd').mt_rand(1001,9999);
					$tar_file = $tar . $rand . basename($file['name']);
					move_uploaded_file($file['tmp_name'], $tar_file);
				}	       	
				else
				{
				   $tar_file = $lib_data->full;	
				}	
                
                $file1     = $_FILES['preview'];
                if($file1['name']!='')
                {
                	$file1     = $_FILES['preview'];	       	
					$tar1      = "uploads/unani/library/doc/preview/";
					$rand1     = $title.date('Ymd').mt_rand(1001,9999);
					$tar_file1 = $tar1 . $rand1 . basename($file1['name']);
					move_uploaded_file($file1['tmp_name'], $tar_file1);
                }
                else
                {
                	$tar_file1 = $lib_data->preview;	
                }	
				
			// Adding base64 file to server
			$image  = $this->input->post('image');
			$status = $this->input->post('status');
			if ($image != '') {
				$img = substr($image, strpos($image, ",") + 1);

				$url      = FCPATH.'uploads/unani/library/images/cover/';
				$rand     = $name.date('Ymd').mt_rand(1001,9999);
				$userpath = $url.$rand.'.png';
				$path     = "uploads/unani/library/images/cover/".$rand.'.png';
				file_put_contents($userpath,base64_decode($img));

				// Remove old image from the server
				$old = $this->Common->get_details('yunani_library',array('id' => $library_id))->row()->cover;
				$remove_path = FCPATH . $old;
				unlink($remove_path);

				$array = [
					'title'       => $title,
					'cover'       => $path,
					'full'        => $tar_file,
					'preview'     => $tar_file1,
					'description' => $description,
					'status'      => $status
				];
			}
			else {
				$array = [
					'title'       => $title,
					'full'        => $tar_file,
					'preview'     => $tar_file1,
					'description' => $description,
					'status'      => $status
				];
			}

			if ($this->Common->update('id',$library_id,'yunani_library',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('unani/library');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to update library..!');

				redirect('unani/library/edit/'.$library_id);
			}
		}
	}
  
   public function delete($id)
	{
		$check = $this->Common->get_details('testimonial',array('id' => $id));
		if ($check->num_rows() > 0) {
			if ($this->Common->delete('testimonial',array('id' => $id))) {
				
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Testimonial deleted successfully..!');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to remove testimonial..!');
			}
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to remove testimonial..!');
		}
		redirect('unani/testimonial');
	}
	
}
?>
