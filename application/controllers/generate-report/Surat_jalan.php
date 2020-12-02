<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_jalan extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    must_login();
		// load model
    // $this->load->model('Meta_model', 'meta_m');
    // initialize for menuActive and submenuActive
    $this->modules    = "generate-report";
    $this->controller = "surat-jalan";
  }

	public function index()
	{
		// set data untuk digunakan pada view
		$data = [
			'title'           => 'PDF',
			'content'         => "{$this->modules}/v_home.php",
			'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
			'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
		];
		$this->load->view('template_dashboard/template_wrapper', $data);
	}


	// ------------------------------------------------------- NOTE
	// 
	// 
	// DATA DARI CEKOUT DIOLAH DI DALAM METHOD INI, BIAR GAMPANG MASUKIN SESSION TRUS PINDAHIN KE VARIABEL DI DALEM METHOD
	// KALO ADA CARA LEBIH EFEKTIF LEBIH BAGUS BERARTI
	public function generate()
	{
		$fullpath 	= FCPATH.("assets/img/logo.png");
		// $fullpath 	= FCPATH.("assets/img/upload/invoice/superadmin_invoicelogo.png");
		// $type 			= pathinfo($fullpath, PATHINFO_EXTENSION);
		// $data 			= file_get_contents($fullpath);
		// $base64 		= 'data:image/' . $type . ';base64,' . base64_encode($data);

		// INI CUMA DATA DUMMY, NANTI APUS KALO DATA DARI CEKOUT UDAH DIINTEGRASIIN
		$rows = array(
			[
				'full_name'		=> 'Barang 1',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '12',
				'keterangan'	=> '50 Ltr',
			],
			[
				'full_name'		=> 'Barang 2',
				'kemasan'			=> 'Drum',
				'jumlah'			=> '3',
				'keterangan'	=> '50 Ltr',
			],
			[
				'full_name'		=> 'Barang 3',
				'kemasan'			=> 'Liter',
				'jumlah'			=> '5',
				'keterangan'	=> '50 Ltr',
			],
			[
				'full_name'		=> 'Barang 4',
				'kemasan'			=> 'Pail',
				'jumlah'			=> '15',
				'keterangan'	=> '50 Ltr',
			],[
				'full_name'		=> 'Barang 1',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '12',
				'keterangan'	=> '50 Ltr',
			],
			[
				'full_name'		=> 'Barang 2',
				'kemasan'			=> 'Drum',
				'jumlah'			=> '3',
				'keterangan'	=> '50 Ltr',
			],
			[
				'full_name'		=> 'Barang 3',
				'kemasan'			=> 'Liter',
				'jumlah'			=> '5',
				'keterangan'	=> '50 Ltr',
			],
			[
				'full_name'		=> 'Barang 4',
				'kemasan'			=> 'Pail',
				'jumlah'			=> '15',
				'keterangan'	=> '50 Ltr',
			],
		);

		$noInvoice = '10/AR/12/2020';
		$data = array(
			'logo' 					=> $fullpath,
			'noInvoice' 		=> $noInvoice,
			'custName' 			=> 'Blablabla',
			'custLocation' 	=> 'Kota Bandung, Jawa Barat, Indonesia',
			'date' 					=> mdate('%d %M %Y', now()),
			'rows'					=> $rows, // MASUKIN DARI SESSION KE SINI, NANTI FOREACH DI "GENERATE-REPORT/V_INVOICE.PHP"
		);
		// $this->load->view('generate-report/v_surat_jalan', $data);

		// view dijadiin raw bukan ditampilin
		$html = $this->load->view('generate-report/v_surat_jalan', $data, TRUE);
		// instansiasi mpdf dan opsi. [A5-L] adalah kertas A5, orientasi Landscape
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A5-L']);
		// view raw tadi di tulis jadi pdf sama mpdf
		$mpdf->WriteHTML($html);
		// keluarin hasilnya dengan set nama file dan tipe output. INLINE = harusnya tampil di browser ga otomatis donlot
		$mpdf->Output('suratjalan-'.$noInvoice.'-'.mdate('%d%m%y', now()).'.pdf', \Mpdf\Output\Destination::INLINE);
	}



}
