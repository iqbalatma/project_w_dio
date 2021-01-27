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

		if (isset($get['date_range'])){
			$dateRange 	= json_decode($get['date_range'], TRUE);
			$dateStart 	= json_decode($get['date_range'], TRUE)['awal'];
			$dateEnd 		= json_decode($get['date_range'], TRUE)['akhir'];
		} else {
			$dateRange 	= '';
			$dateStart 	= '';
			$dateEnd 		= '';
		}

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
			'laporan_penjualan',
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
			// 	'query_select'	=> "",
			// 	'asc_desc'			=> 'ASC',
			// 	'order_by'			=> '',
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
				'columns'				=> ['Kode Produk', 'Nama Produk', 'Volume/Unit', 'HPP', 'Harga Jual', 'Dibuat Pada'],
				'limit'					=> 1000,
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
				'limit'					=> 1000,
			// ],[
			// 	'no' 						=> 5,
			// 	'name'					=> 'Data Penjualan per Toko',
			// 	'mode'					=> 'all',
			// 	'menu'					=> 'penjualan_per_toko',
			// 	'model'					=> '',
			// 	'query_select'	=> "product_code, full_name, CONCAT(volume, ' ', unit) AS vol_unit, price_base, selling_price, DATE_FORMAT(created_at, '%H:%i, %d %M %Y') AS date",
			// 	'asc_desc'			=> 'ASC',
			// 	'order_by'			=> 'product_code',
			// 	'columns'				=> [],
			],[
				'no' 						=> 6,
				'name'					=> 'Data Master Utang Piutang',
				'mode'					=> 'all',
				'menu'					=> 'hutang_piutang',
				'model'					=> 'Kasir_model',
				'query_select'	=> "i.invoice_number, c.full_name, c.address, c.phone, DATE_FORMAT(i.paid_at, '%H:%i, %d %M %Y'), DATE_FORMAT(t.due_at, '%H:%i, %d %M %Y'), i.left_to_paid",
				'asc_desc'			=> 'ASC',
				'order_by'			=> 'i.id',
				'columns'				=> ['No. Invoice', 'Nama Pelanggan', 'Alamat Pelanggan', 'No. Handphone', 'Dibayar Pada', 'Tenggat Waktu', 'Sisa Bayar'],
				'limit'					=> 1000,
			],[
				'no' 						=> 7,
				'name'					=> 'Data Master Kas Perusahaan',
				'mode'					=> 'all',
				'menu'					=> 'kas_perusahaan',
				'model'					=> 'Kas_model',
				'query_select'	=> "kas_code, title, description, date AS kas_date, debet, kredit, final_balance, type, created_by, DATE_FORMAT(created_at, '%H:%i, %d %M %Y') AS created_date",
				'asc_desc'			=> 'ASC',
				'order_by'			=> 'id',
				'columns'				=> ['Kode', 'Judul Kas', 'Deskripsi / Ket.', 'Tgl Transaksi', 'Debet', 'Kredit', 'Saldo Akhir', 'Tipe', 'Dibuat oleh', 'Dibuat pada'],
				'limit'					=> 1000,
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
				'limit'					=> 1000,
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
				'limit'					=> 999999999999,
			],[
				'no' 						=> 10,
				'name'					=> "Laporan Penjualan",
				'mode'					=> 'all',
				'menu'					=> 'laporan_penjualan',
				'model'					=> 'Transaction_model',
				'query_select'	=> "trx.trans_number, trx.deliv_fullname, trx.deliv_address, trx.deliv_phone, trx.price_total, s.store_name, e.username, DATE_FORMAT(trx.created_at, '%d-%b-%Y') as created_at, DATE_FORMAT(trx.due_at, '%d-%b-%Y') AS due_at",
				'asc_desc'			=> 'ASC',
				'order_by'			=> 'trx.id',
				'columns'				=> ['Kode Transaksi', 'Nama Penerima', 'Alamat Penerima', 'No. Telp Penerima', 'Total Harga', 'Toko', 'Kasir', 'Dibuat Pada', 'Jatuh Tempo'],
				'limit'					=> 999999999999,
				'date_range'		=> $dateRange,
				'title'					=> 'Range tanggal: ',
				'subTitle'			=> "{$dateStart} - {$dateEnd}",
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

		// pprintd($arr);

		// cek dulu parameter getnya ada ngga
		if (isset($get['mode']) && isset($get['menu']) && in_array($get['menu'], $listMenu))
		{
			echo '1';
			// cek lagi isi parameternya bener ngga
			if ( ($get['mode'] == 'detail') && isset($get['id']) )
			{
				// TODO: NOTE: tapi kayanya ini blm beres dibuat, jd fokus ke all dulu
				echo '2';
				// ini kalo mode detail, id terset, dan menu sesuai
				// cek di db apakah id ada atau engga, kalo gada keluar, kalo ada ambil data
				if ($id !== FALSE) redirect(); // kalo id gaada di db, maka redirect
				// kalo id ada maka lanjut

				// cek juga kalo isinya yg ini bener ngga
			} 
			elseif ( ($get['mode'] == 'all') ) 
			{
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

				// cek ada key 'date_range' atau tidak untuk get berdasarkan rentang waktu
				if (isset($data['date_range']))
				{
					$resultSet['db_res'] 	= $this->{$data['model']}->get_all($data['query_select'], $data['asc_desc'], $data['order_by'], $data['limit'], $data['date_range']);
				} 
				else
				{
					$resultSet['db_res'] 	= $this->{$data['model']}->get_all($data['query_select'], $data['asc_desc'], $data['order_by'], $data['limit']);
				}

				// set output pdf name
				$outputName = strtoupper("Report-{$data['menu']}-" . mdate('%d%m%y', now()) . '.pdf');
				
			} 
			else 
			{
				echo '4';
				// ini kalo modenya gajelas, atau id gadimasukin ke get, atau menu yg dimasukin gasesuai
				redirect();
			}
		} 
		else 
		{
			echo '5';
			// ini kalo mode atau menu tidak terset
			redirect();
		}

		// pprintd($resultSet);

		$createdAt	= date('H:i:s, d-M-Y', $now);

		$data_pdf = array(
			'filename'			=> $outputName,
			'created_at' 		=> $createdAt,
			'created_by' 		=> $this->session->username,
			'title'					=> isset($data['title']) ? $data['title'] : '',
			'subTitle'			=> isset($data['subTitle']) ? $data['subTitle'] : '',
			'data'					=> $resultSet,
		);
		// pprintd($data_pdf);

		// view dijadiin RAW bukan ditampilin
		$html = $this->load->view('generate-report/v_pdf', $data_pdf, TRUE);

		if ( ($data['menu'] == 'kas_perusahaan') OR ($data['menu'] == 'hutang_piutang') OR ($data['menu'] == 'laporan_penjualan') ){
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