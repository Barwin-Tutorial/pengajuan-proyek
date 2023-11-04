<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_dashboard extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	

	function get_akses_menu($link,$level)
	{
		
		$this->db->where('a.id_level',$level);
		$this->db->where('b.link',$link);
		$this->db->join('tbl_menu b','b.id_menu=a.id_menu');
		return $this->db->get('tbl_akses_menu a');
	}

	function get_akses_submenu($link,$level)
	{
		
		$this->db->where('a.id_level',$level);
		$this->db->where('b.link',$link);
		$this->db->join('tbl_submenu b','b.id_submenu=a.id_submenu');
		return $this->db->get('tbl_akses_submenu a');
	}

	function total_dokumentasi()
	{
		$this->db->from('tbl_dokumen');
		return $this->db->count_all_results();
	}

	function belum_acc()
	{
		$this->db->where('status','1');
		$this->db->from('tbl_dokumen');
		return $this->db->count_all_results();
	}

	function total_acc()
	{
		$this->db->where('status','2');
		$this->db->from('tbl_dokumen');
		return $this->db->count_all_results();
	}

	function total_tolak()
	{
		$this->db->where('status','3');
		$this->db->from('tbl_dokumen');
		return $this->db->count_all_results();
	}
	function total_anggaran()
	{
		$this->db->where('upload1 is not null');
		$this->db->from('tbl_dokumen');
		return $this->db->count_all_results();
	}
	function total_laporan() {
		// Menghitung tanggal satu bulan sebelum hari ini
		$startDate = date('Y-m-d', strtotime('-1 month'));
	
		// Menghitung tanggal hari ini
		$endDate = date('Y-m-d');
	
		$this->db->select('COUNT(*) as total');
		$this->db->from('tbl_dokumen');
		$this->db->where('upload1 IS NOT NULL');
		$this->db->where("tgl_input >= '$startDate'");
		$this->db->where("tgl_diajukan <= '$endDate'");
		$query = $this->db->get();
	
		$result = $query->row();
		return $result->total;

	}
	
}