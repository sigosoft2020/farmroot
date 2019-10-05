<?php

class Delivery_locations extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function make_query(){
    $table = "delivery_locations";
    $select_column = array("del_id","place_name","district","latitude","longitude","status");
    $order_column = array(null,"place_name",null,null,null,null);

    $this->db->select($select_column);
    $this->db->from($table);
    $this->db->where('status','Active');
    if (isset($_POST["search"]["value"])) {
      $this->db->like("place_name",$_POST["search"]["value"]);
      // $this->db->or_like("district",$_POST["search"]["value"]);
    }
    if (isset($_POST["order"])) {
      $this->db->order_by($_POST['order']['0']['column'],$_POST['order']['0']['dir']);
    }
    else {
      $this->db->order_by("del_id","desc");
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
    $this->db->from("delivery_locations");
    return $this->db->count_all_results();
  }
}

?>
