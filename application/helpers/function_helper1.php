<?php
  function pr($data)
  {
    echo "<pre>";
	  print_r($data);
	  echo "</pre>";
	  die();
  }
  function is_login()
  {
    $ci =& get_instance();
	  $ci->load->library('session');
	  $user = $ci->session->userdata('app_user');
    if (isset($user)) {
      if ($user['type'] == 'admin') {
        return 'admin';
      }
      else{
        return 'user';
      }
    }
    else {
      return false;
    }
  }
  function get_session()
  {
    $ci =& get_instance();
	  $ci->load->library('session');
	  $user = $ci->session->userdata('dof_user');
    return $user;
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
 ?>
