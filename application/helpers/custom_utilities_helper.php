<?php

// ------------------------------------------------------------------------

if ( ! function_exists('loginValidation'))
{
  /**
  * login status validation
  *
  * @param string session login status key name
  * @param string session login status value
  * @return location go to home
  */
  function loginValidation($key='isLogin', $val=1){
    $ci=&get_instance();
    if ( ! $ci->session->userdata($key) == $val) {
      redirect(base_url(), 'refresh');
    }
  }
}

// ------------------------------------------------------------------------

if ( ! function_exists('roleValidation'))
{
  /**
  * role or user access validation
  *
  * @param string role name
  * @return location go to home
  */
  function roleValidation($role=NULL){
    $ci=&get_instance();
    if ( ! $ci->session->userdata('role') == $role) {
      redirect(base_url(), 'refresh');
    }
  }
}

// ------------------------------------------------------------------------

// cek username/email di db
// if (ada) {
//   cek password input dengan password db
//   if (betul) {
//     berhasil login
//   }else {
//     suruh ulangi login
//   }
// }else {
//   suruh ulangi login
// }

// ------------------------------------------------------------------------

if ( ! function_exists('getBeforeLastSegment'))
{
  /**
  * Get segment for redirecting
  *
  * @param int backward number sequence of the segment you want to use
  * @return string segment name
  */
  function getBeforeLastSegment($n=1){
    $ci=&get_instance();
    $i = $ci->uri->total_segments() - $n;
    return $ci->uri->segment($i, 0);
    
  }
}

?>