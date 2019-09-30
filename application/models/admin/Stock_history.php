<?php

class Stock_history extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function make_query($vendor_id){
     $table = "stock_history";
     $select_column = array("history_id","product_id","history_vendor_id","history_invoice_no","history_new_stock","history_pur_date","history_exp_date");
     $order_column = array(null,"history_invoice_no",null,null);

    $this->db->select($select_column);
    $this->db->from($table);
    $this->db->where('history_vendor_id',$vendor_id);
    if (isset($_POST["search"]["value"])) {
      $this->db->like("history_invoice_no",$_POST["search"]["value"]);
    }
    if (isset($_POST["order"])) {
      $this->db->order_by($_POST['order']['0']['column'],$_POST['order']['0']['dir']);
    }
    else {
      $this->db->order_by("history_id","desc");
    }
  }
  function make_datatables($vendor_id)
  {
    $this->make_query($vendor_id);
    if ($_POST["length"] != -1) {
      $this->db->limit($_POST["length"],$_POST["start"]);
    }
    $query = $this->db->get();
    return $query->result();
  }
  function get_filtered_data($vendor_id)
  {
    $this->make_query($vendor_id);
    $query = $this->db->get();
    return $query->num_rows();
  }
  function get_all_data($vendor_id)
  {
    $this->db->select("*");
    $this->db->from("stock_history");
    $this->db->where('history_vendor_id',$vendor_id);
    return $this->db->count_all_results();
  }
}

?>
