<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Mod_alat extends CI_Model
{
	var $table = 'alat';
	var $column_search = array('nama_alat'); 
	var $column_order = array('nama_alat');
	var $order = array('id_alat' => 'desc'); 
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
		$this->db->select('a.*,c.nama_satuan,d.kondisi,e.nama_ruang');
		$this->db->join('satuan c','a.id_satuan=c.id');
		$this->db->join('kondisi d','a.id_kondisi=d.id_kondisi');
		$this->db->join('ruang e','a.id_ruang=e.id_ruang');
		$this->db->from('alat a');
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
	
		$this->db->join('satuan c','a.id_satuan=c.id');
		$this->db->join('kondisi d','a.id_kondisi=d.id_kondisi');
		$this->db->join('ruang e','a.id_ruang=e.id_ruang');
		$this->db->from('alat a');
		return $this->db->count_all_results();
	}

	function insert($table, $data)
    {
        $insert = $this->db->insert($table, $data);
        return $insert;
    }

        function update($id, $data)
    {
        $this->db->where('id_alat', $id);
        $this->db->update('alat', $data);
    }

        function get($id)
    {   
        $this->db->where('id_alat',$id);
        return $this->db->get('alat')->row();
    }

        function delete($id, $table)
    {
        $this->db->where('id_alat', $id);
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
		return $this->db->get('alat')->result_array();
	}

	  function getImage($id)
    {
        $this->db->select('photo');
        $this->db->where('id_alat', $id);
        return $this->db->get('alat');
    }
}