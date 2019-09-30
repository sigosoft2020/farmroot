<?php

class Bulk_orders extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function make_query()
  {
    $table = "bulk_order";
    $select_column = array("bulk_id","product_id","price","qty","total","name","email","phone","address","city","state","pincode","status","order_no","invoice_no");
    $order_column = array(null,"name",null,null);

    $this->db->select($select_column);
    $this->db->from($table);
   
    if (isset($_POST["search"]["value"])) {
      $this->db->like("name",$_POST["search"]["value"]);
    }
    if (isset($_POST["order"])) {
      $this->db->order_by($_POST['order']['0']['column'],$_POST['order']['0']['dir']);
    }
    else {
      $this->db->order_by("bulk_id","desc");
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
    $this->db->from("bulk_order");
   
    return $this->db->count_all_results();
  }
}

?>
