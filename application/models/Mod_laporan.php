<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Mod_laporan extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}




 	public function get_laporan_pinjam($tglrange='', $id_ruang='')
 	{

 		
 		$date=explode(" - ", $tglrange);
 		$p1=date("Y-m-d", strtotime($date[0]));
 		$p2=date("Y-m-d", strtotime($date[1]));
 		
 		
 		$level = $this->session->userdata['id_level'];
		$id_jurusan = $this->session->userdata['id_jurusan'];

		if (!empty($tglrange)) {
			$this->db->where('date(a.tgl_input) between "'.$p1.'" and "'.$p2.'"');
		}
		
 		if (!empty($id_ruang)) {
 			$this->db->where('b.id_ruang',$id_ruang);
 		}
		if ($level=='6' || $level=='9') {
			$this->db->where('a.id_jurusan',$id_jurusan);
		}
		$this->db->select('a.*,b.nama_alat,b.barcode,c.nama_satuan,d.nama_jabatan,e.kondisi');
		$this->db->join('alat b','a.id_alat=b.id_alat');
		$this->db->join('satuan c','a.id_satuan=c.id');
		$this->db->join('jabatan d', 'a.id_jabatan=d.id_jabatan');
		$this->db->join('kondisi e', 'a.id_kondisi=e.id_kondisi','left');
        return $this->db->get('pengembalian a');
 	}

 	public function get_laporan_pakai($tglrange='')
 	{

 		
 		$date=explode(" - ", $tglrange);
 		$p1=date("Y-m-d", strtotime($date[0]));
 		$p2=date("Y-m-d", strtotime($date[1]));
 		
 		
 		$level = $this->session->userdata['id_level'];
		$id_jurusan = $this->session->userdata['id_jurusan'];

		if (!empty($tglrange)) {
			$this->db->where('date(a.tgl_input) between "'.$p1.'" and "'.$p2.'"');
		}
		
 		
		if ($level=='6' || $level=='9') {
			$this->db->where('a.id_jurusan',$id_jurusan);
		}
		$this->db->select('a.*,b.nama_bahan,b.barcode,c.nama_satuan,d.nama_jabatan');
		$this->db->join('bahan b','a.id_bahan=b.id_bahan');
		$this->db->join('satuan c','a.id_satuan=c.id');
		$this->db->join('jabatan d', 'a.id_jabatan=d.id_jabatan');
        return $this->db->get('pemakaian_bahan a');
 	}

 		public function get_laporan_kerusakan_alat($tglrange='')
 	{

 		
 		$date=explode(" - ", $tglrange);
 		$p1=date("Y-m-d", strtotime($date[0]));
 		$p2=date("Y-m-d", strtotime($date[1]));
 		
 		
 		$level = $this->session->userdata['id_level'];
		$id_jurusan = $this->session->userdata['id_jurusan'];

		if (!empty($tglrange)) {
			$this->db->where('date(a.tgl_input) between "'.$p1.'" and "'.$p2.'"');
		}
		
 		
		if ($level=='6' || $level=='9') {
			$this->db->where('a.id_jurusan',$id_jurusan);
		}
		$this->db->select('a.*,b.nama_alat,b.barcode,c.nama_satuan,f.kondisi');
		$this->db->join('alat b','a.id_alat=b.id_alat');
		$this->db->join('satuan c','a.id_satuan=c.id');
		$this->db->join('kondisi f', 'a.id_kondisi=f.id_kondisi');
        return $this->db->get('kerusakan_alat a');
 	}


 		public function get_laporan_kerusakan_bahan($tglrange='')
 	{

 		
 		$date=explode(" - ", $tglrange);
 		$p1=date("Y-m-d", strtotime($date[0]));
 		$p2=date("Y-m-d", strtotime($date[1]));
 		
 		
 		$level = $this->session->userdata['id_level'];
		$id_jurusan = $this->session->userdata['id_jurusan'];

		if (!empty($tglrange)) {
			$this->db->where('date(a.tgl_input) between "'.$p1.'" and "'.$p2.'"');
		}
		
 		
		if ($level=='6' || $level=='9') {
			$this->db->where('a.id_jurusan',$id_jurusan);
		}
		$this->db->select('a.*,b.nama_bahan,b.barcode,c.nama_satuan,f.kondisi');
		$this->db->join('bahan b','a.id_bahan=b.id_bahan');
		$this->db->join('satuan c','a.id_satuan=c.id');
		$this->db->join('kondisi f', 'a.id_kondisi=f.id_kondisi');
        return $this->db->get('kerusakan_bahan a');
 	}
 }