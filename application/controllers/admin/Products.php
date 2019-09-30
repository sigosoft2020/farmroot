<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_products','products');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function index()
	{
		$this->load->view('admin/products/view');
	}
	public function get()
	{
		$result = $this->products->make_datatables();
		$data = array();
		foreach ($result as $res) 
		{
			$sub_array = array();
			
			$sub_array[] = '<img src="' . base_url() . $res->image . '" height="50px">';
			$sub_array[] = $res->product_name;
			$sub_array[] = $res->quantity;
			$sub_array[] = $res->price;
			if($res->featured=='Featured')
			  {
               $star = '<a class="btn btn-link" style="font-size:10px;color:green" href="' . site_url('admin/products/featured_remove/'.$res->product_id) . '"><i class="fa fa-star fa-2x"></i></a>'; 
			  }	
			 else
			 {
              $star ='<a class="btn btn-link" style="font-size:10px;color:green" href="' . site_url('admin/products/featured/'.$res->product_id) . '"><i class="fa fa-star-o fa-2x"></i></a>';
			 } 
			$sub_array[] = $star;
			$sub_array[] = $res->status;
			$sub_array[] = '<a class="btn btn-link" style="font-size:17px;color:blue" href="' . site_url('admin/products/images/'.$res->product_id) . '"><i class="fa fa-picture-o"></i></a>';
			$sub_array[] = '<a class="btn btn-link" style="font-size:17px;color:blue" href="' . site_url('admin/products/view/'.$res->product_id) . '"><i class="fa fa-eye"></i></a>';
			$sub_array[] = '<a class="btn btn-link" style="font-size:17px;color:blue" href="' . site_url('admin/products/edit/'.$res->product_id) . '"><i class="fa fa-pencil"></i></a>';
			$data[] = $sub_array;
		}

		$output = array(
			"draw"   => intval($_POST['draw']),
			"recordsTotal" => $this->products->get_all_data(),
			"recordsFiltered" => $this->products->get_filtered_data(),
			"data" => $data
		);
		echo json_encode($output);
	}

	public function add()
	{   
		$data['category']  = $this->Common->get_details('category',array('Cstatus'=>'Active'))->result();
		$this->load->view('admin/products/add',$data);
	}

	public function edit($id)
	{
		$check = $this->Common->get_details('products',array('product_id' => $id));
		if ($check->num_rows() > 0) 
		{   
			$data['category']  = $this->Common->get_details('category',array('Cstatus'=>'Active'))->result();
			$data['product'] = $check->row();
			$this->load->view('admin/products/edit',$data);
		}
		else 
		{
			redirect('admin/products');
		}
	}

	public function addProduct()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');

		$product_name = $this->security->xss_clean($this->input->post('name'));
		$category_id  = $this->security->xss_clean($this->input->post('category_id'));
		$quantity     = $this->security->xss_clean($this->input->post('quantity'));
		$price        = $this->security->xss_clean($this->input->post('price'));
		$b2b_percentage = $this->security->xss_clean($this->input->post('b2b_percentage'));
		$b2b_price    = $this->security->xss_clean($this->input->post('b2b_price'));
		$description  = $this->security->xss_clean($this->input->post('description'));
		$indication   = $this->security->xss_clean($this->input->post('indication'));
       
		if($b2b_price=='')
		{
		  $b2b = $price-($price*$b2b_percentage/100);
		}
		else
		{
		  $b2b = $b2b_price;
		}

		$pr_check = $this->Common->get_details('products',array('product_name'=>$product_name,'category_id'=>$category_id,'quantity'=>$quantity));
		if($pr_check->num_rows()==0)
        {	
            $file     = $_FILES['image'];	       	
			$tar      = "uploads/admin/products/";
			$rand     = date('Ymd').mt_rand(1001,9999);
			$tar_file = $tar . $rand . basename($file['name']);
			move_uploaded_file($file['tmp_name'], $tar_file);

			$array = [
						'product_name'        => $product_name,
						'product_description' => $description,
						'image'               => $tar_file,
						'category_id'         => $category_id,
						'quantity'            => $quantity,
						'price'               => $price,
						'featured'            => 'Product',
						'indication'          => $indication,
						'b2b_percentage'      => $b2b_percentage,
						'b2b_price'           => $b2b,      
						'status'              => 'Active',
						'timestamp'           => $timestamp
					];
			if ($product_id=$this->Common->insert('products',$array)) 
			{
				$stock_array = [
                                  'product_id' => $product_id,
                                  'stock'      => '0'
				               ];
                 $this->Common->insert('stock_table',$stock_array);

                $file1 = $_FILES['file-1'];
				$file2 = $_FILES['file-2'];
				$file3 = $_FILES['file-3'];
				
                if ($file1['size'] > 0) 
                 {
                 	$tar       = "uploads/admin/product_images/";
					$rand      = date('Ymd').mt_rand(1001,9999);
					$tar_file1 = $tar . $rand . basename($file1['name']);
					move_uploaded_file($file1['tmp_name'], $tar_file1);
                 	$image_array = [
                 		            'ProductID' => $product_id,
                 		            'Image'     => $tar_file1,
                 		            'timestamp' => $timestamp
                 	               ];
                 	$this->Common->insert('product_images',$image_array);               
                 }
                 
                 if ($file2['size'] > 0) 
                 {
                 	$tar       = "uploads/admin/product_images/";
					$rand      = date('Ymd').mt_rand(1001,9999);
					$tar_file2 = $tar . $rand . basename($file2['name']);
					move_uploaded_file($file2['tmp_name'], $tar_file2);
                 	$image_array = [
                 		            'ProductID' => $product_id,
                 		            'Image'     => $tar_file2,
                 		            'timestamp' => $timestamp
                 	               ];
                 	$this->Common->insert('product_images',$image_array);               
                 }
                 
                 if ($file3['size'] > 0) 
                 {
                 	$tar      = "uploads/admin/product_images/";
					$rand     = date('Ymd').mt_rand(1001,9999);
					$tar_file3 = $tar . $rand . basename($file3['name']);
					move_uploaded_file($file3['tmp_name'], $tar_file3);
                 	$image_array = [
                 		            'ProductID' => $product_id,
                 		            'Image'     => $tar_file3,
                 		            'timestamp' => $timestamp
                 	               ];
                 	$this->Common->insert('product_images',$image_array);               
                 }

				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'New product added..!');

				redirect('admin/products');
			}
			else 
			{
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to add product..!');

				redirect('admin/products/add');
			}		
        }
        else
        {
    	  $this->session->set_flashdata('alert_type', 'error');
		  $this->session->set_flashdata('alert_title', 'Failed');
		  $this->session->set_flashdata('alert_message', 'Product already exists..!');
          redirect('admin/products');
        }			
	}

	public function update()
	{
		$product_id   = $this->security->xss_clean($this->input->post('product_id'));
        $product_name = $this->security->xss_clean($this->input->post('name'));
		$category_id  = $this->security->xss_clean($this->input->post('category_id'));
		$quantity     = $this->security->xss_clean($this->input->post('quantity'));
		$price        = $this->security->xss_clean($this->input->post('price'));
		$b2b_percentage = $this->security->xss_clean($this->input->post('b2b_percentage'));
		$b2b_price    = $this->security->xss_clean($this->input->post('b2b_price'));
		$description  = $this->security->xss_clean($this->input->post('description'));
		$indication   = $this->security->xss_clean($this->input->post('indication'));
		$status       = $this->security->xss_clean($this->input->post('status'));

		$check       = $this->Common->get_details('products',array('product_name'=>$product_name,'category_id'=>$category_id,'quantity'=>$quantity, 'product_id!=' => $product_id))->num_rows();
		if ($check > 0) {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add products..!');

			redirect('admin/products/edit/'.$product_id);
		}
		else {
				$file     = $_FILES['image'];	       	
                 
				if ($file['name'] != '') 
				{
					$tar      = "uploads/admin/products/";
					$rand     = date('Ymd').mt_rand(1001,9999);
					$tar_file = $tar . $rand . basename($file['name']);
					move_uploaded_file($file['tmp_name'], $tar_file);
                    
                    $array = [ 
		                        'product_name'        => $product_name,
								'product_description' => $description,
								'image'               => $tar_file,
								'category_id'         => $category_id,
								'quantity'            => $quantity,
								'price'               => $price,
								'indication'          => $indication,
								'b2b_percentage'      => $b2b_percentage,
								'b2b_price'           => $b2b_price,
								'status'              => $status
							];	
				}
				else 
				{
				 $array = [ 
	                        'product_name'        => $product_name,
							'product_description' => $description,
							'category_id'         => $category_id,
							'quantity'            => $quantity,
							'price'               => $price,
							'indication'          => $indication,
							'b2b_percentage'      => $b2b_percentage,
							'b2b_price'           => $b2b_price,      
							'status'              => $status
						];	
				}

			if ($this->Common->update('product_id',$product_id,'products',$array)) 
			{
				$this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Changes made successfully..!');

				redirect('admin/products');
			}
			else 
			{
				$this->session->set_flashdata('alert_type', 'error');
				$this->session->set_flashdata('alert_title', 'Failed');
				$this->session->set_flashdata('alert_message', 'Failed to update product..!');

				redirect('admin/products/edit/'.$product_id);
			}
		}
	}
	
	public function getCategoryById()
	{
		$id = $_POST['id'];
		$data = $this->Common->get_details('category',array('category_id' => $id))->row();
		print_r(json_encode($data));
	}

	public function featured($id)
	{
		$array = [
			       'featured' => 'Featured'
		         ];
	
		if ($this->Common->update('product_id',$id,'products',$array)) {
			$this->session->set_flashdata('alert_type', 'success');
			$this->session->set_flashdata('alert_title', 'Success');
			$this->session->set_flashdata('alert_message', 'Product added to featured successfully..!');

			redirect('admin/products');
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add featured..!');

			redirect('admin/products');
		}
	}

	public function featured_remove($id)
	{
		$array = [
			       'featured' => 'Product'
		         ];
	
		if ($this->Common->update('product_id',$id,'products',$array)) {
			$this->session->set_flashdata('alert_type', 'success');
			$this->session->set_flashdata('alert_title', 'Success');
			$this->session->set_flashdata('alert_message', 'Product removed from featured successfully..!');

			redirect('admin/products');
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to remove from featured..!');

			redirect('admin/products');
		}
	}

	public function view($id)
	{
	  $check = $this->Common->get_details('products',array('product_id'=>$id));
	  if($check->num_rows()>0)
	  {
	  	$product = $check->row();
	  	$product->categoty = $this->Common->get_details('category',array('category_id'=>$product->category_id))->row()->category_name;
	  }	
	  else
	  {
	  	$product = '';
	  }

	  $data['product'] = $product;
	  $this->load->view('admin/products/details',$data);
 	}

 	public function images($id)
	{
		$check = $this->Common->get_details('product_images',array('ProductID' => $id));
		$data['images'] = $check->result();
		$data['product'] = $this->Common->get_details('products',array('product_id'=>$id))->row()->product_name;
		$data['product_id'] = $id;
		$this->load->view('admin/products/gallery',$data);
	}

	public function addImage()
	{   
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');

		$product_id = $this->input->post('product_id');
		$file = $_FILES['image'];
		$tar = "uploads/admin/product_images/";
		$rand = date('Ymd').mt_rand(1001,9999);
		$tar_file = $tar . $rand . basename($file['name']);
		if(move_uploaded_file($file['tmp_name'], $tar_file))
		{
			$array = [
				'Image'      => $tar_file,
				'ProductID'  => $product_id,
				'Timestamp'  => $timestamp
			];
			$this->Common->insert('product_images',$array);
		}
		$this->session->set_flashdata('alert_type', 'success');
		$this->session->set_flashdata('alert_title', 'Success');
		$this->session->set_flashdata('alert_message', 'New image added successfully..!');
		redirect('admin/products/images/'.$product_id);
	}

	public function deleteImage()
	{
		$id = $_POST['delete_id'];
		$check = $this->Common->get_details('product_images',array('ImageID'=> $id));
		if ($check->num_rows() == 1) 
		{   
			$this->Common->delete('product_images',array('ImageID' => $id));
			$this->session->set_flashdata('alert_type', 'success');
		    $this->session->set_flashdata('alert_title', 'Success');
		    $this->session->set_flashdata('alert_message', 'Image deleted successfully..!');
			redirect('admin/products/images/'.$check->row()->ProductID);
		}
		else 
		{
			redirect('admin/products');
		}
	}
}
?>
