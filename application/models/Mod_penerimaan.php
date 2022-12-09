<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Mod_penerimaan extends CI_Model
{
	var $table = 'penerimaan';
	var $column_search = array('faktur'); 
	var $column_order = array('faktur');
	var $order = array('id' => 'desc'); 
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

		private function _get_datatables_query()
	{
		
		$this->db->from('penerimaan');
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
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all()
	{
		$this->db->from('penerimaan');
		return $this->db->count_all_results();
	}

	function insert($table, $data)
    {
        $insert = $this->db->insert($table, $data);
        return $insert;
    }

        function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('penerimaan', $data);
    }

         function update_detail($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('penerimaan_detail', $data);
    }

        function get($id)
    {   
        $this->db->where('id',$id);
        return $this->db->get('penerimaan')->row();
    }

    function get_supplier_all()
    {   
        return $this->db->get('supplier');
    }

     function get_barang_all()
    {   
        return $this->db->get('barang');
    }

    function get_brg($id)
    {   
    	$this->db->like('id', $id);
        return $this->db->get('barang')->result();
    }

     public  function get_supplier($id)
    {   
    	$this->db->like('nama', $id);
    	$this->db->limit(10);
        return $this->db->get('supplier')->result();
    }


      function get_detail($id)
    {   
    	$this->db->select('a.*,b.nama as nama_barang');
        $this->db->where('a.id_penerimaan', $id);
        $this->db->join('barang b', 'a.id_barang=b.id');
        return $this->db->get('penerimaan_detail a')->result();
    }

        function delete($id, $table)
    {
        $this->db->where('id', $id);
        $this->db->delete($table);
    }

            function delete_detail($id, $table)
    {
        $this->db->where('id_penerimaan', $id);
        $this->db->delete($table);
    }

 
}