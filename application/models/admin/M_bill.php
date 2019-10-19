<?php

class M_bill extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function get_prodcuts($name)
  {
    $this->db->select("*");
    $this->db->from("products");
    $this->db->where('ProductID',$name);
    return $this->db->get()->row();
  }

  function get_search($key)
  {
    $this->db->select("*");
    $this->db->from("products");
    $this->db->like('PsearchName', $key);
    return $this->db->get()->result();
  }

  function check_offer($today)
  {
    $this->db->select('*');
    $this->db->from('offer');
    $this->db->where('date_from<=',$today);
    $this->db->where('date_to>=',$today);
    $this->db->where('status','Active');
    return $this->db->get();
  }
}

?>
