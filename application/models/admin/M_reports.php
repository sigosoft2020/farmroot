<?php

class M_reports extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }

  function get_sales()
  {
    $this->db->select("*");
    $this->db->from("app_orders");
    $this->db->where('status','Delivered');
    $this->db->order_by('OrderID','desc');
    return $this->db->get()->result();
  }
  
 function get_purchase()
  {
    $this->db->select("vendor_purchase.*, vendors.*");
    $this->db->from("vendor_purchase");
    $this->db->join('vendors','vendors.VendorID=vendor_purchase.VBillingDet_VendorID');
    $this->db->order_by('vendor_purchase.VpurchaseID','desc');
    return $this->db->get()->result();
  }

  function get_fresh_total($OrderID)
  {
    $this->db->select('SUM(Total) as total');
    $this->db->from('app_order_items');
    $this->db->where('category','11');
    $this->db->where('OrderID',$OrderID);
    $result= $this->db->get();
    if($result->num_rows()>0)
    {
      return $result->row()->total;
    }
     else
    {
        return false;
    }
  }

  function get_veg_total($OrderID)
  {
    $this->db->select('SUM(Total) as total');
    $this->db->from('app_order_items');
    $this->db->where('category','7');
    $this->db->where('OrderID',$OrderID);
    $result= $this->db->get();
    if($result->num_rows()>0)
    {
      return $result->row()->total;
    }
     else
    {
        return false;
    }
  }

 function get_grocery_total($OrderID)
  {
    $this->db->select('SUM(Total) as total');
    $this->db->from('app_order_items');
    $this->db->where('category','8');
    $this->db->where('OrderID',$OrderID);
    $result= $this->db->get();
    if($result->num_rows()>0)
    {
      return $result->row()->total;
    }
     else
    {
        return false;
    }
  }

  function get_fruits_total($OrderID)
  {
    $this->db->select('SUM(Total) as total');
    $this->db->from('app_order_items');
    $this->db->where('category','9');
    $this->db->where('OrderID',$OrderID);
    $result= $this->db->get();
    if($result->num_rows()>0)
    {
      return $result->row()->total;
    }
     else
    {
        return false;
    }
  }

  function get_babyfood_total($OrderID)
  {
    $this->db->select('SUM(Total) as total');
    $this->db->from('app_order_items');
    $this->db->where('category','13');
    $this->db->where('OrderID',$OrderID);
    $result= $this->db->get();
    if($result->num_rows()>0)
    {
      return $result->row()->total;
    }
     else
    {
        return false;
    }
  }

}

?>
