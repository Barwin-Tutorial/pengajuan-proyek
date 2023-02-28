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




 	public function get_laporan_projek($tglrange)
 	{

 		
 		$date=explode(" - ", $tglrange);
 		$p1=date("Y-m-d", strtotime($date[0]));
 		$p2=date("Y-m-d", strtotime($date[1]));
 		
 		if (!empty($tglrange)) {
 			$this->db->where('date(tgl_input) between "'.$p1.'" and "'.$p2.'"');
 		}
        return $this->db->get('tbl_projek');
 	}



 }