<?php

class M_voucher extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function make_query(){
    $table = "voucher";
    $select_column = array("voucher_id","voucher_name","voucher_code","amount","valid_from","valid_to","count","minimum_cart_value","time","time_to","status");
    $order_column = array(null,"voucher_name",null,null);

    $this->db->select($select_column);
    $this->db->from($table);
    $this->db->where('status','Active');
    if (isset($_POST["search"]["value"])) {
      $this->db->like("voucher_name",$_POST["search"]["value"]);
    }
    if (isset($_POST["order"])) {
      $this->db->order_by($_POST['order']['0']['column'],$_POST['order']['0']['dir']);
    }
    else {
      $this->db->order_by("voucher_id","desc");
    }
  }
  function make_datatables()
  {
    $this->make_query();
    if ($_POST["length"] != -1) {
      $this->db->limit($_POST["length"],$_POST["start"]);
    }
    $query = $this->db->get();
    return $query->result();
  }
  function get_filtered_data()
  {
    $this->make_query();
    $query = $this->db->get();
    return $query->num_rows();
  }
  function get_all_data()
  {
    $this->db->select("*");
    $this->db->from("voucher");
    $this->db->where('status','Active');
    return $this->db->count_all_results();
  }
}

?>
