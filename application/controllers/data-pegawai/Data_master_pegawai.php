<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_master_pegawai extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        must_login();
        role_validation($this->session->role_id, ['0', '1']);
        // single page load library
        $this->load->library('bcrypt');
        // load model
        $this->load->model('Employee_model', 'employee_m');
        $this->load->model('Role_model', 'role_m');
        $this->load->model('Store_model', 'store_m');
        // initialize for menuActive and submenuActive
        $this->modules    = "data-pegawai";
        $this->controller = "data-master-pegawai";
    }


    public function index()
    {
        $data = [
          'title'           => 'Data master pegawai',
          'content'         => 'data-pegawai/v_data_master_pegawai.php',
          'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
          'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
          'datatables'      => 1,
          'employees'       => $this->employee_m->get_all(
                                'e.id, e.username, e.avatar, e.first_name, e.last_name, e.phone, e.address, s.store_name, r.role_name'
                              ),
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    } // end method


    public function _tambah() // private, harus edit nama method untuk bisa akses
    {
      // set form rules
      $this->form_validation->set_rules('add-username', 'username', 					'required|trim|min_length[3]|max_length[15]|is_unique[employee.username]');
      $this->form_validation->set_rules('add-email', 'email', 								'required|trim|valid_email|min_length[5]|max_length[150]|is_unique[employee.email]');
      $this->form_validation->set_rules('add-password', 'password', 					'required|min_length[5]|max_length[250]');
      $this->form_validation->set_rules('add-verPassword', 'ulangi password', 'required|matches[add-password]');
      $this->form_validation->set_rules('add-firstname', 'nama depan', 			  'required|trim|min_length[3]|max_length[100]');
      $this->form_validation->set_rules('add-lastname', 'nama belakang', 		  'trim|min_length[3]|max_length[100]');
      $this->form_validation->set_rules('add-phone', 'no telepon', 						'required|trim|is_numeric|min_length[10]|max_length[14]');
      $this->form_validation->set_rules('add-address', 'alamat lengkap',      'required|trim|min_length[5]|max_length[250]');
      $this->form_validation->set_rules('add-role', 'jabatan', 							  'required');
      $this->form_validation->set_rules('add-store', 'toko cabang', 				  'required');
      $this->form_validation->set_error_delimiters('<small class="form-text text-danger text-nowrap"><em>', '</em></small>');

      // run the form validation
      if ($this->form_validation->run() == FALSE) {
        // set data untuk digunakan pada view
        $data = [
          'title'           => 'Tambah pegawai baru',
          'content'         => 'data-pegawai/v_data_master_pegawai_tambah.php',
          'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
          'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
          'employees'       => $this->employee_m->get_all(),
          'roles'           => $this->role_m->getAll(),
          'stores'          => $this->store_m->getAll()
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);

      }else {
        // insert data to db
        $post  = $this->input->post();
        // echo '<pre>'; print_r($post); die;
        $query = $this->employee_m->set_new_employee($post);

        if ($query) {
          // flashdata untuk sweetalert
          $this->session->set_flashdata('success_message', 1);
          $this->session->set_flashdata('title', "Penambahan sukses!");
          $this->session->set_flashdata('text', 'Data pegawai telah berhasil ditambah!');
          // kembali ke laman sebelumnya sesuai hirarki controller
          redirect(base_url( getBeforeLastSegment($this->modules) ));

        }else {
          // flashdata untuk sweetalert
          $this->session->set_flashdata('failed_message', 1);
          $this->session->set_flashdata('title', "Penambahan gagal!");
          $this->session->set_flashdata('text', 'Mohon cek kembali data pegawai.');
          // kembali ke laman sebelumnya sesuai hirarki controller
          redirect(base_url( getBeforeLastSegment($this->modules) ));
        } // end if($query): success or failed
      } // end form_validation->run()
    } // end method


    public function edit($id = NULL)
    {
      if ($id === NULL) redirect(base_url( getBeforeLastSegment($this->modules) ));
      if ($id == 0) redirect(base_url( getBeforeLastSegment($this->modules, 2) )); // redirect keluar untuk akses superadmin
      // set form rules
      $this->form_validation->set_rules('edit-firstname', 'nama depan', 			'required|trim|min_length[3]|max_length[100]');
      $this->form_validation->set_rules('edit-lastname', 'nama belakang', 		'trim|min_length[3]|max_length[100]');
      $this->form_validation->set_rules('edit-phone', 'no telepon', 					'required|trim|is_numeric|min_length[10]|max_length[14]');
      $this->form_validation->set_rules('edit-address', 'alamat lengkap',     'required|trim|min_length[5]|max_length[250]');
      $this->form_validation->set_rules('edit-role', 'jabatan', 							'required');
      $this->form_validation->set_rules('edit-store', 'toko cabang', 				  'required');
      $this->form_validation->set_error_delimiters('<small class="form-text text-danger text-nowrap"><em>', '</em></small>');

      // run the form validation
      if ($this->form_validation->run() == FALSE) {
        // query data dari database
        $result = $this->employee_m->get_by_id($id);
        // validasi jika data tidak ada (return FALSE) maka redirect keluar
        ($result !== FALSE) ?: redirect(base_url( getBeforeLastSegment($this->modules, 2) )) ;

        // set data untuk digunakan pada view
        $data = [
          'title'           => 'Ubah data pegawai',
          'content'         => 'data-pegawai/v_data_master_pegawai_edit.php',
          'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
          'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
          'employee'        => $result,
          'roles'           => $this->role_m->getAll(),
          'stores'          => $this->store_m->getAll()
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);

      }else {
        // insert data to db
        $post  = $this->input->post();
        $query = $this->employee_m->set_update_by_id($id, $post);

        if ($query) {
          // flashdata untuk sweetalert
          $this->session->set_flashdata('success_message', 1);
          $this->session->set_flashdata('title', "Pembaruan sukses!");
          $this->session->set_flashdata('text', 'Data pegawai telah berhasil diperbarui!');
          // kembali ke laman sebelumnya sesuai hirarki controller
          redirect(base_url( getBeforeLastSegment($this->modules, 2) ));

        }else {
          // flashdata untuk sweetalert
          $this->session->set_flashdata('failed_message', 1);
          $this->session->set_flashdata('title', "Pembaruan gagal!");
          $this->session->set_flashdata('text', 'Mohon cek kembali data pegawai.');
          // kembali ke laman sebelumnya sesuai hirarki controller
          redirect(base_url( getBeforeLastSegment($this->modules, 2) ));
        } // end if($query): success or failed
      } // end form_validation->run()
    } // end method


    public function edit_pass()
    {
      $id = $this->input->post('id');

      if ($id == FALSE ) redirect(base_url( getBeforeLastSegment($this->modules, 2) ));
      if ($id === NULL) redirect(base_url( getBeforeLastSegment($this->modules) ));
      if ($id == 0) redirect(base_url( getBeforeLastSegment($this->modules, 2) )); // redirect keluar untuk akses superadmin
      // set form rules
      $this->form_validation->set_rules('edit-pwnew', 'password', 							  'required|min_length[5]|max_length[250]');
      $this->form_validation->set_rules('edit-pwnewconf', 'konfirmasi password',  'required|matches[edit-pwnew]');
      $this->form_validation->set_error_delimiters('<small class="form-text text-danger text-nowrap"><em>', '</em></small>');

      // run the form validation
      if ($this->form_validation->run() == FALSE) {
        // query data dari database
        $result = $this->employee_m->get_by_id($id);
        // validasi jika data tidak ada (return FALSE) maka redirect keluar
        ($result !== FALSE) ?: redirect(base_url( getBeforeLastSegment($this->modules, 2) )) ;

        // set data untuk digunakan pada view
        $data = [
          'title'           => 'Perbarui password pegawai',
          'content'         => 'data-pegawai/v_data_master_pegawai_edit_password.php',
          'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
          'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
          'employee'        => $result,
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);

      }else {
        // insert data to db
        $post  = $this->input->post();
        // kalo inpunya gasesuai maka redirect ke detail. Tapi harusnya ini gapernah kepake karena udah validasi dari form CI3
        if ($post['edit-pwnew'] != $post['edit-pwnewconf']) redirect(base_url( getBeforeLastSegment($this->modules)."/detail/{$id}" ));

        $query = $this->employee_m->set_update_pw_by_id($id, $post);

        if ($query) {
          // flashdata untuk sweetalert
          $this->session->set_flashdata('success_message', 1);
          $this->session->set_flashdata('title', "Pembaruan sukses!");
          $this->session->set_flashdata('text', 'Password akun pegawai telah berhasil diperbarui!');
          // kembali ke laman sebelumnya sesuai hirarki controller
          redirect(base_url( getBeforeLastSegment($this->modules)."/detail/{$id}" ));

        }else {
          // flashdata untuk sweetalert
          $this->session->set_flashdata('failed_message', 1);
          $this->session->set_flashdata('title', "Pembaruan gagal!");
          $this->session->set_flashdata('text', 'Mohon cek kembali password anda.');
          // kembali ke laman sebelumnya sesuai hirarki controller
          redirect(base_url( getBeforeLastSegment($this->modules)."/detail/{$id}" ));
        } // end if($query): success or failed
      } // end form_validation->run()
    } // end method


    public function hapus()
    {
      $id  = $this->input->post('id');
      if ($id === NULL) redirect(base_url( getBeforeLastSegment($this->modules) ));
      if ($id == 0) redirect(base_url( getBeforeLastSegment($this->modules, 2) )); // redirect keluar untuk akses superadmin
      // update data to db
      // echo '<pre>'; print_r($id); die;
      $query = $this->employee_m->set_delete_by_id($id);

      if ($query) {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('success_message', 1);
        $this->session->set_flashdata('title', "Penghapusan sukses!");
        $this->session->set_flashdata('text', 'Data pegawai telah berhasil dihapus!');
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
      
    } // end method


    // ============================== DETAL =========================
    public function detail($id = NULL)
    {
      if ($id === NULL) redirect(base_url( getBeforeLastSegment($this->modules) ));
      if ($id == 0) redirect(base_url( getBeforeLastSegment($this->modules, 2) )); // redirect keluar untuk akses superadmin
      // set data untuk digunakan pada view
      $data = [
        'title'          => 'Detail pegawai',
        'content'        => 'data-pegawai/v_data_master_pegawai_detail.php',
        'menuActive'     => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
        'submenuActive'  => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
        'employee'       => $this->employee_m->get_by_id($id),
        'employeeRole'   => $this->employee_m->get_role_by_id($id),
        'employeeStore'  => $this->employee_m->get_store_by_id($id)
      ];
      $this->load->view('template_dashboard/template_wrapper', $data);
    } // end method




}
