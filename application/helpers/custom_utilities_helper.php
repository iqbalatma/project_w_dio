<?php

// ------------------------------------------------------------------------

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
  function must_login($location='auth/login', $key='isLogin', $val=1)
  {
    $ci=&get_instance();
    if ( ! $ci->session->userdata($key) == $val)
    {
      redirect(base_url($location), 'refresh');
    }
  }
}

// ------------------------------------------------------------------------

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
  function must_not_login($location='', $key='isLogin', $val=1)
  {
    $ci=&get_instance();
    if ( $ci->session->userdata($key) == $val)
    {
      redirect(base_url($location), 'refresh');
    }
  }
}

// ------------------------------------------------------------------------

if ( ! function_exists('getBeforeLastSegment'))
{
  /**
  * Get segment for redirecting
  *
  * @param string pre segment for building full uri
  * @param int backward number sequence of the segment you want to use
  * @return string segment name
  */
  function getBeforeLastSegment($url='', $n=1)
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

// ------------------------------------------------------------------------

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








// ------------------------------------------------------------------------

if ( ! function_exists('roleValidation'))
{
  /**
  * role or user access validation
  *
  * @param string role name
  * @return location go to home
  */
  function roleValidation($role=NULL)
  {
    $ci=&get_instance();
    if ( ! $ci->session->userdata('role') == $role)
    {
      redirect(base_url(), 'refresh');
    }
  }
}

?>
