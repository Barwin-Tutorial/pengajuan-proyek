<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Mod_peminjaman extends CI_Model
{
	var $table = 'peminjaman';
	var $column_search = array('a.nama','b.nama_alat','c.nama_satuan','d.nama_jabatan','f.kondisi'); 
	var $column_order = array('a.nama','b.nama_alat','c.nama_satuan','d.nama_jabatan','f.kondisi');
	var $order = array('id_peminjaman' => 'desc'); 
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$level = $this->session->userdata['id_level'];
		$id_jurusan = $this->session->userdata['id_jurusan'];
		if ($level=='6' || $level=='9') {
			$this->db->where('a.id_jurusan',$id_jurusan);
		}
		$this->db->select('a.*,b.nama_alat,c.nama_satuan,d.nama_jabatan,f.kondisi');
		$this->db->join('alat b','a.id_alat=b.id_alat', 'left');
		$this->db->join('satuan c','a.id_satuan=c.id', 'left');
		$this->db->join('jabatan d', 'a.id_jabatan=d.id_jabatan', 'left');
		// $this->db->join('guru e', 'a.id_guru=e.id_guru');
		$this->db->join('kondisi f', 'a.id_kondisi=f.id_kondisi', 'left');
		$this->db->from('peminjaman a');
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
		$id_jurusan = $this->session->userdata['id_jurusan'];
		if ($level=='6') {
			$this->db->where('a.id_jurusan',$id_jurusan);
		}
		$this->db->join('alat b','a.id_alat=b.id_alat', 'left');
		$this->db->join('satuan c','a.id_satuan=c.id', 'left');
		$this->db->join('jabatan d', 'a.id_jabatan=d.id_jabatan', 'left');
		// $this->db->join('guru e', 'a.id_guru=e.id_guru');
		$this->db->from('peminjaman a');
		return $this->db->count_all_results();
	}

	function insert($table, $data)
	{
		$insert = $this->db->insert($table, $data);
		return $insert;
	}

	function update($id, $data)
	{
		$this->db->where('id_peminjaman', $id);
		$this->db->update('peminjaman', $data);
	}

	function get($id)
	{   
		$this->db->where('id_peminjaman',$id);
		return $this->db->get('peminjaman')->row();
	}

	function delete($id, $table)
	{
		$this->db->where('id_peminjaman', $id);
		$this->db->delete($table);
	}

	   function getImage($id)
    {
        $this->db->select('foto');
        $this->db->where('id_peminjaman', $id);
        return $this->db->get('peminjaman');
    }
}