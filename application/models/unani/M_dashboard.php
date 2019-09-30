<?php

class M_dashboard extends CI_Model
{
  function __construct()
  {
    $this->load->database();
  }
  function getUserCount()
  {
    $this->db->select("*");
    $this->db->from("yunani_directory");
    return $this->db->get()->num_rows();
  }
  function getNewsCount()
  {
    $this->db->select("*");
    $this->db->from("news");
    return $this->db->get()->num_rows();
  }
  function getGalleryCount()
  {
    $this->db->select("*");
    $this->db->from("gallery");
    return $this->db->get()->num_rows();
  }
  function getSliderCount()
  {
    $this->db->select("*");
    $this->db->from("slider");
    return $this->db->get()->num_rows();
  }

  function getUsers()
  {
    $this->db->select("name,mobile,email,image");
    $this->db->from('yunani_directory');
    $this->db->limit(6);
    $this->db->order_by('id','desc');
    return $this->db->get()->result();
  }

  function getNewses()
  {
    $this->db->select("*");
    $this->db->from('news');
    $this->db->limit(6);
    $this->db->order_by('id','desc');
    return $this->db->get()->result();
  }


}

?>
