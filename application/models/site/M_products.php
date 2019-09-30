<?php

class M_products extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  
  function get_product($key)
  {
    $this->db->select("*");
    $this->db->from("category");
    $this->db->like('category_name', $key);
    return $this->db->get()->result();
  }

  function get_search_product($key)
  {
    $this->db->select("*");
    $this->db->from("products");
    $this->db->where('status','Active');
    $this->db->like('product_name', $key);
    return $this->db->get()->result();
  }

  function get_low_price_products()
  {
    $this->db->select("*");
    $this->db->from("products");
    $this->db->where('status','Active');
    $this->db->order_by('price','asc');
    return $this->db->get()->result();
  }

  function get_high_price_products()
  {
    $this->db->select("*");
    $this->db->from("products");
    $this->db->where('status','Active');
    $this->db->order_by('price','desc');
    return $this->db->get()->result();
  }

  function get_stock($id)
  {
    $this->db->select("*");
    $this->db->from("stock_table");
    $this->db->where('product_id',$id);
    $this->db->where('stock>','0');
    return $this->db->get();
  }
}

?>
