<?php

class M_dashboard extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function pending_orders()
  {
    $this->db->select("*");
    $this->db->from("app_orders");
    $this->db->where('status','Order Placed');
    return $this->db->get()->num_rows();
  }

 function cancelled_orders()
  {
    $this->db->select("*");
    $this->db->from("app_orders");
    $this->db->where('status','Cancelled');
    return $this->db->get()->num_rows();
  }

  function delivered_orders()
  {
    $this->db->select("*");
    $this->db->from("app_orders");
    $this->db->where('status','Delivered');
    return $this->db->get()->num_rows();
  }

  function total_orders()
  {
    $this->db->select("*");
    $this->db->from("app_orders");
    return $this->db->get()->num_rows();
  }

  function pending_today($date)
  {
    $this->db->select("*");
    $this->db->from("app_orders");
    $this->db->where('status','Order Placed');
    $this->db->where('billing_date',$date);
    return $this->db->get()->num_rows();
  }  

  function cancelled_today($date)
  {
    $this->db->select("*");
    $this->db->from("app_orders");
    $this->db->where('status','Cancelled');
    $this->db->where('cancelled_date',$date);
    return $this->db->get()->num_rows();
  }  

  function delivered_today($date)
  {
    $this->db->select("*");
    $this->db->from("app_orders");
    $this->db->where('status','Delivered');
    $this->db->where('delivered_date',$date);
    return $this->db->get()->num_rows();
  }

  function total_today($date)
  {
    $this->db->select("*");
    $this->db->from("app_orders");
    $this->db->or_where('delivered_date',$date);
    $this->db->or_where('cancelled_date',$date);
    $this->db->or_where('billing_date',$date);
    return $this->db->get()->num_rows();
  }   
}

?>
