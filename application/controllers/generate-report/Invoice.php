<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		must_login();
		// load model
		// $this->load->model('Meta_model', 'meta_m');
		// initialize for menuActive and submenuActive
		$this->modules    = "generate-report";
		$this->controller = "invoice";
		$this->load->model("Kasir_model");
		$this->load->model("Meta_model");
	}

	public function index()
	{
		redirect();
		// set data untuk digunakan pada view
		$data = [
			'title'           => 'PDF',
			'content'         => "{$this->modules}/v_home.php",
			'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
			'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
		];
		$this->load->view('template_dashboard/template_wrapper', $data);
	}
	
	public function generate($id_invoice)
	{
		$data_invoice 			= (array)$this->Kasir_model->generate_invoice("inv.id, inv.invoice_number,inv.left_to_paid, inv.paid_at, inv.is_deleted, inv.transaction_id, inv.created_at, trx.deliv_address AS address, trx.deliv_phone AS phone, cust.full_name", $id_invoice);
		$data_invoice_item 	= $this->Kasir_model->generate_invoice_item($id_invoice);
		// pprintd($data_invoice_item);
		
		// semua dikonversi ke liter
		$__mililiter	= 0.001; // dalam liter
		$__liter			= 1; // dalam liter
		$__galon			= 5; // dalam liter
		$__pail				= 20; // dalam liter
		$__drum				= 200; // dalam liter

		// inisiasi array kosong dan nilai awal
		$container 	= [];
		$totLiter  	= 0;
		$totMl 			= 0;
		$tot1Liter 	= 0;
		$totGalon 	= 0;
		$totPail 		= 0;
		$totDrum 		= 0;
		$totPcs 		= 0;
		$totSachet 	= 0;
		// untuk lakukan perkalian dan semua diconvert menjadi satuan liter dan masuk ke array.
		foreach ($data_invoice_item as $row) {
			// perhitungan liter tergantung unit dari masing2 produk
			switch ($row['unit']) {
				case 'mililiter':
					$row['totLiterItem'] 	= $row['quantity'] * ($__mililiter * $row['volume']);
					
					$row['totMl'] 				= $row['quantity'];
					$totMl 	 							= $totMl + $row['totMl'];
					break;

				case 'liter':
					$row['totLiterItem'] 	= $row['quantity'] * ($__liter * $row['volume']);
					$row['tot1Liter'] 		= $row['quantity'];
					$tot1Liter 	 					= $tot1Liter + $row['tot1Liter'];
					break;

				case 'galon':
					$row['totLiterItem'] 	= $row['quantity'] * ($__galon * $row['volume']);

					$row['totGalon']	 		= $row['quantity'];
					$totGalon 	 					= $totGalon + $row['totGalon'];
					break;

				case 'pail':
					$row['totLiterItem'] 	= $row['quantity'] * ($__pail * $row['volume']);

					$row['totPail']	 			= $row['quantity'];
					$totPail 	 						= $totPail + $row['totPail'];
					break;

				case 'drum':
					$row['totLiterItem'] 	= $row['quantity'] * ($__drum * $row['volume']);

					$row['totDrum']	 			= $row['quantity'];
					$totDrum 	 						= $totDrum + $row['totDrum'];
					break;

				case 'pcs':
					$row['totLiterItem'] 	= $row['quantity'] * ($__mililiter * $row['volume']); // itungannya mililiter

					$row['totPcs']	 			= $row['quantity'];
					$totPcs 	 						= $totPcs + $row['totPcs'];
					break;
					
				case 'sachet':
					$row['totLiterItem'] 	= $row['quantity'] * ($__mililiter * $row['volume']); // itungannya mililiter

					$row['totSachet']	 		= $row['quantity'];
					$totSachet 	 					= $totSachet + $row['totSachet'];
					break;
				
				default:
					$row['totLiterItem'] 	= 0;
					break;
			}
			// totalin setiap liter si masing2 item untuk itung total liter per invoice, per 1 liter, dan per 5 liter
			// masukin variabel sendiri2, bukan ke array yg udah ada
			$totLiter 	 = $totLiter + $row['totLiterItem'];
			// jika tipe = float, format untuk angka yg ada koma2an, else format menjadi ada titik tanpa ada 0 di belakang koma
			if ( is_float($row['totLiterItem']) ) $row['totLiterItem'] = number_format($row['totLiterItem'], 2, ',', '.');
			else $row['totLiterItem'] = number_format($row['totLiterItem'], 0, ',', '.');
			// masukin array di $row ke dalem $container
			$container[] = $row;
		}
		// total liter selalu dikasih 3 nol di belakang koma, biar hasil akhir lebih detail aja
		$totLiter = number_format($totLiter, 3, ',', '.');
		// balikin value $data_invoice_item yg sudah ditambah key baru di dalamnya dari $container
		$data_invoice_item = $container;


		// pprintd($data_invoice_item);

		// get informasi perusahaan
		$metaData = $this->Meta_model->get_meta_by_id($this->session->store_id, "fullname, address, contact_1, contact_2, logo");

		// pprintd($metaData);

		$fullpath 		= FCPATH . ("assets/img/{$metaData->logo}");
		// $fullpath 	= FCPATH.("assets/img/upload/invoice/superadmin_invoicelogo.png");
		// $type 			= pathinfo($fullpath, PATHINFO_EXTENSION);
		// $data 			= file_get_contents($fullpath);
		// $base64 		= 'data:image/' . $type . ';base64,' . base64_encode($data);

		

		$noInvoice 				= $data_invoice['invoice_number'];
		$tanggal_sekarang = explode(" ", $data_invoice['created_at']);
		$tanggal_sekarang = $tanggal_sekarang[0];
		$date 						= date_create($tanggal_sekarang);

		$data = array(
			'logo' 					=> $fullpath,
			'noInvoice' 		=> $noInvoice,
			'custName' 			=> ucfirst($data_invoice['full_name']),
			'custLocation' 	=> ucfirst($data_invoice['address']),
			'custPhone'		 	=> $data_invoice['phone'],
			'date' 					=> date_format($date, "d M Y"),
			'rows'					=> $data_invoice_item,
			'totLiter'			=> $totLiter,
			'totMl'			 		=> $totMl,
			'tot1Liter' 		=> $tot1Liter,
			'totGalon' 			=> $totGalon,
			'totPail' 			=> $totPail,
			'totDrum' 			=> $totDrum,
			'totPcs' 				=> $totPcs,
			'totSachet' 		=> $totSachet,
			'metaData'			=> $metaData,
		);
		// $this->load->view('generate-report/v_invoice', $data);

		// pprintd($data);

		// view dijadiin raw bukan ditampilin
		$html = $this->load->view('generate-report/v_invoice', $data, TRUE);
		// instansiasi mpdf dan opsi. [A5-L] adalah kertas A5, orientasi Landscape
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A5-L']);
		// view raw tadi di tulis jadi pdf sama mpdf
		$mpdf->WriteHTML($html);
		// keluarin hasilnya dengan set nama file dan tipe output. INLINE = harusnya tampil di browser ga otomatis donlot
		$mpdf->Output('INVOICE-' . $noInvoice . '-' . mdate('%d%m%y', now()) . '.pdf', \Mpdf\Output\Destination::INLINE);
	}


















































	// ------------------------------------------------------- GADIPAKE LAGI GABISA2
	// 
	// 







	// public function dompdf()
	// {
	// 	$_FILES['imagefile']	= $this->session->dataMentahLogo;
	// 	// get all meta data from single image
	// 	$imgFullname 	= $_FILES['imagefile']['name'];
	// 	$imgName     	= pathinfo($imgFullname, PATHINFO_FILENAME); // foto-kuda
	// 	$imgExt      	= pathinfo($imgFullname, PATHINFO_EXTENSION); // PNg
	// 	$imgExt      	= strtolower($imgExt); // png
	// 	$imgType     	= $_FILES['imagefile']['type']; // image/png

	// 	// cek apakah image kosong / tidak
	// 	if (isset($_FILES["imagefile"]["name"])) $post['imagefile'] = $this->__uploadLogoInvoice();
	// 	else $post['imagefile'] = 'logo.png';

	// 	$fullpath			= $this->upload->data('full_path') . ".{$imgExt}";
	// 	// $this->__imageResize($fullpath, $fullpath, 300, 300);
	// 	$type 				= pathinfo($fullpath, PATHINFO_EXTENSION);
	// 	$data 				= file_get_contents($fullpath);
	// 	$base64 			= 'data:image/' . $type . ';base64,' . base64_encode($data);

	// 	$data = array(
	// 		'logo' 		=> $fullpath,
	// 	);
	// 	$html = $this->load->view('generate-report/v_invoice', $data, TRUE);

	// 	$mpdf = new \Mpdf\Mpdf();
	// 	$mpdf->WriteHTML($html);
	// 	$mpdf->Output();
	// }

	// public function pdf()
	// {
	// 	$this->form_validation->set_rules('upload', 'website', 'required');
	// 	$this->form_validation->set_error_delimiters('<small class="form-text text-danger text-nowrap"><em>', '</em></small>');

	// 	if ($this->form_validation->run() == FALSE) {
	// 		$data = [
	// 			'title'           => 'PDF',
	// 			'content'         => 'generate-report/v_home.php',
	// 			'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
	// 			'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
	// 		];
	// 		$this->load->view('template_dashboard/template_wrapper', $data);
	// 	} else {
	// 		// set semua data gambar di session dan pindah ke method lain untuk dipake
	// 		$this->session->set_userdata('dataMentahLogo', $_FILES['imagefile']);
	// 		$this->generate();
	// 		die;



	// 		// get all meta data from single image
	// 		$imgFullname 	= $_FILES['imagefile']['name'];
	// 		$imgName     	= pathinfo($imgFullname, PATHINFO_FILENAME); // foto-kuda
	// 		$imgExt      	= pathinfo($imgFullname, PATHINFO_EXTENSION); // PNg
	// 		$imgExt      	= strtolower($imgExt); // png
	// 		$imgType     	= $_FILES['imagefile']['type']; // image/png
	// 		$imgTmp      	= $_FILES['imagefile']['tmp_name'];
	// 		$imgSize     	= $_FILES['imagefile']['size']; // 120043 bytes

	// 		// cek apakah image kosong / tidak
	// 		if (isset($_FILES["imagefile"]["name"])) $post['imagefile'] = $this->__uploadLogoInvoice();
	// 		else $post['imagefile'] = 'logo.png';

	// 		$fullpath			= $this->upload->data('full_path');
	// 		// $this->__imageResize($fullpath, $fullpath, 300, 300);

	// 		// pprintd($post['imagefile']);

	// 		$fullpath 	= $this->upload->data('full_path');
	// 		$type 			= pathinfo($fullpath, PATHINFO_EXTENSION);
	// 		$data 			= file_get_contents($fullpath);
	// 		$base64 		= 'data:image/' . $type . ';base64,' . base64_encode($data);
	// 		// echo $fullpath;die;

	// 		$data = array(
	// 			'name'		=> 'Dio Ilham Djatiadi',
	// 			'logo' 		=> $base64,
	// 		);
	// 		// $this->session->set_flashdata('logo', $data);

	// 		// $this->load->view('generate-report/v_invoice', $data);
	// 		// $x = $this->load->view('generate-report/v_invoice', $data, TRUE);

	// 		// $img = '<img src="'.$base64.' />"';

	// 		// $mpdf = new \Mpdf\Mpdf();
	// 		// $mpdf->WriteHTML($x);
	// 		// $mpdf->showImageErrors = true;
	// 		// $mpdf->Output();

	// 		$this->mypdf->setPaper('A5', 'landscape');
	// 		// $date = date('d-m-y', now());
	// 		$this->mypdf->filename = "qwerty";
	// 		// $this->load->view('generate-report/v_invoice',$data);


	// 		// $this->mypdf->tess();
	// 		$this->mypdf->load_view('generate-report/v_invoice', $data);
	// 	}
	// }



	// // private method untuk upload gambar logo ke folder img
	// // dengan nama logo.png apapun ekstensi awalnya dan return nama filenya
	// private function __uploadLogoInvoice()
	// {
	// 	$createdBy 									= $this->session->username;
	// 	$config['upload_path']      = './assets/img/upload/invoice';
	// 	$config['allowed_types']    = 'jpg|png';
	// 	$config['file_name']        = "{$createdBy}_invoicelogo";
	// 	$config['overwrite']			  = true;
	// 	$config['max_size']         = 1024 * 5; // 5MB
	// 	// $config['max_width']        = 1024;
	// 	// $config['max_height']       = 768;

	// 	$this->upload->initialize($config);

	// 	if ($this->upload->do_upload('imagefile')) {
	// 		return $this->upload->data("file_name");
	// 	} else {
	// 		return now() . "-invoicelogo.png";
	// 	}
	// }



	// iamge resize
	// function __imageResize($src, $dst, $width, $height, $crop=0)
	// {

	// 	if(!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";

	// 	$type = strtolower(substr(strrchr($src,"."),1));
	// 	// pprintd($type);
	// 	if($type == 'jpeg') $type = 'jpg';
	// 	switch($type){
	// 		case 'jpg': $img = imagecreatefromjpeg($src); break;
	// 		case 'png': $img = imagecreatefrompng($src); break;
	// 		default : return "Unsupported picture type!";
	// 	}

	// 	// resize
	// 	if($crop){
	// 		if($w < $width or $h < $height) return "Picture is too small!";
	// 		$ratio = max($width/$w, $height/$h);
	// 		$h = $height / $ratio;
	// 		$x = ($w - $width / $ratio) / 2;
	// 		$w = $width / $ratio;
	// 	}
	// 	else{
	// 		if($w < $width and $h < $height) return "Picture is too small!";
	// 		$ratio = min($width/$w, $height/$h);
	// 		$width = $w * $ratio;
	// 		$height = $h * $ratio;
	// 		$x = 0;
	// 	}

	// 	$new = imagecreatetruecolor($width, $height);

	// 	// preserve transparency
	// 	if($type == "png"){
	// 		imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
	// 		imagealphablending($new, false);
	// 		imagesavealpha($new, true);
	// 	}

	// 	imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);

	// 	switch($type){
	// 		case 'jpg': imagejpeg($new, $dst); break;
	// 		case 'png': imagepng($new, $dst); break;
	// 	}

	// 	imagedestroy($new);
	// 	return true;
	// }



}
