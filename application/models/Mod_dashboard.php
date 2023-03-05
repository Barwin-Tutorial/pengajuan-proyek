<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create BY : Aryo
 * Youtube : Aryo Coding
 */
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

	function jml_alat()
	{
		$level = $this->session->userdata['id_level'];
		$id_jurusan = $this->session->userdata['id_jurusan'];
		if ($level=='6' || $level=='9') {
			$this->db->where('id_jurusan',$id_jurusan);
		}
		
		$this->db->from('alat');
		return $this->db->count_all_results();
	}

	function jml_bahan()
	{
		$level = $this->session->userdata['id_level'];
		$id_jurusan = $this->session->userdata['id_jurusan'];
		if ($level=='6' || $level=='9') {
			$this->db->where('id_jurusan',$id_jurusan);
		}
		
		$this->db->from('bahan');
		return $this->db->count_all_results();
	}

	function jml_pinjam()
	{
		$level = $this->session->userdata['id_level'];
		$id_jurusan = $this->session->userdata['id_jurusan'];
		if ($level=='6' || $level=='9') {
			$this->db->where('id_jurusan',$id_jurusan);
		}
		
		$this->db->from('peminjaman');
		return $this->db->count_all_results();
	}

	function jml_pemakai_bahan()
	{
		$level = $this->session->userdata['id_level'];
		$id_jurusan = $this->session->userdata['id_jurusan'];
		if ($level=='6' || $level=='9') {
			$this->db->where('id_jurusan',$id_jurusan);
		}
		
		$this->db->from('pemakaian_bahan');
		return $this->db->count_all_results();
	}
	
		function jml_rusak()
	{
		$level = $this->session->userdata['id_level'];
		$id_jurusan = $this->session->userdata['id_jurusan'];
		if ($level=='6' || $level=='9') {
			$this->db->where('id_jurusan',$id_jurusan);
		}
		
		$this->db->from('kerusakan_alat');
		return $this->db->count_all_results();
	}
	function jml_perbaikan()
	{
		$level = $this->session->userdata['id_level'];
		$id_jurusan = $this->session->userdata['id_jurusan'];
		if ($level=='6' || $level=='9') {
			$this->db->where('id_jurusan',$id_jurusan);
		}
		
		$this->db->from('perbaikan_alat');
		return $this->db->count_all_results();
	}
}