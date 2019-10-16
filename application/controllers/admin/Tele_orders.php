<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tele_orders extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('admin/M_bill','bill');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}

	public function add()
	{   
	    $d                     = date('Y-m-d'); 
		$data['products']      = $this->Common->get_details('products',array('ProductStatus'=>'Active','ProductStock>'=>'0'))->result();
		$data['del_locations'] = $this->Common->get_details('delivery_locations',array('status'=>'Active'))->result(); 
	    $data['veg_slots']     = $this->Common->get_details('delivery_slot',array('category'=>'Vegetables'))->result(); 
	    $data['nonveg_slots'] = $this->Common->get_details('delivery_slot',array('category'=>'Non Vegetables'))->result(); 
	    $data['veg_date']     = $this->Common->get_details('delivery',array('category'=>'Vegetables','delivery_date>='=>$d))->result(); 
	    $data['nonveg_date']  = $this->Common->get_details('delivery',array('category'=>'Non Vegetables','delivery_date>='=>$d))->result(); 
		
		$this->load->view('admin/tele_orders/add',$data);
	}

	public function addData()
	{
		date_default_timezone_set('Asia/Kolkata');
		$current =date('Y-m-d H:i:s');

		$BillingDet_Phone   = $this->security->xss_clean($this->input->post('BillingDet_Phone'));
		$BillingDet_Name    = $this->security->xss_clean($this->input->post('BillingDet_Name'));
		$BillingDet_Land    = $this->security->xss_clean($this->input->post('BillingDet_Land'));
		$BillingDet_City    = $this->security->xss_clean($this->input->post('BillingDet_City'));
		$BillingDet_State   = $this->security->xss_clean($this->input->post('BillingDet_State'));
		$BillingDet_PIN     = $this->security->xss_clean($this->input->post('BillingDet_PIN'));
		$BillingDet_Address = $this->security->xss_clean($this->input->post('BillingDet_Address'));
		$BillingDet_UserId  = $this->security->xss_clean($this->input->post('BillingDet_UserId'));
		$Register_Email     = $this->security->xss_clean($this->input->post('Register_Email'));
		$BillingDet_houseno = $this->security->xss_clean($this->input->post('BillingDet_houseno'));
		$notes              = $this->security->xss_clean($this->input->post('notes'));
		$d_location         = $this->security->xss_clean($this->input->post('d_location'));
		$delivery_date      = $this->security->xss_clean($this->input->post('d_date'));
		$del_date_other     = $this->security->xss_clean($this->input->post('d_date_other'));
		$d_slot_veg         = $this->security->xss_clean($this->input->post('d_slot_veg'));
		$d_slot_others      = $this->security->xss_clean($this->input->post('d_slot_others'));
		$BillingDet_Housename= $this->security->xss_clean($this->input->post('BillingDet_Housename'));
		$BillingDet_Area    = $this->security->xss_clean($this->input->post('BillingDet_Area'));
     
		$UserType         = "Guest";
		$BillingDet_date  = date('Y-m-d');
        $BillingDet_time  = date('h:i:s a', time());

        $last_invoice     = $this->Common->get_details('last_invoice',array('last_id'=>'1'))->row()->last_invoice;
        $OrderNO          = 'FMRT'.$last_invoice;
        $InvoiceNO        = 'FRT'.$last_invoice;

		$GrandTotal= 0;
		$gst_amt   = 0;
		$cgst_amt  = 0;
		$sgst_amt  = 0;
		for($i = 0; $i<count($_POST['ProductName']); $i++) 
		{
			 $Total=$_POST['Total'][$i]; 
			 $GrandTotal=$GrandTotal+$Total;
			 
			 $gst_amount=$_POST['gst'][$i]; 
			 $gst_amt=$gst_amt+$gst_amount;
			 
			 $cgst_amount=$_POST['cgstamt'][$i]; 
			 $cgst_amt=$cgst_amt+$cgst_amount;
			 
			 $sgst_amount=$_POST['sgstamt'][$i]; 
			 $sgst_amt=$sgst_amt+$sgst_amount;
		};

		$array  = [
                     'OrderNO'           => $OrderNO, 
                     'InvoiceNO'         => $InvoiceNO,  
                     'GrandTotal'        => $GrandTotal,
                     'BillingDet_UserId' => $BillingDet_UserId,
                     'UserType'          => $UserType, 
                     'BillingDet_Name'   => $BillingDet_Name, 
                     'BillingDet_Email'  => $Register_Email, 
                     'BillingDet_Phone'  => $BillingDet_Phone, 
                     'BillingDet_Land'   => $BillingDet_Land, 
                     'BillingDet_City'   => $BillingDet_City, 
                     'BillingDet_State'  => $BillingDet_State, 
                     'BillingDet_PIN'    => $BillingDet_PIN, 
                     'BillingDet_Address'=> $BillingDet_Address, 
                     'status'            => 'Order Placed',
                     'billing_date'      => $BillingDet_date,
                     'billing_time'      => $BillingDet_time,
                     'delivery_date_veg' => $delivery_date,
                     'house_no'          => $BillingDet_houseno,
                     'notes'             => $notes,
                     'd_location'        => $d_location,
                     'del_slot_veg'      => $d_slot_veg,
                     'type_of_sale'      => 'Tele Order',
                     'delivery_date'     => $del_date_other,
                     'del_slot_others'   => $d_slot_others,
                     'gst_amt'           => $gst_amt,
                     'cgst_amt'          => $cgst_amt,
                     'sgst_amt'          => $sgst_amt,
                     'BillingDet_Housename' => $BillingDet_Housename,
                     'BillingDet_Area'   => $BillingDet_Area 
		          ];
         if($OrderID = $this->Common->insert('app_orders',$array))
         {  
            $invoice  = [
    	                   'last_invoice' => $last_invoice+1
                        ];
            $this->Common->update('last_id','1','last_invoice',$invoice);
                   
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
			    $ProductImage = $product->ProductImage;
			    $sgst         = $product->sgst;
			    $cgst         = $product->cgst;
			    $gst          = $product->gst;
			    $cat_id       = $product->CategoryID;
			    $ProductStock = $product->ProductStock-$Quantity;

			    $items        =[
                                 'OrderID'     => $OrderID, 
                                 'ProductID'   => $Product_Id, 
                                 'ProductName' => $ProductName, 
                                 'ProductImage'=> $ProductImage, 
                                 'Quantity'    => $Quantity, 
                                 'ProductPrice'=> $Product_MRP, 
                                 'Total'       => $Total, 
                                 'OrderNo'     => $OrderNO, 
                                 'InvoiceNO'   => $InvoiceNO,
                                 'sgst'        => $sgst,
                                 'cgst'        => $cgst,
                                 'gst'         => $gst,
                                 'offer_price' => $offerprice,
                                 'gst_amt'     => $gst_amt,
                                 'cgst_amt'    => $cgst_amt,
                                 'sgst_amt'    => $sgst_amt,
                                 'category'    => $cat_id,
                                 'ret_status'  => 'Order Placed'
			                   ];
			    $this->Common->insert('app_order_items',$items);

			    if($ProductStock<=0)
                { 
                	$stock  = [
                		        'ProductStock' => '0',
                		        'stock_status' => 'out',
                		        'percentage'   => '0'
                	          ];
                }
                else
                {
                   $stock  = [
                		        'ProductStock' => $ProductStock,
                		        'stock_status' => 'in'
                	          ];
                }
               $this->Common->update('ProductID',$Product_Id,'products',$stock);

               $purchase_check = $this->Common->get_details('purchase_table',array('item'=>$Product_Id,'d_date'=>$delivery_date));
               if($purchase_check->num_rows()>0)
               {   
               	  $purchase_id = $purchase_check->row()->purchase_id;
               	  $quantity  = $purchase_check->row()->quantity;
               	  $purchase  = [
               	  	             'item'     => $Product_Id,
               	  	             'd_date'   => $delivery_date,
               	  	             'quantity' => $quantity+$Quantity,
               	               ];
                  $this->Common->update('purchase_id',$purchase_id,'purchase_table',$purchase);
               }
               else
               {
                  $purchase  = [
               	  	             'item'     => $Product_Id,
               	  	             'd_date'   => $delivery_date,
               	  	             'quantity' => $Quantity,
               	               ];
               	   $this->Common->insert('purchase_table',$purchase);            
               }			                   
            }
        }
        $this->session->set_flashdata('alert_type', 'success');
		$this->session->set_flashdata('alert_title', 'Success');
		$this->session->set_flashdata('alert_message', 'Order placed successfully..!');
        redirect('admin/tele_orders/add');
	}	

	public function get_product()
	{		
		$id   = $this->input->post('id');
		$data = $this->Common->get_details('products',array('PsearchName' => $id))->row();
		print_r(json_encode($data));
	}

    public function get_customer()
	{		
		$phone   = $this->input->post('BillingDet_Phone');
		$data = $this->Common->get_details('app_orders',array('BillingDet_Phone' => $phone))->row();
		print_r(json_encode($data));
	}

	public function search($key)
	{
	    $array = array();
	    $query = $this->bill->get_search($key);
	    foreach($query as $q)
	    {
	      $array[] = $q->PsearchName;
	    }
	    echo json_encode($array);
    }
}
?>
