<?php

class M_subcategory extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function make_query(){
    $table = "subcategory";
    $select_column = array("subcategory_id","subcategory_title","category.Category_Id","subcategory.category_id","Category_Title","subcategory_image","subcategory.Status as Status");
    $order_column = array(null,"subcategory_title",null,null,'Category_Title',null,null);

    $this->db->select($select_column);
    $this->db->from($table);
    $this->db->join('category','category.Category_Id=subcategory.category_id','left outer');
    if (isset($_POST["search"]["value"])) {
      $this->db->like("subcategory_title",$_POST["search"]["value"]);
      $this->db->or_like("Category_Title",$_POST["search"]["value"]);
    }
    if (isset($_POST["order"])) {
      $this->db->order_by($_POST['order']['0']['column'],$_POST['order']['0']['dir']);
    }
    else {
      $this->db->order_by("subcategory_id","desc");
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
    $this->db->from("subcategory");
    return $this->db->count_all_results();
  }
}

?>
