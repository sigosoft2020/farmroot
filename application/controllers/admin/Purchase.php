<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			// $this->load->model('admin/M_purchase','purchase');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}

	public function add()
	{   
		$data['products']      = $this->Common->get_details('products',array('ProductStatus'=>'Active','ProductStock>'=>'0'))->result();
		$data['vendors']       = $this->Common->get_details('vendors',array('StatusVendor'=>'Active'))->result();
		
		$this->load->view('admin/purchase/add',$data);
	}

	public function addData()
	{
		date_default_timezone_set('Asia/Kolkata');
		$current =date('Y-m-d H:i:s');

		$VBillingDet_ID     = $this->security->xss_clean($this->input->post('VBillingDet_Name'));
		$VBillingDet_Name   =  $this->security->xss_clean($this->input->post('vendor_name'));
		$VBillingDet_Phone  = $this->security->xss_clean($this->input->post('VBillingDet_Phone'));
		$VBillingDet_City   = $this->security->xss_clean($this->input->post('VBillingDet_City'));
		$VBillingDet_PIN    = $this->security->xss_clean($this->input->post('VBillingDet_PIN'));
		$VBillingDet_State  = $this->security->xss_clean($this->input->post('VBillingDet_State'));
		$Register_Email     = $this->security->xss_clean($this->input->post('Register_Email'));
		$VBillingDet_GST    = $this->security->xss_clean($this->input->post('VBillingDet_GST'));
		$VBillingDet_Address = $this->security->xss_clean($this->input->post('VBillingDet_Address'));
	
		$VGrandTotal = 0;
		for($i = 0; $i<count($_POST['ProductName']); $i++)
		 {
			 $Total=$_POST['Total'][$i];
			 $VGrandTotal=$VGrandTotal+$Total;
		 };

        $VInvoiceNO   = 'VP'.time();
        $billing_date = date('Y-m-d');

		$array  = [
                    'VInvoiceNO'          => $VInvoiceNO , 
                    'VGrandTotal'         => $VGrandTotal, 
                    'VBillingDet_VendorID'=> $VBillingDet_ID, 
                    'VBillingDet_Name'    => $VBillingDet_Name, 
                    'VBillingDet_Email'   => $Register_Email, 
                    'VBillingDet_Phone'   => $VBillingDet_Phone, 
                    'VBillingDet_City'    => $VBillingDet_City, 
                    'VBillingDet_State'   => $VBillingDet_State , 
                    'VBillingDet_PIN'     => $VBillingDet_PIN, 
                    'VBillingDet_Address' => $VBillingDet_Address ,
                    'Vbilling_date'       => $billing_date
		          ];
         if($VpurchaseID = $this->Common->insert('vendor_purchase',$array))
         {                     
           for($i = 0; $i<count($_POST['ProductName']); $i++)  
           {
			   $ProductName  = $_POST['ProductName'][$i];
			   $Product_Id   = $_POST['Product_Id'][$i];
			   $Quantity     = $_POST['Quantity'][$i];
			   $Product_MRP  = $_POST['Product_MRP'][$i];
			   $offerprice   = $_POST['offerprice'][$i];
			   $Total        = $_POST['Total'][$i];
			   $gst_amt      = $_POST['gst'][$i];
			   $cgst_amt     = $_POST['cgstamt'][$i];
			   $sgst_amt     = $_POST['sgstamt'][$i];

			    $product      = $this->Common->get_details('products',array('ProductID'=>$Product_Id))->row();
			 
			    $ProductStock = $product->ProductStock+$Quantity;

			    $items  = [
	                         'VpurchaseID' => $VpurchaseID, 
	                         'ProductID'   => $Product_Id, 
	                         'ProductName' => $ProductName,  
	                         'Quantity'    => $Quantity, 
	                         'ProductPrice'=> $Product_MRP, 
	                         'Total'       => $Total, 
	                         'InvoiceNO'   => $VInvoiceNO
			            ];
			    $this->Common->insert('vendor_purchase_items',$items);

                $stock  = [
            		        'ProductStock' => $ProductStock,
            		        'stock_status' => 'in'
            	          ];
               $this->Common->update('ProductID',$Product_Id,'products',$stock);			                   
            }
                $this->session->set_flashdata('alert_type', 'success');
				$this->session->set_flashdata('alert_title', 'Success');
				$this->session->set_flashdata('alert_message', 'Purchase details added succesfully..!');
        }
        redirect('admin/purchase/add');
	}	

	public function get_product()
	{		
		$id   = $this->input->post('id');
		$data = $this->Common->get_details('products',array('PsearchName' => $id))->row();
		print_r(json_encode($data));
	}

    public function get_vendor()
	{		
		$id   = $this->input->post('VBillingDet_Name');
		$data = $this->Common->get_details('vendors',array('VendorID' => $id))->row();
		print_r(json_encode($data));
	}

	
}
?>
