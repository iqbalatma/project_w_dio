<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_master extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    must_login();
    // load model
    // $this->load->model('Meta_model', 'meta_m');
    // initialize for menuActive and submenuActive
    $this->modules    = "kas-perusahaan";
    $this->controller = "data-master";
  }

  public function index()
  {
    $data = [
      'title'           => 'Data Master Kas Perusahaan',
      'content'         => "{$this->modules}/v_{$this->controller}.php",
      'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
      'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
      // 'meta'            => $this->meta_m->get_meta_by_id(1),
    ];
    $this->load->view('template_dashboard/template_wrapper', $data);
  }


  
}
