<?php

class Returned_orders extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function make_query()
  {
    $table = "returned_orders";
    $select_column = array("RetID","mode_of_pay","bank_id","refund_total","reason","comments","order_no","rtn_status");
    $order_column = array(null,null,null,null,null,"order_no",null,null,null,null);

    $this->db->select($select_column);
    $this->db->from($table);
    $this->db->where('rtn_status','Returned');
    if (isset($_POST["search"]["value"])) {
      $this->db->like("order_no",$_POST["search"]["value"]);
    }
    if (isset($_POST["order"])) {
      $this->db->order_by($_POST['order']['0']['column'],$_POST['order']['0']['dir']);
    }
    else {
      $this->db->order_by("RetID","desc");
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
    $this->db->from("returned_orders");
    $this->db->where('rtn_status','Returned');
    return $this->db->count_all_results();
  }
}

?>
