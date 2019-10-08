<?php

class M_stock extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function make_query()
  {
    $table = "products";
    $select_column = array("ProductID","ProductName","ProductMRP","ProductUnit","ProductStock","products.CategoryID","products.BrandID","Netweight","ProductImage","category.Category_Id","Category_Title","brands.BrandID","BrandName","ProductStatus","manufacturing_date","expiry_date","batch_number","offer_price");
    $order_column = array(null,"ProductName",null,null,null,null,null,null,null,null,null,null);
    $this->db->select($select_column);
    $this->db->from($table);
    $this->db->join('category','category.Category_Id=products.CategoryID','left outer');
    $this->db->join('brands','brands.BrandID=products.BrandID','left outer');
    $this->db->where('products.ProductStatus','Active');
    if (isset($_POST["search"]["value"])) {
      $this->db->like("ProductName",$_POST["search"]["value"]);
    }
    if (isset($_POST["order"])) {
      $this->db->order_by($_POST['order']['0']['column'],$_POST['order']['0']['dir']);
    }
    else {
      $this->db->order_by("ProductStock","asc");
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
    $this->db->where('ProductStatus','Active');
    return $this->db->count_all_results();
  }
}

?>
