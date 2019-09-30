<?php

class M_news extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }

  function make_query(){
    $today = date('Y-m-d H:i:s');

    $table = "news";
    $select_column = array("id","title","description","image");
    $order_column = array(null,"title","description",null,null);

    $this->db->select($select_column);
    $this->db->from($table);
    if (isset($_POST["search"]["value"])) {
      $search = $_POST["search"]["value"];
      $this->db->where("(title LIKE '%" . $search .  "%' OR description LIKE '%" . $search . "%')",NULL,false);
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
    $today = date('Y-m-d H:i:s');

    $this->db->select("*");
    $this->db->from("news");
    return $this->db->count_all_results();
  }

}

?>
