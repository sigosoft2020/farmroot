<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/Blog_category','category');
			$this->load->model('admin/M_blog','blog');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{
		$this->load->view('admin/blog/view');
	}
	public function category()
	{
		$this->load->view('admin/blog/category');
	}
	public function get()
	{
		$result = $this->blog->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = '<img src="' . base_url() . $res->blog_image . '" height="100px">';
			$sub_array[] = $res->blog_name;
			$category_id = $res->blog_cat_id;
			$category    = $this->Common->get_details('blog_categories',array('cat_id'=>$category_id))->row()->cat_name;
			$sub_array[] = $category;
			$sub_array[] = $res->short_description;
			$sub_array[] = $res->long_description;
			$sub_array[] = $res->status;
			$sub_array[] = '<a class="btn btn-link" style="font-size:20px;color:blue" href="' . site_url('admin/blog/edit/'.$res->blog_id) . '"><i class="fa fa-edit"></i></a>';
            $sub_array[]   = '<a class="btn btn-link" style="font-size:20px;color:red" href="' . site_url('admin/blog/delete/'.$res->blog_id) . '"  onclick="return del()"><i class="fa fa-trash"></i></a>';
        
			$data[] = $sub_array;
		}

		$output = array(
						"draw"            => intval($_POST['draw']),
						"recordsTotal"    => $this->blog->get_all_data(),
						"recordsFiltered" => $this->blog->get_filtered_data(),
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
			
			$sub_array[] = $res->cat_name;
			$sub_array[] = $res->status;
			$sub_array[] = '<button type="button" class="btn btn-link" style="font-size:20px;color:blue" onclick="edit(' . $res->cat_id . ')"><i class="fa fa-pencil"></i></button>';

			if($res->status == 'Active') 
			{
             $action  = '<a class="btn btn-link" style="font-size:16px;color:red" href="' . site_url('admin/blog/category_disable/'.$res->cat_id) . '"  onclick="return block()">Block</i></a>';
            } 
            else
            {
             $action = '<a class="btn btn-link" style="font-size:16px;color:orange" href="' . site_url('admin/blog/category_enable/'.$res->cat_id) . '"  onclick="return block()">Enable</a>';
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
		$data['products'] = $this->Common->get_details('products',array('ProductStatus'=>'Active'))->result();
		$data['category'] = $this->Common->get_details('blog_categories',array('status'=>'Active'))->result();
		$this->load->view('admin/blog/add',$data);
	}
	public function edit($id)
	{
		$check = $this->Common->get_details('blog',array('blog_id' => $id));
		if ($check->num_rows() > 0) 
		{   
			$data['category'] = $this->Common->get_details('blog_categories',array('status'=>'Active'))->result();
			$data['blog'] = $check->row();
			$this->load->view('admin/blog/edit',$data);
		}
		else
		{
			redirect('blog');
		}
	}
	public function addCategory()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');

		$category_name = $this->security->xss_clean($this->input->post('category_name'));

		$category_check = $this->Common->get_details('blog_categories',array('cat_name'=>$category_name));
		if($category_check->num_rows()==0)
        {
			$array = [
						'cat_name'         => $category_name,
						'status'           => 'Active',
						'timestamp'        => $timestamp
					];
			if ($this->Common->insert('blog_categories',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'New category added..!');

				redirect('admin/blog/category');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add category..!');

				redirect('admin/blog/category');
			}		
        }
        else
        {
    	  $this->session->set_flashdata('alert_type', 'error');
		  $this->session->set_flashdata('alert_title', 'Failed');
		  $this->session->set_flashdata('alert_message', 'Category already exists..!');
          redirect('admin/blog/category');
        }			
	}

	public function category_update()
	{
		$category_id  = $this->input->post('category_id');
		$category     = $this->security->xss_clean($this->input->post('category'));
		$check        = $this->Common->get_details('blog_categories',array('cat_name' => $category , 'cat_id!=' => $category_id))->num_rows();
		if ($check > 0) 
		{
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add category..!');

			redirect('admin/blog/category');
		}
		else 
		{
			$array = [
				       'cat_name' => $category
			         ];
		
			if ($this->Common->update('cat_id',$category_id,'blog_categories',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/blog/category');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to edit category..!');

				redirect('admin/blog/category');
			}
	    }
	}

	public function category_disable($id)
	{
			$array = [
				       'status' => 'Blocked'
			         ];
		
			if ($this->Common->update('cat_id',$id,'blog_categories',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Category blocked successfully..!');

				redirect('admin/blog/category');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to block category..!');

				redirect('admin/blog/category');
			}
	}

	public function category_enable($id)
	{
			$array = [
				       'status' => 'Active'
			         ];
		
			if ($this->Common->update('cat_id',$id,'blog_categories',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Category activated successfully..!');

				redirect('admin/blog/category');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to activate category..!');

				redirect('admin/blog/category');
			}
	}
    
    public function addBlog()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');

		$blog_name     = $this->security->xss_clean($this->input->post('name'));
		$category      = $this->security->xss_clean($this->input->post('category'));
		$products      = $this->security->xss_clean($this->input->post('products'));
		$short_description   = $this->security->xss_clean($this->input->post('short_description'));
		$long_description   = $this->security->xss_clean($this->input->post('long_description'));

		$image     = $this->input->post('image');
		$img       = substr($image, strpos($image, ",") + 1);
		
		$expense_check = $this->Common->get_details('expense_table',array('ExpenseName'=>$expense_name,'expense_category_id'=>$category,'amount'=>$amount,'EDate'=>$exp_date));
		if($expense_check->num_rows()==0)
        {   
        	$url      = FCPATH.'uploads/admin/blog/';
			$rand     = $banner.date('Ymd').mt_rand(1001,9999);
			$userpath = $url.$rand.'.png';
			$path     = "uploads/admin/blog/".$rand.'.png';
			file_put_contents($userpath,base64_decode($img));
			
			$array = [
						'blog_name'            => $blog_name,
						'blog_cat_id'          => $category,
						'short_description'    => $short_description,
						'long_description'     => $long_description,
						'status'               => 'Active',
						'blog_image'           => $path,
						'timestamp'            => $timestamp
					];
			if ($id=$this->Common->insert('blog',$array)) {
				foreach($products as $product)
				{
                  $product_array = [
                                     'blog_id'     => $id,
                                     'product_id'  => $product,
                                     'timestamp'   => $timestamp
                                   ];
                  $this->Common->insert('blog_products',$product_array);                 
				}
				
				    $SERVER_API_KEY = "AAAAz7M3q5U:APA91bEtCf8zMCKuIVpg6f8RAREzU4j_lu8lfjSkfPGpFWm8G4lllKOums9Wdhw3XwkThuqm9ZmUtWH3CykX79jv-49uWkuf0ZB2kEoTJagVD0vSWsk8y5Z1gxb8XK19CcZjYAJ_2u7U";
            		$to = "/topics" . "/FCM-TOPIC-FARMROOT";
            
            		$header = [
            			'Authorization: key='. $SERVER_API_KEY,
            			'Content-Type: Application/json'
            		];
            
            		$notification = [
            			'title' => 'New blog',
            			'body' => 'New blog added',
            			'content_available' => true
            		];
            
            		$data = [
            			'title' => 'New blog',
            			'body' => 'New blog added',
            			'data' => $array
            		];
            
            		$payload = [
            			'data' => $data,
            			'notification' => $notification,
            			'to' => $to,
            			'priority' => 10
            		];
            
            		$url = 'https://fcm.googleapis.com/fcm/send';
            
            		$curl = curl_init();
            
            		curl_setopt_array($curl, array(
            			 CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            			 CURLOPT_RETURNTRANSFER => true,
            			 CURLOPT_CUSTOMREQUEST => "POST",
            			 CURLOPT_POSTFIELDS => json_encode($payload),
            			 CURLOPT_HTTPHEADER => $header,
            		));
            
            		$response = curl_exec($curl);
            		$err = curl_error($curl);
            
            		curl_close($curl);
				
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'New blog added..!');

				redirect('admin/blog');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add blog..!');

				redirect('admin/blog');
			}		
        }
        else
        {
    	  $this->session->set_flashdata('alert_type', 'error');
		  $this->session->set_flashdata('alert_title', 'Failed');
		  $this->session->set_flashdata('alert_message', 'Blog already added..!');
          redirect('admin/blog');
        }			
	}

	public function update()
	{
		$blog_id       = $this->security->xss_clean($this->input->post('blog_id'));
		$blog_name     = $this->security->xss_clean($this->input->post('name'));
		$category      = $this->security->xss_clean($this->input->post('category'));
		$products      = $this->security->xss_clean($this->input->post('products'));
		$short_description   = $this->security->xss_clean($this->input->post('short_description'));
		$long_description   = $this->security->xss_clean($this->input->post('long_description'));
        $status       = $this->security->xss_clean($this->input->post('status'));

		$check       = $this->Common->get_details('blog',array('blog_name' => $category ,'blog_cat_id'=>$category,'long_description'=>$long_description,'short_description'=>$short_description, 'blog_id!=' => $blog_id))->num_rows();
		if ($check > 0) {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add blog..!');

			redirect('admin/blog/edit/'.$blog_id);
		}
		else {
			// Adding base64 file to server
			$image  = $this->input->post('image');
			$status = $this->input->post('status');
			if ($image != '') {
				$img = substr($image, strpos($image, ",") + 1);

				$url      = FCPATH.'uploads/admin/blog/';
				$rand     = $blog.date('Ymd').mt_rand(1001,9999);
				$userpath = $url.$rand.'.png';
				$path     = "uploads/admin/blog/".$rand.'.png';
				file_put_contents($userpath,base64_decode($img));

				// Remove old image from the server
				$old = $this->Common->get_details('blog',array('blog_id' => $blog_id))->row()->blog_image;
				$remove_path = FCPATH . $old;
				unlink($remove_path);

				$array = [
						'blog_name'            => $blog_name,
						'blog_cat_id'          => $category,
						'short_description'    => $short_description,
						'long_description'     => $long_description,
						'status'               => $status,
						'blog_image'           => $path
					];
			}
			else {
				$array = [
						'blog_name'            => $blog_name,
						'blog_cat_id'          => $category,
						'short_description'    => $short_description,
						'long_description'     => $long_description,
						'status'               => $status,
					];
			}

			if ($this->Common->update('blog_id',$blog_id,'blog',$array)) {
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/blog');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to update blog..!');

				redirect('admin/blog/edit/'.$blog_id);
			}
		}
	}

	public function delete($id)
	{
		$check = $this->Common->get_details('blog',array('blog_id' => $id));
		if ($check->num_rows() > 0) {
			$banner = $check->row();
			if ($this->Common->delete('blog',array('blog_id' => $id))) {
				
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'blog deleted successfully..!');
			}
			else {
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to remove blog..!');
			}
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to remove blog..!');
		}
		redirect('admin/blog');
	}

	public function getCategoryById()
	{
		$id = $_POST['id'];
		$data = $this->Common->get_details('blog_categories',array('cat_id' => $id))->row();
		print_r(json_encode($data));
	}
}
?>
