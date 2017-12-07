<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		if(!$this->session->userdata('isLogin'))
        { 
            redirect(site_url('welcome'));
            exit();
        }
	}

	public function lap_masuk(){
		$sql = "SELECT supl.nama as nama_suplier, brg.nama as nama_barang, brg.harga, msk.* 
				FROM tb_barang_masuk msk
				JOIN tb_suplier supl on supl.id_suplier= msk.id_suplier
				JOIN tb_barang brg on brg.kode_barang= msk.kode_barang";
		$data['b_masuk']=$this->db->query($sql)->result();
		$this->template->set_layout('backend')
						->title('Admin - Laporan Barang Masuk')
						->build('v_lap_masuk', $data);		
	}

	public function lap_keluar(){
		$sql = "SELECT b.nama as nama_barang, a.* 
				FROM tb_barang b
				JOIN tb_barang_keluar a 
				on b.kode_barang=a.kode_barang";
		$data['b_keluar']=$this->db->query($sql)->result();
		$this->template->set_layout('backend')
						->title('Admin - Laporan Barang Keluar')
						->build('v_lap_keluar', $data);		
	}

	public function lap_stock(){
		$sql = "SELECT b.nama as nama_barang, a.* 
				FROM tb_barang b
				JOIN tb_safety_stock a 
				on b.kode_barang=a.id_barang";
		$data['b_stock']=$this->db->query($sql)->result();
		$this->template->set_layout('backend')
						->title('Admin - Laporan Safety Stock')
						->build('v_lap_stock', $data);		
	}


	function cetak_laporan_masuk(){
		// html
		$sql = "SELECT supl.nama as nama_suplier, brg.nama as nama_barang, brg.harga, msk.* 
				FROM tb_barang_masuk msk
				JOIN tb_suplier supl on supl.id_suplier= msk.id_suplier
				JOIN tb_barang brg on brg.kode_barang= msk.kode_barang";
		$b_masuk=$this->db->query($sql)->result();

		// $img = $_SERVER["DOCUMENT_ROOT"].'/assets/img/member1.png';
		$html ='
		<html>
		<head>
		    <link rel="stylesheet" href='.base_url("assets/vendor/bootstrap/css/bootstrap.min.css").'>
		    <link rel="stylesheet" href='.base_url("assets/vendor/font-awesome/css/font-awesome.min.css").'>
		    <link rel="stylesheet" href='.base_url("assets/vendor/linearicons/style.css").'>
		    <link rel="stylesheet" href='.base_url("assets/css/main.css").'>
			<title></title>
		</head>
		<body style="background-color:transparent;">
		<div class="row">
			<div class="col-md-4">
				<h5 style="font-size:10px;">Tanggal cetak :'.date('m-d-Y').' </h5>
			</div>
			<div class="col-md-8">
				<h3 style="text-align:center"> Laporan Barang Masuk UD. Gangster</h3>
			</div>
		</div>
			<table class="table table-stripped" style="font-size:8px;">
				<thead>
					<tr>
					<th> No. </th>
					<th> No. Nota </th>
					<th> Kode Barang </th>
					<th> Barang</th>
					<th> Suplier</th>
					<th> Harga(Rp.)</th>
					<th> Jumlah </th>
					<th> Total(Rp.)</th>
					<th> Tanggal  </th>
					</tr>
				</thead>
				<tbody>';
				$html.= $no=1; foreach ($b_masuk as $val)
				$html.=
				'{ <tr>
					<td>'.$no++.'</td>
					<td>'.$val->id_transaksi.'</td>
					<td>'.$val->kode_barang.'</td>
					<td>'.$val->nama_barang.'</td>
					<td>'.$val->nama_suplier.'</td>
					<td>Rp. '.number_format($val->harga, 2,',','.').'</td>
					<td>'.$val->jumlah.'</td>
					<td>Rp. '.number_format($val->total_harga, 2,',','.').'</td>
					<td>'.$val->tanggal.'</td>
				</tr>}';
				$html.='
						</tbody>
					</table>			
					</body>
				</html>
			    <script src='.base_url("assets/vendor/bootstrap/js/bootstrap.min.js").'</script>
				';

		$filename = 'Laporan_barang_masuk';
		$filename.='_'.date("Y_m_d");
		$this->load->library('pdfgenerator');
        $this->pdfgenerator->generate($html, $filename);
	}

	function cetak_laporan_keluar(){
		// html
		$sql = "SELECT b.nama as nama_barang, a.* 
				FROM tb_barang b
				JOIN tb_barang_keluar a 
				on b.kode_barang=a.kode_barang";
		$keluar=$this->db->query($sql)->result();

		// $img = $_SERVER["DOCUMENT_ROOT"].'/assets/img/member1.png';
		$html ='
		<html>
		<head>
		    <link rel="stylesheet" href='.base_url("assets/vendor/bootstrap/css/bootstrap.min.css").'>
		    <link rel="stylesheet" href='.base_url("assets/vendor/font-awesome/css/font-awesome.min.css").'>
		    <link rel="stylesheet" href='.base_url("assets/vendor/linearicons/style.css").'>
		    <link rel="stylesheet" href='.base_url("assets/css/main.css").'>
			<title></title>
		</head>
		<body style="background-color:transparent;">
		<div class="row">
			<div class="col-md-4">
				<h5 style="font-size:10px;">Tanggal cetak :'.date('m-d-Y').' </h5>
			</div>
			<div class="col-md-8">
				<h3 style="text-align:center"> Laporan Barang Keluar UD. Gangster</h3>
			</div>
		</div>
			<table class="table table-stripped" style="font-size:8px;">
				<thead>
					<tr>
					<th> No. </th>
					<th> No. Nota </th>
					<th> Kode Barang </th>
					<th> Barang</th>
					<th> Jumlah</th>
					<th> Keterangan</th>
					<th> Tanggal  </th>
					</tr>
				</thead>
				<tbody>';
				$html.= $no=1; foreach ($keluar as $val)
				$html.=
				'{ <tr>
					<td>'.$no++.'</td>
					<td>'.$val->id_transaksi.'</td>
					<td>'.$val->kode_barang.'</td>
					<td>'.$val->nama_barang.'</td>
					<td>'.$val->jumlah_Stok.'</td>
					<td>'.$val->keterangan.'</td>
					<td>'.$val->tanggal.'</td>
				</tr>}';
				$html.='
						</tbody>
					</table>			
					</body>
				</html>
			    <script src='.base_url("assets/vendor/bootstrap/js/bootstrap.min.js").'</script>
				';

		$filename = 'Laporan_barang_keluar';
		$filename.='_'.date("Y_m_d");
		$this->load->library('pdfgenerator');
        $this->pdfgenerator->generate($html, $filename);
	}

	function cetak_laporan_safety(){
		// html
		$sql = "SELECT b.nama as nama_barang, a.* 
				FROM tb_barang b
				JOIN tb_safety_stock a 
				on b.kode_barang=a.id_barang";
		$safety=$this->db->query($sql)->result();

		// $img = $_SERVER["DOCUMENT_ROOT"].'/assets/img/member1.png';
		$html ='
		<html>
		<head>
		    <link rel="stylesheet" href='.base_url("assets/vendor/bootstrap/css/bootstrap.min.css").'>
		    <link rel="stylesheet" href='.base_url("assets/vendor/font-awesome/css/font-awesome.min.css").'>
		    <link rel="stylesheet" href='.base_url("assets/vendor/linearicons/style.css").'>
		    <link rel="stylesheet" href='.base_url("assets/css/main.css").'>
			<title></title>
		</head>
		<body style="background-color:transparent;">
		<div class="row">
			<div class="col-md-4">
				<h5 style="font-size:10px;">Tanggal cetak :'.date('m-d-Y').' </h5>
			</div>
			<div class="col-md-8">
				<h3 style="text-align:center"> Laporan Safety Stok UD. Gangster</h3>
			</div>
		</div>
			<table class="table table-stripped" style="font-size:8px;">
				<thead>
					<tr>
					<th> No. </th>
					<th> Kode Barang </th>
					<th> Barang</th>
					<th> Jumlah</th>
					<th> Stok Aman</th>
					<th> Stok warning</th>
					</tr>
				</thead>
				<tbody>';
				$html.= $no=1; foreach ($safety as $val)
				$html.=
				'{ <tr>
					<td>'.$no++.'</td>
					<td>'.$val->id_barang.'</td>
					<td>'.$val->nama_barang.'</td>
					<td>'.$val->stok.'</td>
					<td>'.$val->stok_aman.'</td>
					<td>'.$val->stok_warning.'</td>
				</tr>}';
				$html.='
						</tbody>
					</table>			
					</body>
				</html>
			    <script src='.base_url("assets/vendor/bootstrap/js/bootstrap.min.js").'</script>
				';

		$filename = 'Laporan_safety_stok';
		$filename.='_'.date("Y_m_d");
		$this->load->library('pdfgenerator');
        $this->pdfgenerator->generate($html, $filename);
	}

}

/* End of file Home.php */
/* Location: ./application/modules/welcome/controllers/Home.php */