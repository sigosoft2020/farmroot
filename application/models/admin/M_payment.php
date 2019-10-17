<?php

class M_payment extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function get_app_orders($date)
  {
    $this->db->select("*");
    $this->db->from("app_orders");
    $this->db->where('status','Delivered');
    $this->db->where('type_of_sale','App Order');
    $this->db->where('billing_date',$date);
    $this->db->order_by('OrderID','desc');
    return $this->db->get()->result();
  }

  function get_tele_orders($date)
  {
    $this->db->select("*");
    $this->db->from("app_orders");
    $this->db->where('status','Delivered');
    $this->db->where('type_of_sale','Tele Order');
    $this->db->where('billing_date',$date);
    $this->db->order_by('OrderID','desc');
    return $this->db->get()->result();
  }
}

?>
