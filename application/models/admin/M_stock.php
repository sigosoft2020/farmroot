<?php

class M_stock extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function make_query(){
     $table = "products";
    $select_column = array("product_id","product_name","status");
    $order_column = array(null,"product_name",null,null);

    $this->db->select($select_column);
    $this->db->from($table);
    $this->db->where('status','Active');
    if (isset($_POST["search"]["value"])) {
      $this->db->like("product_name",$_POST["search"]["value"]);
    }
    if (isset($_POST["order"])) {
      $this->db->order_by($_POST['order']['0']['column'],$_POST['order']['0']['dir']);
    }
    else {
      $this->db->order_by("product_id","desc");
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
    $this->db->from("products");
    $this->db->where('status','Active');
    return $this->db->count_all_results();
  }

  function get_stock($id)
  {
    $this->db->select('stock');
    $this->db->from('stock_table');
    $this->db->where('product_id',$id);
    $result = $this->db->get();
    if($result->num_rows()>0)
    {
      return $result->row()->stock;
    }
  }
}

?>
