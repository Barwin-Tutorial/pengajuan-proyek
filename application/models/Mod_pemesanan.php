<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Mod_pemesanan extends CI_Model
{
	var $table = 'pemesanan';
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
     $level = $this->session->userdata['id_level'];
     $id_gudang = $this->session->userdata['id_gudang'];


     if ($level!=1) {
         $this->db->where('a.id_gudang', $id_gudang);
     } 

     $this->db->select('a.*,b.jumlah,c.nama as nama_barang,e.nama as nama_satuan, d.nama as nama_supplier');
     $this->db->join('pemesanan_detail b', 'a.id=b.id_pemesanan');
     $this->db->join('barang c', 'b.id_barang=c.id');
     $this->db->join('supplier d', 'a.id_supplier=d.id');
     $this->db->join('satuan e', 'b.id_satuan=e.id');
     $this->db->from('pemesanan a');
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


     $this->db->join('pemesanan_detail b', 'a.id=b.id_pemesanan');
     $this->db->join('barang c', 'b.id_barang=c.id');
     $this->db->join('supplier d', 'a.id_supplier=d.id');
     $this->db->join('satuan e', 'b.id_satuan=e.id');
     $this->db->from('pemesanan a');
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
    $this->db->update('pemesanan', $data);
}

function update_detail($id, $data)
{
    $this->db->where('id', $id);
    $this->db->update('pemesanan_detail', $data);
}

function update_stok_opname($id, $data)
{
    $this->db->where('id_transaksi', $id);
    $this->db->where('transaksi', 'Barang Masuk');
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
 $this->db->select('a.*, d.nama as nama_supplier,d.alamat');
 $this->db->join('supplier d', 'a.id_supplier=d.id');
 return $this->db->get('pemesanan a')->row();
}

function get_supplier_all()
{   
   $level = $this->session->userdata['id_level'];
   $id_gudang = $this->session->userdata['id_gudang'];
   if ($level!=1) {
     $this->db->where('id_gudang', $id_gudang);
 } 
 return $this->db->get('supplier');
}

function get_barang_all()
{   
   $level = $this->session->userdata['id_level'];
   $id_gudang = $this->session->userdata['id_gudang'];
   if ($level!=1) {
     $this->db->where('id_gudang', $id_gudang);
 } 
 return $this->db->get('barang');
}

function get_brg($id)
{   
   $level = $this->session->userdata['id_level'];
   $id_gudang = $this->session->userdata['id_gudang'];
   if ($level!=1) {
     $this->db->where('id_gudang', $id_gudang);
 } 
 $this->db->select('a.*,b.nama as nama_satuan');
 $this->db->like('a.barcode', $id);
 $this->db->or_like('a.nama', $id);
 $this->db->join('satuan b', 'a.kemasan=b.id');
 $this->db->limit(10);
 return $this->db->get('barang a')->result();
}

function get_supplier($id)
{   
   $level = $this->session->userdata['id_level'];
   $id_gudang = $this->session->userdata['id_gudang'];
   if ($level!=1) {
     $this->db->where('id_gudang', $id_gudang);
 } 

 $this->db->like('nama', $id);
 $this->db->limit(10);
 return $this->db->get('supplier')->result();
}


function get_detail($id)
{   
   $id_user = $this->session->userdata['id_user'];
   if ($id==0) {
      $this->db->where('a.id_pemesanan', $id);
      $this->db->where('a.id_user', $id_user);
  }else{
      $this->db->where('a.id_pemesanan', $id);
  }
  $this->db->select('a.*,b.nama as nama_barang,b.harga, c.nama as nama_satuan');
  $this->db->join('barang b', 'a.id_barang=b.id');
  $this->db->join('satuan c', 'a.id_satuan=c.id');
  return $this->db->get('pemesanan_detail a')->result();
}

    //Cek Barang di detail
function get_detail_brg($id_barang)
{   
   $this->db->where('id_barang',$id_barang);
   return $this->db->get('pemesanan_detail')->row();
}
function delete($id, $table)
{
    $this->db->where('id', $id);
    $this->db->delete($table);
}

function delete_detail($id, $table)
{
   $id_user = $this->session->userdata['id_user'];

   $this->db->where('id_pemesanan', $id);
   $this->db->where('id_user', $id_user);
   $this->db->delete($table);
}



function get_stok($id_transaksi)
{   
   $this->db->where('transaksi', 'Barang Masuk');
   $this->db->where('id_transaksi', $id_transaksi);
   return $this->db->get('stok_opname')->result();
}

function del_stok($id, $table)
{
    $this->db->where('id_transaksi', $id);
    $this->db->where('transaksi' , 'Barang Masuk');
    $this->db->delete($table);
}

function max_no()
{
   $level = $this->session->userdata['id_level'];
   $id_gudang = $this->session->userdata['id_gudang'];

   $this->db->where('id_gudang', $id_gudang);
   $m=date("m");
   $y=date("Y");
   $this->db->select('MAX(SUBSTR(nosp,4,5)) AS kode');
   $this->db->where('MONTH(tanggal)', $m);
   $this->db->where('YEAR(tanggal)', $y);
   $this->db->order_by('id','desc');
   return $this->db->get('pemesanan')->result_array();
}

function get_cetak($id)
{   

    $this->db->where('a.id_pemesanan', $id);
    $this->db->select('a.*,b.nama as nama_barang,b.harga, c.nama as nama_satuan');
    $this->db->join('barang b', 'a.id_barang=b.id');
    $this->db->join('satuan c', 'a.id_satuan=c.id');
    
    return $this->db->get('pemesanan_detail a')->result();
}

function cek_barang($id_barang,$id_pemesanan)
{
    $id_user = $this->session->userdata['id_user'];
    $this->db->where('id_pemesanan',$id_pemesanan);
    $this->db->where('id_barang', $id_barang);
    $this->db->where('id_user', $id_user);
    return $this->db->get('pemesanan_detail');
}

  function get_tanda_tangan($urutan)
    {
        $level = $this->session->userdata['id_level'];
         $id_gudang = $this->session->userdata['id_gudang'];
         
        $this->db->where('id_gudang', $id_gudang);
        $this->db->where('urutan', $urutan);
        $this->db->where('transaksi', 'Pemesanan');
        return $this->db->get('tanda_tangan')->row();
    }
}