<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_master extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    must_login();
    // load model
    $this->load->model('Kas_model', 'kas_m');
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
      'datatables'      => 1,
      'kas'             => $this->kas_m->get_all(),
    ];
    $this->load->view('template_dashboard/template_wrapper', $data);
  }

  public function hapus()
  {
    $id  = $this->input->post('id');
    if ($id === NULL)
    {
      redirect(base_url( getBeforeLastSegment($this->modules) ));
    }
    // update data to db
    $query = $this->kas_m->set_delete_by_id($id);

    if ($query) {
      // flashdata untuk sweetalert
      $this->session->set_flashdata('success_message', 1);
      $this->session->set_flashdata('title', "Penghapusan sukses!");
      $this->session->set_flashdata('text', 'Data kas telah berhasil dihapus!');
      // kembali ke laman sebelumnya sesuai hirarki controller
      redirect(base_url( getBeforeLastSegment($this->modules) ));

    }else {
      // flashdata untuk sweetalert
      $this->session->set_flashdata('failed_message', 1);
      $this->session->set_flashdata('title', "Penghapusan gagal!");
      $this->session->set_flashdata('text', 'Mohon hubungi administrator jika masih berlanjut.');
      // kembali ke laman sebelumnya sesuai hirarki controller
      redirect(base_url( getBeforeLastSegment($this->modules) ));
    } // end if($query): success or failed
  }



}
