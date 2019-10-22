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
			
			$sub_array[] = '<img src="' . base_url() . $res->ProductImage . '" height="50px">';
			$sub_array[] = $res->ProductName;
			$sub_array[] = $res->ProductMRP;
			$sub_array[] = $res->Category_Title;
			$sub_array[] = $res->BrandName;
			$sub_array[] = $res->ProductUnit;
			$sub_array[] = $res->ProductStatus;
			$sub_array[] = '<a class="btn btn-link" style="font-size:17px;color:blue" href="' . site_url('admin/products/images/'.$res->ProductID) . '"><i class="fa fa-picture-o"></i></a>';
			$sub_array[] = '<a class="btn btn-link" style="font-size:17px;color:blue" href="' . site_url('admin/products/view/'.$res->ProductID) . '"><i class="fa fa-eye"></i></a>';
			$sub_array[] = '<a class="btn btn-link" style="font-size:17px;color:blue" href="' . site_url('admin/products/edit/'.$res->ProductID) . '"><i class="fa fa-pencil"></i></a>';
			$data[] = $sub_array;
		}

		$output = array(
			"draw"            => intval($_POST['draw']),
			"recordsTotal"    => $this->products->get_all_data(),
			"recordsFiltered" => $this->products->get_filtered_data(),
			"data"            => $data
		);
		echo json_encode($output);
	}

	public function add()
	{   
		$data['category']  = $this->Common->get_details('category',array('Cstatus'=>'Active'))->result();
		$data['brand']    = $this->Common->get_details('brands',array('BStatus'=>'Active'))->result();
		$this->load->view('admin/products/add',$data);
	}

	public function edit($id)
	{
		$check = $this->Common->get_details('products',array('ProductID' => $id));
		if ($check->num_rows() > 0) 
		{   
			$data['category']  = $this->Common->get_details('category',array('Cstatus'=>'Active'))->result();
			$data['subcategory']  = $this->Common->get_details('subcategory',array('Status'=>'Active'))->result();
			$data['brand']    = $this->Common->get_details('brands',array('BStatus'=>'Active'))->result();
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

		$product_name    = $this->security->xss_clean($this->input->post('ProductName'));
		$malayalam_name  = $this->security->xss_clean($this->input->post('ProductName1'));
		$manglish_name   = $this->security->xss_clean($this->input->post('manglish_name'));
		$category_id     = $this->security->xss_clean($this->input->post('category_id'));
		$subcategory_id  = $this->security->xss_clean($this->input->post('subcategory_id'));
		$brand_id        = $this->security->xss_clean($this->input->post('brand_id'));
		$product_type    = $this->security->xss_clean($this->input->post('product_type'));
		$quantity        = $this->security->xss_clean($this->input->post('Quantity'));
		$price           = $this->security->xss_clean($this->input->post('price'));
		$sgst            = $this->security->xss_clean($this->input->post('sgst'));
		$cgst            = $this->security->xss_clean($this->input->post('cgst'));
		$unit            = $this->security->xss_clean($this->input->post('Unit'));
		$unit1           = $this->security->xss_clean($this->input->post('Unit1'));
		$product_unit    = $unit.$unit1;
		// $netweight       = $this->security->xss_clean($this->input->post('Netweight'));
		$manufacturing_date  = $this->security->xss_clean($this->input->post('manufacturing_date'));
		$expiry_date     = $this->security->xss_clean($this->input->post('expiry_date'));
		$batch_number    = $this->security->xss_clean($this->input->post('batch_number'));
		$description     = $this->security->xss_clean($this->input->post('description'));
		$recipe          = $this->security->xss_clean($this->input->post('recipe'));

		$gst       = $sgst+$cgst;
        $gst_value = $price*($gst/100);
        $mrp_gst   = $price+($price*($gst/100));

        $BrandName   = $this->Common->get_details('brands',array('BrandID'=>$brand_id))->row()->BrandName;
        $PsearchName = $BrandName." ".$product_name." ".$unit;
       
		$pr_check = $this->Common->get_details('products',array('ProductName'=>$product_name,'BrandID'=>$brand_id,'ProductUnit'=>$product_unit));
		if($pr_check->num_rows()==0)
        {	
            $file     = $_FILES['image'];	       	
			$tar      = "uploads/admin/products/";
			$rand     = date('Ymd').mt_rand(1001,9999);
			$tar_file = $tar . $rand . basename($file['name']);
			move_uploaded_file($file['tmp_name'], $tar_file);

			$array = [
						'ProductName'          => $product_name,
						'malayalam_name'       => $malayalam_name,
						'manglish_name'        => $manglish_name,
						'ProductUnit'          => $product_unit,
						'Unit'                 => $unit,
						'unit1'                => $unit1,
						'PsearchName'          => $PsearchName,
						'description'          => $description,
						'ProductImage'         => $tar_file,
						'CategoryID'           => $category_id,
						'BrandID'              => $brand_id,
						'Subcategory_ID'       => $subcategory_id,
						'ProductStock'         => $quantity,
						'ProductMRP'           => $price,
						'recipe'               => $recipe,
						'sgst'                 => $sgst,
						'cgst'                 => $cgst, 
						'gst'                  => $gst,
						'gst_value'            => $gst_value,
						'mrp_gst'              => $mrp_gst,
						'offer_price'          => '0',
						'product_type'         => $product_type,
						'pflag'                => '1',
						'percentage'           => '0',
						'manufacturing_date'   => $manufacturing_date,
						'expiry_date'          => $expiry_date,
						'batch_number'         => $batch_number,
						'ProductStatus'        => 'Active',
						'timestamp'            => $timestamp
					];
			if ($product_id=$this->Common->insert('products',$array)) 
			{   
				// $img_array = [
    //              		            'product_id'    => $product_id,
    //              		            'product_image' => $tar_file,
    //              		            'timestamp'     => $timestamp
    //              	               ];
    //             $this->Common->insert('product_images',$img_array); 

                $file1 = $_FILES['file-1'];
				$file2 = $_FILES['file-2'];  
			
                if ($file1['size'] > 0) 
                 {
                 	$tar       = "uploads/admin/product_images/";
					$rand      = date('Ymd').mt_rand(1001,9999);
					$tar_file1 = $tar . $rand . basename($file1['name']);
					move_uploaded_file($file1['tmp_name'], $tar_file1);
                 	$image_array = [
                 		            'product_id'    => $product_id,
                 		            'product_image' => $tar_file1,
                 		            'timestamp'     => $timestamp
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
                 		            'product_id'    => $product_id,
                 		            'product_image' => $tar_file2,
                 		            'timestamp'     => $timestamp
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
		$product_id      = $this->security->xss_clean($this->input->post('product_id'));
        $product_name    = $this->security->xss_clean($this->input->post('ProductName'));
		$malayalam_name  = $this->security->xss_clean($this->input->post('ProductName1'));
		$manglish_name   = $this->security->xss_clean($this->input->post('manglish_name'));
		$category_id     = $this->security->xss_clean($this->input->post('category_id'));
		$subcategory_id  = $this->security->xss_clean($this->input->post('subcategory_id'));
		$brand_id        = $this->security->xss_clean($this->input->post('brand_id'));
		$product_type    = $this->security->xss_clean($this->input->post('product_type'));
		$quantity        = $this->security->xss_clean($this->input->post('Quantity'));
		$price           = $this->security->xss_clean($this->input->post('price'));
		$sgst            = $this->security->xss_clean($this->input->post('sgst'));
		$cgst            = $this->security->xss_clean($this->input->post('cgst'));
		$unit            = $this->security->xss_clean($this->input->post('Unit'));
		$unit1           = $this->security->xss_clean($this->input->post('Unit1'));
		$product_unit    = $unit.$unit1;
		// $netweight       = $this->security->xss_clean($this->input->post('Netweight'));
		$manufacturing_date  = $this->security->xss_clean($this->input->post('manufacturing_date'));
		$expiry_date     = $this->security->xss_clean($this->input->post('expiry_date'));
		$batch_number    = $this->security->xss_clean($this->input->post('batch_number'));
		$description     = $this->security->xss_clean($this->input->post('description'));
		$recipe          = $this->security->xss_clean($this->input->post('recipe'));
        $status          = $this->security->xss_clean($this->input->post('status'));

		$gst         = $sgst+$cgst;
        $gst_value   = $price*($gst/100);
        $mrp_gst     = $price+($price*($gst/100));

        $BrandName   = $this->Common->get_details('brands',array('BrandID'=>$brand_id))->row()->BrandName;
        $PsearchName = $BrandName." ".$product_name." ".$unit;

		$pr_check = $this->Common->get_details('products',array('ProductName'=>$product_name,'BrandID'=>$brand_id,'ProductUnit'=>$product_unit,'ProductID!=' => $product_id));
		if($pr_check->num_rows()>0)
        {	
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to add products..!');

			redirect('admin/products/edit/'.$product_id);
		}
		else 
		{
				$file     = $_FILES['image'];	       	                 
				if ($file['name'] != '') 
				{
					$tar      = "uploads/admin/products/";
					$rand     = date('Ymd').mt_rand(1001,9999);
					$tar_file = $tar . $rand . basename($file['name']);
					move_uploaded_file($file['tmp_name'], $tar_file);
                    
                    $array = [
								'ProductName'          => $product_name,
								'malayalam_name'       => $malayalam_name,
								'manglish_name'        => $manglish_name,
								'ProductUnit'          => $product_unit,
								'Unit'                 => $unit,
								'unit1'                => $unit1,
								'PsearchName'          => $PsearchName,
								'description'          => $description,
								'CategoryID'           => $category_id,
								'BrandID'              => $brand_id,
								'Subcategory_ID'       => $subcategory_id,
								'ProductImage'         => $tar_file,
								'ProductStock'         => $quantity,
								'ProductMRP'           => $price,
								'recipe'               => $recipe,
								'sgst'                 => $sgst,
								'cgst'                 => $cgst, 
								'gst'                  => $gst,
								'gst_value'            => $gst_value,
								'mrp_gst'              => $mrp_gst,
								'product_type'         => $product_type,
								'manufacturing_date'   => $manufacturing_date,
								'expiry_date'          => $expiry_date,
								'batch_number'         => $batch_number,
								'ProductStatus'        => $status
							];
				}
				else 
				{
				 $array = [
							'ProductName'          => $product_name,
							'malayalam_name'       => $malayalam_name,
							'manglish_name'        => $manglish_name,
							'ProductUnit'          => $product_unit,
							'Unit'                 => $unit,
							'unit1'                => $unit1,
							'PsearchName'          => $PsearchName,
							'description'          => $description,
							'CategoryID'           => $category_id,
							'BrandID'              => $brand_id,
							'Subcategory_ID'       => $subcategory_id,
							'ProductStock'         => $quantity,
							'ProductMRP'           => $price,
							'recipe'               => $recipe,
							'sgst'                 => $sgst,
							'cgst'                 => $cgst, 
							'gst'                  => $gst,
							'gst_value'            => $gst_value,
							'mrp_gst'              => $mrp_gst,
							'product_type'         => $product_type,
							'manufacturing_date'   => $manufacturing_date,
							'expiry_date'          => $expiry_date,
							'batch_number'         => $batch_number,
							'ProductStatus'        => $status
						];
				}
            
			if ($this->Common->update('ProductID',$product_id,'products',$array)) 
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

	public function view($id)
	{
	  $check = $this->Common->get_details('products',array('ProductID'=>$id));
	  if($check->num_rows()>0)
	  {
	  	$product = $check->row();
	  	$product->categoty    = $this->Common->get_details('category',array('Category_Id'=>$product->CategoryID))->row()->Category_Title;
	  	if($product->Subcategory_ID!='')
	  	{
	  	  $product->subcategoty = $this->Common->get_details('subcategory',array('subcategory_id'=>$product->Subcategory_ID))->row()->subcategory_title;	
	  	}
	  	else
	  	{
	  	  $product->subcategoty = '';	
	  	}
	  	$product->brand       = $this->Common->get_details('brands',array('BrandID'=>$product->BrandID))->row()->BrandName;
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
		$check = $this->Common->get_details('product_images',array('product_id' => $id));
		$data['images'] = $check->result();
		$data['product'] = $this->Common->get_details('products',array('ProductID'=>$id))->row()->ProductName;
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
				'product_image'   => $tar_file,
				'product_id'      => $product_id,
				'Timestamp'       => $timestamp
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
		$check = $this->Common->get_details('product_images',array('image_id'=> $id));
		if ($check->num_rows() == 1) 
		{   
			$this->Common->delete('product_images',array('image_id' => $id));
			$this->session->set_flashdata('alert_type', 'success');
		    $this->session->set_flashdata('alert_title', 'Success');
		    $this->session->set_flashdata('alert_message', 'Image deleted successfully..!');
			redirect('admin/products/images/'.$check->row()->product_id);
		}
		else 
		{
			redirect('admin/products');
		}
	}

	public function getSubCategories()
	{
		$category = $_POST['cat_id'];
		$array = $this->Common->get_details('subcategory',array('category_id' => $category , 'Status' => 'Active'))->result();
		$string = '';
		foreach ($array as $sub) {
			$string = $string . "<option value='".$sub->subcategory_id."'>".$sub->subcategory_title."</option>";
		}
		print_r(json_encode($string));
	}
}
?>
