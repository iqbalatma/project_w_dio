<?php

// ------------------------------------------------------------------------

if ( ! function_exists('loginValidation'))
{
  /**
  * login status validation
  *
  *
  * @param string session login status key name
  * @param string session login status value
  * @return location go to home
  */
  function loginValidation($key='isLogin', $val=1){
    if ( ! $this->session->userdata($key) == $val) {
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
  *
  * @param string role name
  * @return location go to home
  */
  function roleValidation($role=NULL){
    if ( ! $this->session->userdata('role') == $role) {
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

?>
