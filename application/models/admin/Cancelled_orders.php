<?php

class Cancelled_orders extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function make_query()
  {
    $table = "app_orders";
    $select_column = array("OrderID","OrderNO","InvoiceNO","GrandTotal","BillingDet_UserId","BillingDet_Name","BillingDet_Email","BillingDet_Phone","BillingDet_Land","BillingDet_City","BillingDet_State","BillingDet_PIN","BillingDet_Address","delivery_date","type_of_sale","staff_status","status");
    $order_column = array(null,null,null,null,null,"BillingDet_Name",null,null,null,null);

    $this->db->select($select_column);
    $this->db->from($table);
    $this->db->where('status','Cancelled');
    if (isset($_POST["search"]["value"])) {
      $this->db->like("BillingDet_Name",$_POST["search"]["value"]);
    }
    if (isset($_POST["order"])) {
      $this->db->order_by($_POST['order']['0']['column'],$_POST['order']['0']['dir']);
    }
    else {
      $this->db->order_by("OrderID","desc");
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
    $this->db->from("app_orders");
    $this->db->where('status','Cancelled');
    return $this->db->count_all_results();
  }
}

?>
