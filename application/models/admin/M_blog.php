<?php

class M_blog extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function make_query()
  {
    $table = "blog";
    $select_column = array("blog_id","blog_name","short_description","long_description","blog_image","blog_cat_id","status");
    $order_column = array(null,"blog_name",null,null,null,null,null);

    $this->db->select($select_column);
    $this->db->from($table);
    if (isset($_POST["search"]["value"])) {
      $this->db->like("blog_name",$_POST["search"]["value"]);
    }
    if (isset($_POST["order"])) {
      $this->db->order_by($_POST['order']['0']['column'],$_POST['order']['0']['dir']);
    }
    else {
      $this->db->order_by("blog_id","desc");
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
    $this->db->from("blog");
    return $this->db->count_all_results();
  }
}

?>
