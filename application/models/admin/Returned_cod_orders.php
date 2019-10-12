<?php

class Returned_cod_orders extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function get_data()
  {
    $this->db->select("returned_orders.*,app_orders.*");
    $this->db->from("returned_orders");
    $this->db->join('app_orders','app_orders.OrderNO=returned_orders.order_no');
    $this->db->where('returned_orders.rtn_status','Returned');
    $this->db->where('app_orders.payment_mode','COD');
    $this->db->group_by('returned_orders.order_no');
    $this->db->order_by('returned_orders.RetID','DESC');
    return $this->db->get()->result();
  }
}

?>
