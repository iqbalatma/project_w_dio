<?php
defined('BASEPATH') or exit('No direct script access allowed');

// -----------------------------------------------------------------------------------------------

if ( ! function_exists('must_login'))
{
  /**
  * must login or throw away
  *
  * @param string custom destination location
  * @param string session login status key name
  * @param string session login status value
  * @return location go to $location
  */
  function must_login($location = 'auth/login', $key = 'isLogin', $val = 1)
  {
    $ci=&get_instance();
    if ( ! $ci->session->userdata($key) == $val)
    {
      redirect(base_url($location), 'refresh');
    }
  }
}

if ( ! function_exists('must_not_login'))
{
  /**
  * not login or throw away
  *
  * @param string custom destination location
  * @param string session login status key name
  * @param string session login status value
  * @return location go to $location
  */
  function must_not_login($location = '', $key = 'isLogin', $val = 1)
  {
    $ci=&get_instance();
    if ( $ci->session->userdata($key) == $val)
    {
      redirect(base_url($location), 'refresh');
    }
  }
}

if ( ! function_exists('role_validation'))
{
  /**
  * What is the role of the user, and search in array stack
  * who are allowed to access something
  *
  * @param string user role name
  * @param array allowed role
  */
  function role_validation($role = '3', $who = [])
  {
    // jika tidak ada, maka tidak cocok dan buang keluar
    if ( ! in_array($role, $who)) 
    {
      redirect(base_url(), 'refresh');
    }
    return 1;
  }
}

if ( ! function_exists('role_access'))
{
  /**
  * What is the role of the user, and search in array stack
  * who are allowed to access menu
  *
  * @param string user role name
  * @param array allowed role
  */
  function role_access($role = '3', $who = [])
  {
    // jika tidak ada, maka tidak cocok dan buang keluar
    if ( ! in_array($role, $who)) 
    {
      return 0;
    }
    return 1;
  }
}

// -----------------------------------------------------------------------------------------------

if ( ! function_exists('getBeforeLastSegment'))
{
  /**
  * Get segment for redirecting
  *
  * @param string pre segment for building full uri
  * @param int backward number sequence of the segment you want to use
  * @return string segment name
  */
  function getBeforeLastSegment($url = '', $n = 1)
  {
    if ($url !== '')
    {
      $url = $url . '/';
    }
    $ci=&get_instance();
    $i = $ci->uri->total_segments() - $n;
    $uri = $url . $ci->uri->segment($i, 0);
    return $uri;
  }
}

if ( ! function_exists('getLastSegment'))
{
  /**
  * Get segment for redirecting
  *
  * @param string pre segment for building full uri
  * @param int backward number sequence of the segment you want to use
  * @return string segment name
  */
  function getLastSegment()
  {
    $ci=&get_instance();
    $last = $ci->uri->total_segments();
    return $ci->uri->segment($last);
  }
}

// -----------------------------------------------------------------------------------------------

if ( ! function_exists('pprint'))
{
	/**
	 * <Pre> print_r($str); </pre>
	 *
	 * @param	string	String/Array/Object
	*/
  function pprint($str){
    echo "<pre>"; print_r($str); echo "</pre>";
  }
}

if ( ! function_exists('pprintd'))
{
	/**
	 * <Pre> print_r($str); die;
	 *
	 * @param	string	String/Array/Object
	*/
  function pprintd($str){
    echo "<pre>"; print_r($str); die;
  }
}

if ( ! function_exists('price_format'))
{
	/**
	 * Format number to Rp. xxxxx price format
	 *
	 * @param	int	Integer of the pre-formatted price
	*/
  function price_format($int = 0)
  {
    echo "Rp.&nbsp;".number_format($int, 0, '', '.');
  }
}




// belum dipakai, cuma buat next projek
// ------------------------------------------------------------------------

if ( ! function_exists('set_swal'))
{
	/**
	 * Set flashdata session for calling sweetalert popup
	 *
	 * @param	array	$swal Berisi 3 array yang masing2 adalah string
	*/
  function set_swal($swal)
  {
    if ($swal[0] == 'success') $this->session->set_flashdata('success_message', 1);
    if ($swal[0] == 'failed') $this->session->set_flashdata('failed_message', 1);
    $this->session->set_flashdata('title', $swal[1]);
    $this->session->set_flashdata('text', $swal[2]);
  }

  // ? contoh penggunaan
  // $swal = ['success', 'Judul dari sweetalert', 'Kalo ini kontennya dari sweetalert'];
  // set_swal($swal);
}


?>
