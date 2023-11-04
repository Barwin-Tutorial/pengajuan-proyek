<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Mod_dokumen extends CI_Model
{
	var $table = 'tbl_dokumen';
	var $column_search = array('judul'); 
	var $column_order = array('judul','upload','keterangan');
	var $order = array('id_dokumen' => 'desc'); 
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$this->db->select('a.*,b.full_name as user_upload,c.full_name as pengaju, d.full_name as setuju');
		$this->db->join('tbl_user d','a.user_setuju=d.id_user','left');
		$this->db->join('tbl_user c','a.user_pengaju=c.id_user','left');
		$this->db->join('tbl_user b','a.user_input=b.id_user','left');
		$this->db->from('tbl_dokumen a');
		$i = 0;

	foreach ($this->column_search as $item) // loop column 
	{
	if($_POST['search']['value']) // if datatable send POST for search
	{

	if($i===0) // first loop
	{
	$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
	$this->db->like($item, $_POST['search']['value']);
}
else
{
	$this->db->or_like($item, $_POST['search']['value']);
}

		if(count($this->column_search) - 1 == $i) //last loop
		$this->db->group_end(); //close bracket
	}
	$i++;
}

		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get()->result();
		return count($query);
	}

	function count_all()
	{

		$this->db->from('tbl_dokumen');
		return $this->db->count_all_results();
	}

	function getAll()
	{
		return $this->db->get('tbl_dokumen');
	}

	function insert($table, $data)
	{
		$insert = $this->db->insert('tbl_dokumen', $data);
		return $insert;
	}

	function update($id, $data)
	{
		$this->db->where('id_dokumen', $id);
		$this->db->update('tbl_dokumen', $data);
	}

	function get($id)
	{   
		$this->db->where('id_dokumen',$id);
		return $this->db->get('tbl_dokumen')->row();
	}

	function delete($id, $table)
	{
		$this->db->where('id_dokumen', $id);
		$this->db->delete('tbl_dokumen');
	}

	function get_file_name($id='')
	{
		$this->db->select('upload');
		$this->db->from('tbl_dokumen');
		$this->db->where('id_dokumen', $id);
		return $this->db->get();
	}

	public function get_laporan($tglrange)
	{

		$date=explode(" - ", $tglrange);
		$p1=date("Y-m-d", strtotime($date[0]));
		$p2=date("Y-m-d", strtotime($date[1]));
		
		
		$level = $this->session->userdata['id_level'];
		$this->db->where('date(a.tgl_input) between "'.$p1.'" and "'.$p2.'"');
		$this->db->select('a.*,b.full_name as user_upload,c.full_name as pengaju, d.full_name as setuju');
		$this->db->join('tbl_user d','a.user_setuju=d.id_user','left');
		$this->db->join('tbl_user c','a.user_pengaju=c.id_user','left');
		$this->db->join('tbl_user b','a.user_input=b.id_user','left');
		return $this->db->get('tbl_dokumen a');
	}
	
}