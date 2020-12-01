<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
				'keterangan'	=> '-',
				'harga'				=> '10.000',
				'total'				=> '120.000',
			],
			[
				'full_name'		=> 'Barang 2',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '3',
				'keterangan'	=> '-',
				'harga'				=> '20.000',
				'total'				=> '60.000',
			],
			[
				'full_name'		=> 'Barang 3',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '5',
				'keterangan'	=> '-',
				'harga'				=> '12.000',
				'total'				=> '60.000',
			],
			[
				'full_name'		=> 'Barang 4',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '15',
				'keterangan'	=> '-',
				'harga'				=> '20.000',
				'total'				=> '300.000',
			],[
				'full_name'		=> 'Barang 1',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '12',
				'keterangan'	=> '-',
				'harga'				=> '10.000',
				'total'				=> '120.000',
			],
			[
				'full_name'		=> 'Barang 2',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '3',
				'keterangan'	=> '-',
				'harga'				=> '20.000',
				'total'				=> '60.000',
			],
			[
				'full_name'		=> 'Barang 3',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '5',
				'keterangan'	=> '-',
				'harga'				=> '12.000',
				'total'				=> '60.000',
			],
			[
				'full_name'		=> 'Barang 4',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '15',
				'keterangan'	=> '-',
				'harga'				=> '20.000',
				'total'				=> '300.000',
			],[
				'full_name'		=> 'Barang 1',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '12',
				'keterangan'	=> '-',
				'harga'				=> '10.000',
				'total'				=> '120.000',
			],
			[
				'full_name'		=> 'Barang 2',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '3',
				'keterangan'	=> '-',
				'harga'				=> '20.000',
				'total'				=> '60.000',
			],
			[
				'full_name'		=> 'Barang 3',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '5',
				'keterangan'	=> '-',
				'harga'				=> '12.000',
				'total'				=> '60.000',
			],
			[
				'full_name'		=> 'Barang 4',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '15',
				'keterangan'	=> '-',
				'harga'				=> '20.000',
				'total'				=> '300.000',
			],[
				'full_name'		=> 'Barang 1',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '12',
				'keterangan'	=> '-',
				'harga'				=> '10.000',
				'total'				=> '120.000',
			],
			[
				'full_name'		=> 'Barang 2',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '3',
				'keterangan'	=> '-',
				'harga'				=> '20.000',
				'total'				=> '60.000',
			],
			[
				'full_name'		=> 'Barang 3',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '5',
				'keterangan'	=> '-',
				'harga'				=> '12.000',
				'total'				=> '60.000',
			],
			[
				'full_name'		=> 'Barang 4',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '15',
				'keterangan'	=> '-',
				'harga'				=> '20.000',
				'total'				=> '300.000',
			],[
				'full_name'		=> 'Barang 1',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '12',
				'keterangan'	=> '-',
				'harga'				=> '10.000',
				'total'				=> '120.000',
			],
			[
				'full_name'		=> 'Barang 2',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '3',
				'keterangan'	=> '-',
				'harga'				=> '20.000',
				'total'				=> '60.000',
			],
			[
				'full_name'		=> 'Barang 3',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '5',
				'keterangan'	=> '-',
				'harga'				=> '12.000',
				'total'				=> '60.000',
			],
			[
				'full_name'		=> 'Barang 4',
				'kemasan'			=> 'Galon',
				'jumlah'			=> '15',
				'keterangan'	=> '-',
				'harga'				=> '20.000',
				'total'				=> '300.000',
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
		// $this->load->view('generate-report/v_invoice', $data);

		// view dijadiin raw bukan ditampilin
		$html = $this->load->view('generate-report/v_invoice', $data, TRUE);
		// instansiasi mpdf dan opsi. [A5-L] adalah kertas A5, orientasi Landscape
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A5-L']);
		// view raw tadi di tulis jadi pdf sama mpdf
		$mpdf->WriteHTML($html);
		// keluarin hasilnya dengan set nama file dan tipe output. INLINE = harusnya tampil di browser ga otomatis donlot
		$mpdf->Output('invoice-'.$noInvoice.'-'.mdate('%d%m%y', now()).'.pdf', \Mpdf\Output\Destination::INLINE);
	}


















































