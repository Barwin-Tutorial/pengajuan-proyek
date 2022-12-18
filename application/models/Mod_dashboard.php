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

	function JmlUser()
	{
		$this->db->from('tbl_user');
		return $this->db->count_all_results();
	}
	
	function Jmlbarang()
	{
		$level = $this->session->userdata['id_level'];
		$id_gudang = $this->session->userdata['id_gudang'];
		if ($level!=1) {
			$this->db->where('id_gudang', $id_gudang);
		} 
		$this->db->from('barang');
		return $this->db->count_all_results();
	}

	function Jmlmasuk()
	{
		$level = $this->session->userdata['id_level'];
		$id_gudang = $this->session->userdata['id_gudang'];
		if ($level!=1) {
			$this->db->where('id_gudang', $id_gudang);
		} 
		$this->db->select('SUM(masuk) as total');
		$this->db->from('stok_opname');
		return $this->db->get()->row();
	}

	function Jmlkeluar()
	{
		$level = $this->session->userdata['id_level'];
		$id_gudang = $this->session->userdata['id_gudang'];
		if ($level!=1) {
			$this->db->where('id_gudang', $id_gudang);
		} 
		$this->db->select('SUM(keluar) as total');
		$this->db->from('stok_opname');
		return $this->db->get()->row();
	}


	function terlaris($id, $tgl)
	{

		$level = $this->session->userdata['id_level'];
		$id_gudang = $this->session->userdata['id_gudang'];
		$and="";
		if ($level==1) {
			$and .= " AND b.id_gudang='$id_gudang'";
		} 
		if (!empty($id)) {
			$and .= " AND b.`perundangan`='$id'";
		}

		$sql=$this->db->query("SELECT b.`nama` , COUNT(a.id_barang) AS total FROM keluar_detail a 
			JOIN barang b ON a.`id_barang`=b.`id`
			JOIN keluar c ON a.`id_keluar`=c.`id` WHERE 1=1 $and AND c.`tanggal`='$tgl' GROUP BY a.`id_barang` ORDER BY total LIMIT 10 ");
		return $sql;
	}

	function chart_pelanggan($tgl)
	{
		$level = $this->session->userdata['id_level'];
		$id_gudang = $this->session->userdata['id_gudang'];
		$and="";
		if ($level!=1) {
			$and= ' AND b.id_gudang=$id_gudang ';
		} 
		$sql=$this->db->query("SELECT c.`nama`, COUNT(b.id_pelanggan) AS total FROM keluar_detail a 
			JOIN keluar b ON a.`id_keluar`=b.`id`
			JOIN pelanggan c ON b.`id_pelanggan`=c.`id` WHERE 1=1  AND b.`tanggal`='$tgl' $and GROUP BY b.`id_pelanggan` ORDER BY total LIMIT 10  ");
		return $sql;
	}

}