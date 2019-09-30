<?php

class M_sliders extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function make_query(){
    $table = "library_slider";
    $select_column = array("library_slider.id as lib_id","library_id","image","yunani_library.id","title");
    $order_column = array(null,null,null,"title");

    $this->db->select($select_column);
    $this->db->from($table);
    $this->db->join('yunani_library','yunani_library.id=library_slider.library_id','left outer');
    if (isset($_POST["search"]["value"])) {
      $search = $_POST["search"]["value"];
      $this->db->where("(title LIKE '%" . $search .  "%')",NULL,false);
    }
    if (isset($_POST["order"])) {
      $this->db->order_by($_POST['order']['0']['column'],$_POST['order']['0']['dir']);
    }
    else {
      $this->db->order_by("library_slider.id","desc");
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
    $this->db->from("library_slider");
    return $this->db->count_all_results();
  }
}

?>
