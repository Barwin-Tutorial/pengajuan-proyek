<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Mod_arus_stok extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
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

 	function get_perundangan()
 	{
 		return $this->db->get('perundangan');
 	}

 	public function get_laporan($id_barang,$tglrange,$perundangan)
 	{

 		$level = $this->session->userdata['id_level'];
 		$id_gudang = $this->session->userdata['id_gudang'];
 		$gdg="";
 		if ($level!=1) {
 			$gdg = " AND st.id_gudang=$id_gudang";
 		} 	
 		$and="";
 		if (isset($id_barang)) {
 			$and = " AND st.id_barang like '%".$id_barang."%'";
 		}

 		$date=explode(" - ", $tglrange);
 		$p1=date("Y-m-d", strtotime($date[0]));
		$p2=date("Y-m-d", strtotime($date[1]));
		$and1="";
 		if (isset($tglrange)) {
 			$and1 = " AND date(st.tanggal) BETWEEN '$p1' AND '$p2'";
 		}
 		$and2="";
 		if ($perundangan != 'all') {
 			$and2 = " AND st.perundangan like '%".$id_barang."%'";
 		}
 			
 		$sql = $this->db->query("select * from (
 			SELECT a.*,b.`nama` AS nama_barang, e.`nama` AS nama_supplier, 
 			'' AS nama_pelanggan, d.faktur FROM `stok_opname` a 
 			LEFT JOIN barang b ON a.`id_barang`=b.`id`
 			LEFT JOIN penerimaan_detail c ON a.`id_transaksi`=c.`id`
 			LEFT JOIN penerimaan d ON c.`id_penerimaan`=d.`id`
 			LEFT JOIN supplier e ON d.`id_supplier`=e.`id` where a.`transaksi`='Barang Masuk'
 			union all
 			SELECT a.*,b.`nama` AS nama_barang, '' AS nama_supplier, 
 			e.`nama` AS nama_pelanggan, '' faktur FROM `stok_opname` a 
 			LEFT JOIN barang b ON a.`id_barang`=b.`id`
 			left JOIN keluar_detail c ON a.`id_transaksi`=c.`id`
 			left JOIN keluar d ON c.`id_keluar`=d.`id`
 			LEFT JOIN pelanggan e ON d.`id_pelanggan`=e.`id` where a.`transaksi`='Barang Keluar'
 			UNION ALL
 			SELECT a.*,b.`nama` AS nama_barang, '' AS nama_supplier, 
 			e.`nama` AS nama_pelanggan, '' faktur FROM `stok_opname` a 
 			LEFT JOIN barang b ON a.`id_barang`=b.`id`
 			left JOIN keluar_detail c ON a.`id_transaksi`=c.`id`
 			left JOIN keluar d ON c.`id_keluar`=d.`id`
 			LEFT JOIN pelanggan e ON d.`id_pelanggan`=e.`id` WHERE a.`transaksi`  not in ('Keluar','Penerimaan')
 		) as st where 1=1 $gdg $and $and1 $and2 ");
 		return $sql;
 	}

 	public function get_laporan_sisa()
 	{

 		$level = $this->session->userdata['id_level'];
 		$id_gudang = $this->session->userdata['id_gudang'];
 		$gdg="";
 		if ($level!=1) {
 			$gdg = " WHERE st.id_gudang=$id_gudang";
 		} 	

 		$sql = $this->db->query("
 			SELECT b.`nama` AS nama_barang, SUM(masuk) AS masuk, SUM(keluar) AS keluar, (SUM(masuk)-SUM(keluar)) AS sisa, b.`harga`, ((SUM(masuk)-SUM(keluar))*b.harga) AS modal  FROM `stok_opname` a 
 			LEFT JOIN barang b ON a.`id_barang`=b.`id` $gdg GROUP BY a.`id_barang`");
 		return $sql;
 	}
}