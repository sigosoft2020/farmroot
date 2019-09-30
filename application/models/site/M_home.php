<?php

class M_home extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  
  function get_featured_products()
  {
    $this->db->select("*");
    $this->db->from("products");
    $this->db->where('featured','Featured');
    $this->db->limit('4');
    return $this->db->get()->result();
  }

  function get_latest_products()
  {
    $this->db->select("*");
    $this->db->from("products");
    $this->db->where('status','Active');
    $this->db->order_by('product_id','desc');
    $this->db->limit('4');
    return $this->db->get()->result();
  }

  function get_products()
  {
    $this->db->select("*");
    $this->db->from("products");
    $this->db->where('status','Active');
    $this->db->order_by('product_id','asc');
    return $this->db->get()->result();
  }

  function get_high_price_products()
  {
    $this->db->select("*");
    $this->db->from("products");
    $this->db->order_by('price','desc');
    return $this->db->get()->result();
  }
}

?>
