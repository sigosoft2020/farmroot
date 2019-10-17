<?php

class M_deal extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function get_deals()
  {
    $this->db->select("*");
    $this->db->from("todays_deal");
    $this->db->order_by('deal_date','desc');
    return $this->db->get()->result();
  }
}

?>
