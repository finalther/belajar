<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends MX_Controller {

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

	public function index()
	{
		$this->template->set_layout('backend')
						->title('Home - Klorofil')
						->build('index');
	}

	public function master(){
		$data['barang']=$this->m_global->fetch('tb_barang')->result();
		$this->template->set_layout('backend')
						->title('Admin - Master Barang')
						->build('v_master_barang', $data);		
	}

	function autonumber($kode, $query){
		  $tahun = date("Y");
		  $bulan = date("m");
		  $hari = date("d");
		  $row = $query->row_array();
		  $max_id = $row['max_id']; 
		  $max_id1 =(int) substr($max_id,11,5);
		  
		  if($max_id1 == 99999)
		  	$max_id1 = 0;
		  else
		  	$max_id1 = $max_id1;
		  
		  $counter = $max_id1 + 1;
		  
		  $autonumber = $kode.$tahun.$bulan.$hari.sprintf("%05s",$counter);
		  return $autonumber;
	}

	public function add()
	{
		$this->template->set_layout('backend')
						->title('Admin - Tambah Barang')
						->build('v_add_master');

		if(isset($_POST['simpan_master'])){
		    $q_numb = $this->db->query("SELECT MAX(kode_barang) as max_id FROM tb_barang"); 
			$kode = $this->autonumber('BRG',$q_numb);
			$nama = $_POST['nama_barang'];
			$harga_pre = $_POST['harga'];
			$satuan = $_POST['satuan'];		
	        $harga  = preg_replace('/[^0-9]/','',$harga_pre);
			$data = array(
					'kode_barang'=>$kode,
					'nama'=>$nama,
					'harga'=>$harga,
					'satuan'=>$satuan
			);
			$this->m_global->store('tb_barang', $data);	 
			$this->m_global->store('tb_safety_stock', array('id_barang'=>$kode));	 
			$type="success";
			$message="Data Berhasil Ditambah";
			$this->session->set_flashdata(array('type'=>$type,'message'=>$message));
			redirect(base_url('barang/add'));
		}
	}

	public function set_safety(){
		$data['result_barang'] = $this->db->query("SELECT b.nama, s.* FROM tb_barang b, tb_safety_stock s WHERE b.kode_barang=s.id_barang")->result();
		$this->template->set_layout('backend')
						->title('Admin - Set safetu Stok')
						->build('v_master_stock', $data);

		if(isset($_POST['safetystock'])){
			$id_barang = $this->input->post('id_barang');
			$stok_aman = $this->input->post('stok_aman');
			$stok_warning = $this->input->post('stok_warning');

			$data = array(
				'stok_aman' => $stok_aman,
				'stok_warning' => $stok_warning
			);
			$this->m_global->update('tb_safety_stock', $data, array('id_barang'=>$id_barang));
			$type="success";
			$message="Set Stok Berhasil Disimpan";
			$this->session->set_flashdata(array('type'=>$type,'message'=>$message));
			redirect(base_url('barang/set_safety'));

		}
	}

	public function search_barang($id){	
		$result = $this->m_global->fetch('tb_safety_stock', array('id_barang'=>$id))->row();
		$stok = $result->stok;
		$stok_aman = $result->stok_aman;
		$stok_warning = $result->stok_warning;
		
		echo json_encode(array('stok'=>$stok, 'stok_aman'=>$stok_aman, 'stok_warning'=>$stok_warning));		

	}

	public function add_supplier(){
		$this->template->set_layout('backend')
						->title('Admin - Add suplier')
						->build('v_add_suplier');
		if(isset($_POST['savesuplier'])){
			$q_numb = $this->db->query("SELECT MAX(id_suplier) as max_id FROM tb_suplier"); 
			$kode = $this->autonumber('SUP',$q_numb);

			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$telp = $this->input->post('telp');

			$data = array(
				'nama'=>$nama,
				'id_suplier'=>$kode,
				'alamat'=>$alamat,
				'telp'=>$telp
			);
			$this->m_global->store('tb_suplier',$data);
			$type="success";
			$message="Data Suplier Berhasil Disimpan";
			$this->session->set_flashdata(array('type'=>$type,'message'=>$message));
			redirect(base_url('barang/add_supplier'));
		}
	}


	public function barang_masuk(){
			$data['suplier'] = $this->m_global->fetch('tb_suplier')->result();
			$data['barang'] = $this->m_global->fetch('tb_barang')->result();
			$this->template->set_layout('backend')
						->title('Admin - Barang Masuk')
						->build('v_barang_masuk', $data);

			if(isset($_POST['proses_masuk'])){
				$q_numb = $this->db->query("SELECT MAX(id_transaksi) as max_id FROM tb_barang_masuk"); 
				$nota = $this->autonumber('TRM',$q_numb);
	
				$tanggal = $this->input->post('tanggal');
				$id_suplier = $this->input->post('id_suplier');
				$id_barang = $this->input->post('id_barang');
				$harga_pre = $this->input->post('harga');
				$tot_pre = $this->input->post('total_harga');
				$jumlah = $this->input->post('jumlah');
				$keterangan = $this->input->post('keterangan');
		        $harga       = preg_replace('/[^0-9]/','',$harga_pre);
		        $tot       = preg_replace('/[^0-9]/','',$tot_pre);

				$data = array(
					'id_transaksi' =>$nota,
					'tanggal'=>$tanggal,
					'id_suplier'=>$id_suplier,
					'kode_barang'=>$id_barang,
					'keterangan'=>$keterangan,
					'jumlah' =>$jumlah,
					'harga'=>$harga,
					'total_harga'=>$tot
				);
				$st = $this->m_global->fetch('tb_safety_stock', array('id_barang'=>$id_barang))->row();
				$stk = $st->stok;
				$snow = $stk+$jumlah;
				$this->m_global->store('tb_barang_masuk', $data);
				$this->m_global->update('tb_safety_stock', array('stok'=>$snow),array('id_barang'=>$id_barang));
				$type="success";
				$message="Barang Berhasil Disimpan";
				$this->session->set_flashdata(array('type'=>$type,'message'=>$message));
				redirect(base_url('barang/barang_masuk'));
			}
	}

	public function get_suplier($id){
		$data = $this->m_global->fetch('tb_suplier', array('id_suplier'=>$id))->row();
		$nama = $data->nama;

		echo json_encode(array('nama'=>$nama));
	}

	public function get_barang($id){
		$data = $this->m_global->fetch('tb_barang', array('kode_barang'=>$id))->row();
		$nama = $data->nama;
		$harga = $data->harga;	

		$data_return = array('nama'=>$nama, 'harga'=>$harga);
		echo json_encode($data_return);
	}

	public function barang_keluar(){
			$data['barang'] = $this->db->query("SELECT a.nama , b.* FROM tb_barang a, tb_safety_stock b WHERE a.kode_barang=b.id_barang")->result();
			$this->template->set_layout('backend')
						->title('Admin - Barang Keluar')
						->build('v_barang_keluar', $data);
			if(isset($_POST['proses_keluar'])){
				$q_numb = $this->db->query("SELECT MAX(id_transaksi) as max_id FROM tb_barang_keluar"); 
				$nota = $this->autonumber('TRK',$q_numb);

				$id = $this->input->post('id_barang');
				$tanggal = $this->input->post('tanggal');
				$keterangan = $this->input->post('keterangan');
				$jumlah = $this->input->post('jumlah');

				$cek = $this->m_global->fetch('tb_safety_stock', array('id_barang'=>$id))->row();
				$stok_now=$cek->stok;

				$danger=$stok_now-$jumlah;
				if($danger<=$cek->stok_warning){
				$type="error";
				$message="Stok Melebihi Batas";
				$this->session->set_flashdata(array('type'=>$type,'message'=>$message));
				redirect(base_url('barang/barang_keluar'));

				}else{
					$data_update = array(
						'stok'=>$stok_now - $jumlah
					);
					$this->m_global->update('tb_safety_stock', $data_update, array('id_barang'=>$id));
				
				$data = array(
					'id_transaksi'=>$nota,
					'kode_barang'=>$id,
					'tanggal'=>$tanggal,
					'jumlah_Stok'=>$jumlah,
					'keterangan'=>$keterangan
				);
				$this->m_global->store('tb_barang_keluar', $data);
					$type="success";
					$message="Stok Berhasil Dikeluarkan";
					$this->session->set_flashdata(array('type'=>$type,'message'=>$message));
					redirect(base_url('barang/barang_keluar'));
				}

			}
	}

	public function get_stok($id){
		$data = $this->m_global->fetch('tb_safety_stock', array('id_barang'=>$id))->row();
		$stok = $data->stok;
		echo json_encode(array('stok'=>$stok));
	}

	public function hapus($id){
		$this->m_global->destroy('tb_barang', array('kode_barang'=>$id));
		$message="Barang Berhasil Dihapus";
		$type="success";
		$this->session->set_flashdata(array('type'=>$type,'message'=>$message));
		redirect(base_url('barang/master'));
	}

	function test(){
		echo "ini tes ";
	}

	function test2(){
		
	}

}

/* End of file Home.php */
/* Location: ./application/modules/welcome/controllers/Home.php */