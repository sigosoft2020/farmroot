<?php

class M_dashboardAdmin extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function pending_orders()
  {
    $this->db->select("*");
    $this->db->from("orders");
    $this->db->where('status','Order Placed');
    return $this->db->get()->num_rows();
  }

 function cancelled_orders()
  {
    $this->db->select("*");
    $this->db->from("orders");
    $this->db->where('status','Cancelled');
    return $this->db->get()->num_rows();
  }

  function delivered_orders()
  {
    $this->db->select("*");
    $this->db->from("orders");
    $this->db->where('status','Delivered');
    return $this->db->get()->num_rows();
  }

  function total_orders()
  {
    $this->db->select("*");
    $this->db->from("orders");
    return $this->db->get()->num_rows();
  }

  
}

?>
