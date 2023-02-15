<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Mod_bahan extends CI_Model
{
	var $table = 'bahan';
	var $column_search = array('nama_bahan'); 
	var $column_order = array('nama_bahan');
	var $order = array('id_bahan' => 'desc'); 
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
		$this->db->select('a.*,b.nama_merk,c.nama_satuan');
		$this->db->join('merk b','a.id_merk=b.id_merk');
		$this->db->join('satuan c','a.id_satuan=c.id');
		$this->db->from('bahan a');
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
		if ($level=='6' || $level=='9') {
			$this->db->where('a.id_jurusan',$id_jurusan);
		}
		$this->db->select('a.*,b.nama_merk,c.nama_satuan');
		$this->db->join('merk b','a.id_merk=b.id_merk');
		$this->db->join('satuan c','a.id_satuan=c.id');
		$this->db->from('bahan a');
		return $this->db->count_all_results();
	}

	function insert($table, $data)
	{
		$insert = $this->db->insert($table, $data);
		return $insert;
	}

	function update($id, $data)
	{
		$this->db->where('id_bahan', $id);
		$this->db->update('bahan', $data);
	}

	function get($id)
	{   
		$this->db->select('a.*,b.nama_satuan,c.nama_merk');
		$this->db->where('id_bahan',$id);
		$this->db->join('satuan b', 'a.id_satuan=b.id','left');
		$this->db->join('merk c', 'a.id_merk=c.id_merk','left');
		return $this->db->get('bahan a')->row();
	}

	function delete($id, $table)
	{
		$this->db->where('id_bahan', $id);
		$this->db->delete($table);
	}

	function max_no($id_jurusan)
	{
		$m=date("m");
		$y=date("Y");
		$this->db->select('MAX(SUBSTR(barcode,-4)) AS kode');
		$this->db->order_by('barcode','desc');
		$this->db->where('MONTH(tgl_input)',$m);
		$this->db->where('YEAR(tgl_input)',$y);
		$this->db->where('id_jurusan', $id_jurusan);
		return $this->db->get('bahan')->result_array();
	}

	function getImage($id)
    {
        $this->db->select('photo,barcode');
        $this->db->where('id_bahan', $id);
        return $this->db->get('bahan');
    }
}