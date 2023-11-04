<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Mod_pengajuan extends CI_Model
{
	var $table = 'tbl_dokumen';
	var $column_search = array('judul'); 
	var $column_order = array('judul','upload','upload1','keterangan');
	var $order = array('id_dokumen' => 'desc'); 
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

		private function _get_datatables_query()
	{
		$level = $this->session->userdata['id_level'];
		if ($level=='10') {
			// Status 2 berarti disetujui
			$this->db->where('a.status','2');
		}elseif ($level=='9') {
			// Status 1 upload pengajuan anggaran
			$this->db->where('a.status >= 1');
		}
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
		$level = $this->session->userdata['id_level'];
		if ($level=='10') {
			// Status 2 berarti disetujui
			$this->db->where('status','2');
		}elseif ($level=='9') {
			// Status 1 pengajuan anggaran dan upload
			$this->db->where('status >= 1');
		}
		
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
    	$this->db->select('upload1');
        $this->db->from('tbl_dokumen');
        $this->db->where('id_dokumen', $id);
        return $this->db->get();
    }
 
}