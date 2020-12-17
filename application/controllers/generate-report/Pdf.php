<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pdf extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		must_login();
		// load model
		// $this->load->model('Meta_model', 'meta_m');
		// initialize for menuActive and submenuActive
		$this->modules    = "generate-report";
		$this->controller = "pdf";
		// $this->load->model("Kasir_model");
	}

	public function index()
	{
		redirect();
		// set data untuk digunakan pada view
		$data = [
			'title'           => 'Generate PDF',
			'content'         => "{$this->modules}/v_pdf.php",
			'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
			'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
		];
		$this->load->view('template_dashboard/template_wrapper', $data);
	}

	public function export()
	{
		// set waktu awal untuk method ini
		$now       = now();
		$createdAt = unix_to_human($now, true, 'europe');

		$get = $this->input->get();

		$listMenu = [
			'master_bahan_mentah',
			'mutasi_bahan_mentah',
			'master_produk',
			'mutasi_produk',
			'penjualan_per_toko',
			'hutang_piutang',
			'kas_perusahaan',
			'master_pelanggan',
			'master_pegawai',
		];
		// KETERANGAN :
		// menu = di atas
		// mode = ['all', 'detail']
		// id 	= sesuai dengan id di halaman tsb.

		$arr = [
			[
			// 	'no' 						=> 1,
			// 	'name'					=> 'Data Master Bahan Mentah',
			// 	'mode'					=> 'all',
			// 	'menu'					=> 'master_bahan_mentah',
			// 	'model'					=> 'Material_model',
			// 	'query_select'	=> "product_code, full_name, CONCAT(volume, ' ', unit) AS vol_unit, price_base, selling_price, DATE_FORMAT(created_at, '%H:%i, %d %M %Y') AS date",
			// 	'asc_desc'			=> 'ASC',
			// 	'order_by'			=> 'product_code',
			// 	'columns'				=> [],
			// ],[
			// 	'no' 						=> 2,
			// 	'name'					=> 'All mutasi bahan mentah',
			// 	'mode'					=> 'all',
			// 	'menu'					=> 'mutasi_bahan_mentah',
			// 	'model'					=> '',
			// 	'query_select'	=> "product_code, full_name, CONCAT(volume, ' ', unit) AS vol_unit, price_base, selling_price, DATE_FORMAT(created_at, '%H:%i, %d %M %Y') AS date",
			// 	'asc_desc'			=> 'ASC',
			// 	'order_by'			=> 'product_code',
			// 	'columns'				=> [],
			// ],[
				'no' 						=> 3,
				'name'					=> 'Data Master Produk',
				'mode'					=> 'all',
				'menu'					=> 'master_produk',
				'model'					=> 'Product_model',
				'query_select'	=> "product_code, full_name, CONCAT(volume, ' ', unit) AS vol_unit, price_base, selling_price, DATE_FORMAT(created_at, '%H:%i, %d %M %Y') AS date",
				'asc_desc'			=> 'ASC',
				'order_by'			=> 'product_code',
				'columns'				=> ['Kode Produk', 'Nama Produk', 'Volume/Unit', 'HPP', 'Harga Jual', 'Dibuat Pada']
			],[
				'no' 						=> 4,
				'name'					=> 'Data Master Mutasi Produk',
				'mode'					=> 'all',
				'menu'					=> 'mutasi_produk',
				'model'					=> 'Product_mutation_model',
				'query_select'	=> "pm.mutation_code, p.product_code, p.full_name, s.store_name, pm.quantity, pm.mutation_type, DATE_FORMAT(pm.created_at, '%H:%i, %d %M %Y') AS date, pm.created_by",
				'asc_desc'			=> 'ASC',
				'order_by'			=> 'pm.id',
				'columns'				=> ['Kode Mutasi', 'Kode Produk', 'Nama Produk', 'Toko Cabang', 'Kuantitas', 'Tipe', 'Tanggal', 'Oleh Siapa'],
			],[
			// 	'no' 						=> 5,
			// 	'name'					=> 'All penjualan per toko',
			// 	'mode'					=> 'all',
			// 	'menu'					=> 'penjualan_per_toko',
			// 	'model'					=> '',
			// 	'query_select'	=> "product_code, full_name, CONCAT(volume, ' ', unit) AS vol_unit, price_base, selling_price, DATE_FORMAT(created_at, '%H:%i, %d %M %Y') AS date",
			// 	'asc_desc'			=> 'ASC',
			// 	'order_by'			=> 'product_code',
			// 	'columns'				=> [],
			// ],[
			// 	'no' 						=> 6,
			// 	'name'					=> 'All hutang piutang',
			// 	'mode'					=> 'all',
			// 	'menu'					=> 'hutang_piutang',
			// 	'model'					=> '',
			// 	'query_select'	=> "product_code, full_name, CONCAT(volume, ' ', unit) AS vol_unit, price_base, selling_price, DATE_FORMAT(created_at, '%H:%i, %d %M %Y') AS date",
			// 	'asc_desc'			=> 'ASC',
			// 	'order_by'			=> 'product_code',
			// 	'columns'				=> [],
			// ],[
				'no' 						=> 7,
				'name'					=> 'Data Master Kas Perusahaan',
				'mode'					=> 'all',
				'menu'					=> 'kas_perusahaan',
				'model'					=> 'Kas_model',
				'query_select'	=> "kas_code, title, description, date AS kas_date, debet, kredit, final_balance, type, created_by, DATE_FORMAT(created_at, '%H:%i, %d %M %Y') AS created_date",
				'asc_desc'			=> 'ASC',
				'order_by'			=> 'id',
				'columns'				=> ['Kode', 'Judul Kas', 'Deskripsi / Ket.', 'Tgl Transaksi', 'Debet', 'Kredit', 'Saldo Akhir', 'Tipe', 'Dibuat oleh', 'Dibuat pada'],
			],[
				'no' 						=> 8,
				'name'					=> 'Data Master Pelanggan',
				'mode'					=> 'all',
				'menu'					=> 'master_pelanggan',
				'model'					=> 'Customer_model',
				'query_select'	=> "full_name, phone, address, cust_type",
				'asc_desc'			=> 'ASC',
				'order_by'			=> 'full_name',
				'columns'				=> ['Nama Lengkap', 'No. Handphone', 'Alamat', 'Tipe'],
			],[
				'no' 						=> 9,
				'name'					=> 'Data Master Pegawai',
				'mode'					=> 'all',
				'menu'					=> 'master_pegawai',
				'model'					=> 'Employee_model',
				'query_select'	=> "e.first_name, e.last_name, e.phone, e.email, e.address, r.role_name, s.store_name",
				'asc_desc'			=> 'ASC',
				'order_by'			=> 'e.id',
				'columns'				=> ['Nama Depan', 'Nama Belakang', 'No.Handphone', 'E-mail', 'Alamat', 'Jabatan', 'Lokasi'],
			],
		];

		
		// $x = array_search('123', $arr[1]);
		// function recursive_array_search($needle,$haystack) {
		// 	foreach($haystack as $key=>$value) {
		// 			$current_key=$key;
		// 			if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
		// 					return $current_key;
		// 			}
		// 	}
		// 	return false;
		// }
		// $x = recursive_array_search('kl65', $arr);


		// // get all the array value with the key params
		// $arrCol = array_column($arr, 'menu');
		// // search in the array_columns values, and get that particular array
		// $foundKey = array_search($get['menu'], $arrCol);

		// pprintd($arr[$foundKey]);

		// cek dulu parameter getnya ada ngga
		if (isset($get['mode']) && isset($get['menu']))
		{
			echo '1';
			// cek lagi isi parameternya bener ngga
			if ( ($get['mode'] == 'detail') && isset($get['id']) && in_array($get['menu'], $listMenu) )
			{
				echo '2';
				// ini kalo mode detail, id terset, dan menu sesuai
				// cek di db apakah id ada atau engga, kalo gada keluar, kalo ada ambil data
				if ($id !== FALSE) redirect(); // kalo id gaada di db, maka redirect
				// kalo id ada maka lanjut

				// cek juga kalo isinya yg ini bener ngga
			} elseif ( ($get['mode'] == 'all') && in_array($get['menu'], $listMenu) ) {
				echo '3';
				// ini kalo mode all
				// langsung query get_all()
				// get all the array value with the key params
				$arrCol 	= array_column($arr, 'menu');
				// search in the array_columns values, and get that particular array
				$foundKey = array_search($get['menu'], $arrCol);
				$data 		= $arr[$foundKey];

				// load custom model dinamically
				$this->load->model("{$data['model']}");

				// get all columns name table for exported file
				$resultSet['columns'] = $data['columns'];
				// get name for title in pdf
				$resultSet['name'] 		= $data['name'];

				// call get_all() method with the custom model
				$resultSet['db_res'] 	= $this->{$data['model']}->get_all($data['query_select'], $data['asc_desc'], $data['order_by']);
				// set output pdf name
				$outputName						= strtoupper("Report-{$data['menu']}-" . mdate('%d%m%y', now()) . '.pdf');
				
			} else {
				echo '4';
				// ini kalo modenya gajelas, atau id gadimasukin ke get, atau menu yg dimasukin gasesuai
				redirect();
			}
		} else {
			echo '5';
			// ini kalo mode atau menu tidak terset
			redirect();
		}

		$createdAt	= date('H:i:s, d-M-Y', $now);

		$data = array(
			'filename'			=> $outputName,
			'created_at' 		=> $createdAt,
			'created_by' 		=> $this->session->username,
			'data'					=> $resultSet, 
		);
		// pprintd($resultSet);

		// view dijadiin RAW bukan ditampilin
		$html = $this->load->view('generate-report/v_pdf', $data, TRUE);

		if ($data['menu'] == 'kas_perusahaan'){
			// instansiasi mpdf dan opsi. [A4-L] adalah kertas A4, orientasi Landscape
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
		} else {
			// instansiasi mpdf dan opsi. [A4-P] adalah kertas A4, orientasi Potrait
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
		}
		
		// view raw tadi di tulis jadi pdf sama mpdf
		$mpdf->WriteHTML($html);
		// keluarin hasilnya dengan set nama file dan tipe output. INLINE = harusnya tampil di browser ga otomatis donlot
		$mpdf->Output($outputName, \Mpdf\Output\Destination::INLINE);
	}




}