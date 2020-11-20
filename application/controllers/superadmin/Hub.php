<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hub extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    must_login();
    role_validation($this->session->role_id, ['0']);
    // load model
    $this->load->model('superadmin/File_management_model', 'fm_m');
    // initialize for menuActive and submenuActive
    $this->modules    = "superadmin";
    $this->controller = "hub";
  }

  public function index()
  {
    $data = [
      'title'           => 'Superadmin area',
      'content'         => "{$this->modules}/{$this->controller}/v_index.php",
      'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
      'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
    ];
    $this->load->view('template_dashboard/template_wrapper', $data);
  }

  public function kop()
  {
    $data = [
      'title'           => 'KOP',
      'content'         => "{$this->modules}/{$this->controller}/v_kop.php",
      'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
      'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
    ];
    $this->load->view('template_dashboard/template_wrapper', $data);
  }

  public function import_excel_db()
	{
		// syarat form
		$this->form_validation->set_rules('table-name', 'nama tabel', 'trim|required');
		if (empty($_FILES['excelFile']['name'])) $this->form_validation->set_rules('excelFile', 'file excel', 'required');
		$this->form_validation->set_error_delimiters("<span style='color:red;'>", '</span>');

		if ( $this->form_validation->run() == FALSE) {
			// set data untuk digunakan pada view
      $data = [
        'title'           => 'Import excel to database',
				'mainTitle'				=> 'Import to specific table', // must have (sub title)
        'content'         => "{$this->modules}/{$this->controller}/v_import_excel.php",
        'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
        'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
      ];
      $this->load->view('template_dashboard/template_wrapper', $data);

		}else {
	    // Load plugin PHPExcel
	    include APPPATH.'controllers/superadmin/PHPExcel/PHPExcel.php';
			if (isset($_FILES['excelFile']) && !empty($_FILES['excelFile'] ['tmp_name'])) {
				# code...
				$tableName 			= $this->input->post('table-name');
				$excelObject 		= PHPExcel_IOFactory::load($_FILES['excelFile'] ['tmp_name']);
				$import_data 		= $excelObject -> getActiveSHeet() -> toArray(null);
				// key data ke berapa
				$dataNo = 1;
				// key data eror ke berapa
				$errorNo = 1;
				$error = 0;
				// pointer
				$pointer = 1;
				// ambil headTitle
				$headTitle = $import_data[0];
				// array ke X untuk diskip tidak dibaca
				$skipped = array('0');
				foreach ($import_data as $key => $value){
					// start: proses
					// skip headTitle pada file excel
			    if(in_array($key, $skipped)){
			        continue;
			    }
					// ambil jumlah kolom aktif
					$totalColumns = count($value);
					// iterasi untuk set data sesuai dengan nama kolom
					for ($i=0; $i<$totalColumns; $i++) {
						$rowKey = $headTitle[$i];
						$rowData[$rowKey] = $value[$i];
					}
					// 																								-nama tabel  -data
					$row = $this->fm_m->import_excel_to_table($tableName, $rowData);
					if ($row === TRUE) {
						echo "data ke {$dataNo} sukses <br>";
					}else {
						echo "ERROR: data ke {$dataNo}, iterasi ke {$pointer} <br>";
						$error = 1;
					}
					// end: proses
					$dataNo++;
					$pointer++;
				} //end foreach

				if ($error == 1) {
					echo "<hr>";
					echo "Terdapat error pada salah satu data, silakan cek keterangan di atas";
					echo "<br>";
					echo "<a href=".base_url().">Back home</a>";
				}else {
					echo "Seluruh data berhasil diinput, silakan cek pada db. Redirect ke import page dalam 3 detik";
					header( "Refresh:3; url=".current_url(getBeforeLastSegment()), true, 303);
					exit();
				} // endif
			} //end excelFile isset
		} // end form_validation->run()
  } // end method
  

}
