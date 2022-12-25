<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Mod_stok extends CI_Model
{
	var $table = 'stok_opname';
	var $column_search = array('b.nama'); 
	var $column_order = array('b.nama');
	var $order = array('a.id' => 'desc'); 
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

		private function _get_datatables_query()
	{
		$level = $this->session->userdata['id_level'];
		 $id_gudang = $this->session->userdata['id_gudang'];
		 if ($level!=1) {
			$this->db->where('a.id_gudang', $id_gudang);
		} 
		$this->db->select('a.id,a.nobatch,a.ed,b.nama as nama_barang, sum(a.masuk) as masuk, sum(a.keluar) as keluar, (sum(a.masuk)-sum(a.keluar)) as sisa');
		$this->db->join('barang b', 'a.id_barang=b.id');
		$this->db->group_by('a.id_barang,a.nobatch');
		$this->db->from('stok_opname a');
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
		$level = $this->session->userdata['id_level'];
		 $id_gudang = $this->session->userdata['id_gudang'];
		 if ($level!=1) {
			$this->db->where('a.id_gudang', $id_gudang);
		} 
		$this->db->select('b.nama as nama_barang, sum(a.masuk) as masuk, sum(a.keluar) as keluar, (sum(a.masuk)-sum(a.keluar)) as sisa');
		$this->db->join('barang b', 'a.id_barang=b.id');
		$this->db->group_by('a.id_barang,a.nobatch');
		$this->db->from('stok_opname a');
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
        $this->db->update('stok_opname', $data);
    }

        function get($id)
    {   
    	$level = $this->session->userdata['id_level'];
		 $id_gudang = $this->session->userdata['id_gudang'];
		 if ($level!=1) {
			$this->db->where('id_gudang', $id_gudang);
		} 
        $this->db->where('id',$id);
        return $this->db->get('stok_opname')->row();
    }

        function delete($id, $table)
    {
        $this->db->where('id', $id);
        $this->db->delete($table);
    }

    function get_brg($id)
    {   
    	$level = $this->session->userdata['id_level'];
		 $id_gudang = $this->session->userdata['id_gudang'];
		 if ($level!=1) {
			$this->db->where('id_gudang', $id_gudang);
		} 
		$this->db->select('a.*,b.nama as nama_satuan');
    	$this->db->like('a.id', $id);
    	$this->db->or_like('a.nama', $id);
    	$this->db->join('satuan b', 'a.kemasan=b.id');
    	$this->db->limit(10);
        return $this->db->get('barang a')->result();
    }

        function get_sisa_stok($id_barang,$nobatch)
    {   
    
    	
        $level = $this->session->userdata['id_level'];
         $id_gudang = $this->session->userdata['id_gudang'];
         $and="";
         if ($level!=1) {
            $and = " AND a.id_gudang='$id_gudang'";
        } 
        $date = date("Y-m-d");
        if (!empty($id_barang)) {
    		$andb=" AND id_barang='$id_barang'";
    	}
    	if (!empty($nobatch)) {
    		$and2=" AND nobatch='$nobatch'";
    	}
        $sql=$this->db->query("SELECT * FROM (
            SELECT  SUM(a.`masuk`) AS masuk, SUM(keluar) AS keluar, (SUM(a.`masuk`)-SUM(keluar)) AS sisa, a.ed
            FROM `stok_opname` `a`
            JOIN `barang` `b` ON `a`.`id_barang`=`b`.`id`
            JOIN `satuan` `c` ON `b`.`kemasan`=`c`.`id`
            WHERE 1=1   $and2 $and $andb
        ) AS ab");

        return $sql;
    }
 
}