// ------------------------------------------------------- GADIPAKE LAGI GABISA2
	// 
	// 






	
	public function dompdf()
	{
		$_FILES['imagefile']	= $this->session->dataMentahLogo;
		// get all meta data from single image
		$imgFullname 	= $_FILES['imagefile']['name'];
		$imgName     	= pathinfo($imgFullname, PATHINFO_FILENAME); // foto-kuda
		$imgExt      	= pathinfo($imgFullname, PATHINFO_EXTENSION); // PNg
		$imgExt      	= strtolower($imgExt); // png
		$imgType     	= $_FILES['imagefile']['type']; // image/png

		// cek apakah image kosong / tidak
		if ( isset($_FILES["imagefile"]["name"])) $post['imagefile'] = $this->__uploadLogoInvoice();
		else $post['imagefile'] = 'logo.png';

		$fullpath			= $this->upload->data('full_path').".{$imgExt}";
		// $this->__imageResize($fullpath, $fullpath, 300, 300);
		$type 				= pathinfo($fullpath, PATHINFO_EXTENSION);
		$data 				= file_get_contents($fullpath);
		$base64 			= 'data:image/'.$type.';base64,'.base64_encode($data);

		$data = array(
			'logo' 		=> $fullpath,
		);
		$html = $this->load->view('generate-report/v_invoice', $data, TRUE);

		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($html);
		$mpdf->Output();

	}

	public function pdf()
	{
    $this->form_validation->set_rules('upload', 'website', 'required');
		$this->form_validation->set_error_delimiters('<small class="form-text text-danger text-nowrap"><em>', '</em></small>');
		
		if ($this->form_validation->run() == FALSE) 
		{
			$data = [
				'title'           => 'PDF',
				'content'         => 'generate-report/v_home.php',
				'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
				'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
			];
			$this->load->view('template_dashboard/template_wrapper', $data);
		} 
		else
		{
			// set semua data gambar di session dan pindah ke method lain untuk dipake
			$this->session->set_userdata('dataMentahLogo', $_FILES['imagefile']);
			$this->generate();
			die;



			// get all meta data from single image
			$imgFullname 	= $_FILES['imagefile']['name'];
			$imgName     	= pathinfo($imgFullname, PATHINFO_FILENAME); // foto-kuda
			$imgExt      	= pathinfo($imgFullname, PATHINFO_EXTENSION); // PNg
			$imgExt      	= strtolower($imgExt); // png
			$imgType     	= $_FILES['imagefile']['type']; // image/png
			$imgTmp      	= $_FILES['imagefile']['tmp_name']; 
			$imgSize     	= $_FILES['imagefile']['size']; // 120043 bytes

			// cek apakah image kosong / tidak
      if ( isset($_FILES["imagefile"]["name"])) $post['imagefile'] = $this->__uploadLogoInvoice();
			else $post['imagefile'] = 'logo.png';

			$fullpath			= $this->upload->data('full_path');
			// $this->__imageResize($fullpath, $fullpath, 300, 300);

			// pprintd($post['imagefile']);

			$fullpath 	= $this->upload->data('full_path');
			$type 			= pathinfo($fullpath, PATHINFO_EXTENSION);
			$data 			= file_get_contents($fullpath);
			$base64 		= 'data:image/' . $type . ';base64,' . base64_encode($data);
			// echo $fullpath;die;

			$data = array(
				'name'		=> 'Dio Ilham Djatiadi',
				'logo' 		=> $base64,
			);
			// $this->session->set_flashdata('logo', $data);

			// $this->load->view('generate-report/v_invoice', $data);
			// $x = $this->load->view('generate-report/v_invoice', $data, TRUE);

			// $img = '<img src="'.$base64.' />"';
			
			// $mpdf = new \Mpdf\Mpdf();
			// $mpdf->WriteHTML($x);
			// $mpdf->showImageErrors = true;
			// $mpdf->Output();

			$this->mypdf->setPaper('A5', 'landscape');
			// $date = date('d-m-y', now());
			$this->mypdf->filename = "qwerty";
			// $this->load->view('generate-report/v_invoice',$data);
			
			
			// $this->mypdf->tess();
			$this->mypdf->load_view('generate-report/v_invoice', $data);

		}	
	}



	// private method untuk upload gambar logo ke folder img
  // dengan nama logo.png apapun ekstensi awalnya dan return nama filenya
  private function __uploadLogoInvoice()
  {
		$createdBy 									= $this->session->username;
    $config['upload_path']      = './assets/img/upload/invoice';
    $config['allowed_types']    = 'jpg|png';
		$config['file_name']        = "{$createdBy}_invoicelogo";
    $config['overwrite']			  = true;
    $config['max_size']         = 1024 * 5; // 5MB
    // $config['max_width']        = 1024;
    // $config['max_height']       = 768;

    $this->upload->initialize($config);

    if ($this->upload->do_upload('imagefile')) {
      return $this->upload->data("file_name");
    } else {
      return now()."-invoicelogo.png";
    }
  }



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
