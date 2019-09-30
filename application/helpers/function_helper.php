<?php
  function admin()
  {
    $ci =& get_instance();
	  $ci->load->library('session');
	  $admin = $ci->session->userdata('admin');
    if (isset($admin)) {
      return true;
    }
    else {
      return false;
    }
  }
  function getUserId($key)
  {
    $ci =& get_instance();
    $ci->load->database();

    $value = $ci->db->select('user_id')->from('users')->where('auth',$key)->get();

    if($value->num_rows() > 0)
    {
      return $value->row()->user_id;
    }
    else {
      return false;
    }
  }
  function owner()
  {
    $ci =& get_instance();
	  $ci->load->library('session');
	  $owner = $ci->session->userdata('owner');
    if (isset($owner)) {
      return true;
    }
    else {
      return false;
    }
  }
  function staff()
  {
    $ci =& get_instance();
	  $ci->load->library('session');
	  $staff = $ci->session->userdata('staff');
    if (isset($staff)) {
      return true;
    }
    else {
      return false;
    }
  }
 ?>
