<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Mod_keluar extends CI_Model
{
	var $table = 'keluar';
	var $column_search = array('nama'); 
	var $column_order = array('nama');
	var $order = array('id' => 'desc'); 
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
		$this->db->select('a.*,b.nama as nama_pel, d.nama as nama_barang,c.jumlah');
		$this->db->join('pelanggan b', 'a.id_pelanggan=b.id');
		$this->db->join('keluar_detail c', 'a.id=c.id_keluar');
		$this->db->join('barang d', 'c.id_barang=d.id');
		$this->db->from('keluar a');
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
		$this->db->select('a.*,b.nama as nama_pel');
		$this->db->join('pelanggan b', 'a.id_pelanggan=b.id');
		$this->db->join('keluar_detail c', 'a.id=c.id_keluar');
		$this->db->join('barang d', 'c.id_barang=d.id');
		$this->db->from('keluar a');
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
        $this->db->update('keluar', $data);
    }

       function update_stok_opname($id, $data)
    {
        $this->db->where('id_transaksi', $id);
        $this->db->where('transaksi', 'Keluar');
        $this->db->update('stok_opname', $data);
    }

        function get($id)
    {   
    	$level = $this->session->userdata['id_level'];
		 $id_gudang = $this->session->userdata['id_gudang'];
		 if ($level!=1) {
			$this->db->where('a.id_gudang', $id_gudang);
		} 		
        $this->db->where('a.id',$id);
        $this->db->select('a.*,b.nama as nama_pel');
		$this->db->join('pelanggan b', 'a.id_pelanggan=b.id');
        return $this->db->get('keluar a')->row();
    }

        function delete($id, $table)
    {
        $this->db->where('id', $id);
        $this->db->delete($table);
    }
        function delete_detail($id, $table)
    {
        $this->db->where('id_keluar', $id);
        $this->db->delete($table);
    }
         function update_detail($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('keluar_detail', $data);
    }

        function get_pelanggan($id)
    {   
    	$level = $this->session->userdata['id_level'];
		 $id_gudang = $this->session->userdata['id_gudang'];
		 if ($level!=1) {
			$this->db->where('id_gudang', $id_gudang);
		} 
    	$this->db->like('nama', $id);
    	$this->db->limit(10);
        return $this->db->get('pelanggan')->result();
    }

    function get_detail($id)
    {   
    	$id_user = $this->session->userdata['id_user'];
    	if ($id==0) {
    		$this->db->where('a.id_keluar', $id);
    		$this->db->where('a.id_user', $id_user);
    	}else{
    		$this->db->where('a.id_keluar', $id);
    	}
    	 $this->db->select('a.*,b.nama as nama_barang, c.nama as nama_satuan');
        $this->db->join('barang b', 'a.id_barang=b.id');
        $this->db->join('satuan c', 'a.kemasan=c.id');
        return $this->db->get('keluar_detail a')->result();
    }


    function get_brg($id)
    {   
    	$level = $this->session->userdata['id_level'];
		 $id_gudang = $this->session->userdata['id_gudang'];
		 if ($level!=1) {
			$sql= $this->db->where('a.id_gudang', $id_gudang);
		} 
		$date = date("Y-m-d");

		/*$sql=$this->db->select('a.*,c.nama as nama_satuan, b.nama as nama_barang, b.harga, b.kemasan');
    	$sql=$this->db->order_by('a.ed','asc');*/
    	// $sql=$this->db->or_like('sa.nama', $id);
    	/*$sql=$this->db->join('barang b', 'a.id_barang=b.id');
    	$sql=$this->db->join('satuan c', 'b.kemasan=c.id');*/
    	// $sql=$this->db->where('');
    	// $sql=$this->db->where('aa.ed >= "'.$date.'"');
    	/*$sql=$this->db->limit(10);
      	$sql= $this->db->get('stok_opname a')->result();
      	
      	$sql1=$this->db->order_by('id_barang');
      	$sql1=$this->db->get($sql)->result();*/
      	// return $sql1;
        $sql=$this->db->query("SELECT * FROM(
        SELECT `a`.*, `c`.`nama` AS `nama_satuan`, `b`.`nama` AS `nama_barang`, `b`.`harga`, `b`.`kemasan`
        FROM `stok_opname` `a`
        JOIN `barang` `b` ON `a`.`id_barang`=`b`.`id`
        JOIN `satuan` `c` ON `b`.`kemasan`=`c`.`id`
        WHERE`a`.`masuk` >0
        AND `a`.`ed` >= '$date'
        AND (`b`.`nama` LIKE '%$id%' ESCAPE '!' OR b.barcode LIKE '%$id%' ESCAPE '!')
        ORDER  BY ABS( DATEDIFF( a.ed, NOW() ) )
        LIMIT 10)
        AS sa GROUP BY sa.`id_barang`");

        return $sql->result();

    }

        function get_stok($id_transaksi)
    {   
    	$level = $this->session->userdata['id_level'];
		 $id_gudang = $this->session->userdata['id_gudang'];
		 if ($level!=1) {
			$this->db->where('id_gudang', $id_gudang);
		} 
    	$this->db->where('transaksi', 'Keluar');
    	$this->db->where('id_transaksi', $id_transaksi);
        return $this->db->get('stok_opname')->result();
    }

    function get_stok_opname($id_barang)
    {   
    	$level = $this->session->userdata['id_level'];
		 $id_gudang = $this->session->userdata['id_gudang'];
		 if ($level!=1) {
			$this->db->where('id_gudang', $id_gudang);
		} 
    	$this->db->where('transaksi', 'Penerimaan');
    	$this->db->where('id_barang', $id_barang);
    	return $this->db->get('stok_opname')->result();
    }
        function del_stok($id, $table)
    {
        $this->db->where('id_transaksi', $id);
        $this->db->where('transaksi' , 'Keluar');
        $this->db->delete($table);
    }
   
}