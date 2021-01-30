<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_kas_perusahaan extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    must_login();
    // load model
    $this->load->model('Kas_model', 'kas_m');
    // initialize for menuActive and submenuActive
    $this->modules    = "data-keuangan";
    $this->controller = "data-kas-perusahaan";
  }

  public function index()
  {
    // hanya untuk pemilik dan gudang
    role_validation($this->session->role_id, ['1', '2']);

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

  private function _______________________________hapus()
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

  public function pengeluaran()
  {
    // hanya untuk pemilik dan gudang
    role_validation($this->session->role_id, ['1', '2']);

    // set form rules
    $this->form_validation->set_rules('add-perihal', 'perihal',	  'required|trim|min_length[3]|max_length[200]');
    $this->form_validation->set_rules('add-nominal', 'nominal',   'required|trim|min_length[1]|callback_regex');
    $this->form_validation->set_error_delimiters('<small class="form-text text-danger text-nowrap"><em>', '</em></small>');

    // run the form validation
    if ($this->form_validation->run() == FALSE) {
      // set data untuk digunakan pada view
      $data = [
        'title'           => 'Input Pengeluaran Kas Perusahaan',
        'content'         => "{$this->modules}/v_{$this->controller}_pengeluaran.php",
        'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
        'submenuActive'   => "{$this->controller}", // harus selalu ada, buat indikator sidebar menu yg aktif
      ];
      $this->load->view('template_dashboard/template_wrapper', $data);

    }else {
      // insert data to db
      $post = $this->input->post();
      $post += [
        "add-type"  => "kredit",
        "created_by" => $this->session->username,
      ];
      $query = $this->kas_m->set_new_kas($post);

      if ($query) {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('success_message', 1);
        $this->session->set_flashdata('title', "Penambahan sukses!");
        $this->session->set_flashdata('text', 'Data kas telah berhasil ditambah!');
        redirect(current_url());

      }else {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('failed_message', 1);
        $this->session->set_flashdata('title', "Penambahan gagal!");
        $this->session->set_flashdata('text', 'Mohon cek kembali data kas.');
        redirect(current_url());
      } // end if($query): success or failed
    } // end form_validation->run()

  }

  public function pemasukan()
  {
    // hanya untuk pemilik
    role_validation($this->session->role_id, ['1']);

    // set form rules
    $this->form_validation->set_rules('add-perihal', 'perihal',	  'required|trim|min_length[3]|max_length[200]');
    $this->form_validation->set_rules('add-nominal', 'nominal',   'required|trim|min_length[1]|callback_regex');
    $this->form_validation->set_error_delimiters('<small class="form-text text-danger text-nowrap"><em>', '</em></small>');

    // run the form validation
    if ($this->form_validation->run() == FALSE) {
      // set data untuk digunakan pada view
      $data = [
        'title'           => 'Input Pemasukan Kas Perusahaan',
        'content'         => "{$this->modules}/v_{$this->controller}_pemasukan.php",
        'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
        'submenuActive'   => "{$this->controller}", // harus selalu ada, buat indikator sidebar menu yg aktif
      ];
      $this->load->view('template_dashboard/template_wrapper', $data);

    }else {
      // insert data to db
      $post = $this->input->post();
      $post += [
        "add-type"  => "debet",
        "created_by" => $this->session->username,
      ];
      $query = $this->kas_m->set_new_kas($post);
      // pprintd($post);

      if ($query) {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('success_message', 1);
        $this->session->set_flashdata('title', "Penambahan sukses!");
        $this->session->set_flashdata('text', 'Data kas telah berhasil ditambah!');
        redirect(current_url());

      }else {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('failed_message', 1);
        $this->session->set_flashdata('title', "Penambahan gagal!");
        $this->session->set_flashdata('text', 'Mohon cek kembali data kas.');
        redirect(current_url());
      } // end if($query): success or failed
    } // end form_validation->run()

  }

  public function regex($data)
  {
    // cek apakah sesuai dengan format penulisan uang rupiah,
    // dengan pola hanya angka {0,3} dan/ ada titik di depannya.
    // return hasil hapus titik, kemudian hapus koma, kemudian cast/ubah jadi (int)
    if (preg_match("/^\d{1,3}(?:\.\d{3})*?$/", $data)) return (int)str_replace(',', '', str_replace('.', '', $data));
    else return FALSE;
  }



}
