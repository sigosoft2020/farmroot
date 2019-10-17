<?php

class M_offer extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function get_offers()
  {
    $this->db->select("*");
    $this->db->from("offer");
    $this->db->order_by('offer_id','desc');
    return $this->db->get()->result();
  }
}

?>
