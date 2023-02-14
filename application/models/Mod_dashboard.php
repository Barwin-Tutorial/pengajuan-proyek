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


}