<?php

class M_ask extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function make_query(){
    $table = "ask_doctor";
    $select_column = array("id","question","notes","category","answer","ask_doctor.status as ask_status","ask_doctor.user_id","name");
    $order_column = array(null,null,null,"category",null,null,null,"name");

    $this->db->select($select_column);
    $this->db->from($table);
    $this->db->join('users','users.user_id=ask_doctor.user_id','left outer');
    if (isset($_POST["search"]["value"])) {
      $search = $_POST["search"]["value"];
      $this->db->where("(category LIKE '%" . $search .  "%' OR name LIKE '%" . $search . "%')",NULL,false);
    }
    if (isset($_POST["order"])) {
      $this->db->order_by($_POST['order']['0']['column'],$_POST['order']['0']['dir']);
    }
    else {
      $this->db->order_by("id","desc");
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
    $this->db->from("ask_doctor");
    return $this->db->count_all_results();
  }
}

?>
