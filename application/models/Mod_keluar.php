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
        $this->db->select('a.*,b.nama as nama_pel, d.nama as nama_barang,c.jumlah');
        $this->db->join('pelanggan b', 'a.id_pelanggan=b.id','left');
        $this->db->join('keluar_detail c', 'a.id=c.id_keluar','left');
        $this->db->join('barang d', 'c.id_barang=d.id','left');
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
        $this->db->join('pelanggan b', 'a.id_pelanggan=b.id','left');
        $this->db->join('keluar_detail c', 'a.id=c.id_keluar','left');
        $this->db->join('barang d', 'c.id_barang=d.id','left');
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
        $this->db->where('transaksi', 'Barang Keluar');
        $this->db->update('stok_opname', $data);
    }

    function get_batch($nobatch)
    {
        $this->db->select('ed,sum(masuk) as masuk, sum(keluar) as keluar,(sum(masuk)-sum(keluar)) as sisa ');
        $this->db->where('nobatch', $nobatch);
        return $this->db->get('stok_opname')->row();
    }

        function get($id)
    {   
        $level = $this->session->userdata['id_level'];
         $id_gudang = $this->session->userdata['id_gudang'];
         if ($level!=1) {
            $this->db->where('a.id_gudang', $id_gudang);
        }       
        $this->db->where('a.id',$id);
        $this->db->select('a.*,b.nama as nama_pelanggan,b.alamat');
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
        $id_user = $this->session->userdata['id_user'];
        $this->db->where('id_user', $id_user);
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


    function get_brg($params)
    {   
        $level = $this->session->userdata['id_level'];
         $id_gudang = $this->session->userdata['id_gudang'];
         $and="";
         if ($level!=1) {
            $and = " AND a.id_gudang='$id_gudang'";
        } 
        $date = date("Y-m-d");

        $sql=$this->db->query("SELECT * FROM (
            SELECT a.`id`, a.`id_transaksi`,a.`id_barang`,a.`ed`,a.`nobatch`,`c`.`nama` AS `nama_satuan`, `b`.`nama` AS `nama_barang`, 
            `b`.`harga`, `b`.`kemasan`, SUM(a.`masuk`) AS masuk, SUM(keluar) AS keluar, (SUM(a.`masuk`)-SUM(keluar)) AS sisa
            FROM `stok_opname` `a`
            JOIN `barang` `b` ON `a`.`id_barang`=`b`.`id`
            JOIN `satuan` `c` ON `b`.`kemasan`=`c`.`id`
            WHERE `a`.`ed` >= '$date' $and
            AND (`b`.`nama` LIKE '%$params%' ESCAPE '!' OR b.barcode LIKE '%$params%' ESCAPE '!') GROUP BY a.`id_barang`, a.`nobatch` HAVING sisa > 0
            ORDER  BY ABS( DATEDIFF( a.ed, NOW() ) ) 
        ) AS ab GROUP BY ab.id_barang LIMIT 10");

        return $sql->result();

    }

        function get_stok($id_transaksi)
    {   
        $level = $this->session->userdata['id_level'];
         $id_gudang = $this->session->userdata['id_gudang'];
         if ($level!=1) {
            $this->db->where('id_gudang', $id_gudang);
        } 
        $this->db->where('transaksi', 'Barang Keluar');
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->get('stok_opname')->result();
    }

    function get_stok_opname($id_barang)
    {   
        /*$level = $this->session->userdata['id_level'];
         $id_gudang = $this->session->userdata['id_gudang'];
         if ($level!=1) {
            $this->db->where('id_gudang', $id_gudang);
        } 
        $this->db->where('transaksi', 'Penerimaan');
        $this->db->where('id_barang', $id_barang);
        return $this->db->get('stok_opname')->result();*/

        $level = $this->session->userdata['id_level'];
         $id_gudang = $this->session->userdata['id_gudang'];
         $and="";
         if ($level!=1) {
            $and = " AND a.id_gudang='$id_gudang'";
        } 
        $date = date("Y-m-d");

        $sql=$this->db->query("SELECT * FROM (
            SELECT a.`id`, a.`id_barang`,a.`ed`,a.`nobatch`,`c`.`nama` AS `nama_satuan`, `b`.`nama` AS `nama_barang`, 
            `b`.`harga`, `b`.`kemasan`, SUM(a.`masuk`) AS masuk, SUM(keluar) AS keluar, (SUM(a.`masuk`)-SUM(keluar)) AS sisa
            FROM `stok_opname` `a`
            JOIN `barang` `b` ON `a`.`id_barang`=`b`.`id`
            JOIN `satuan` `c` ON `b`.`kemasan`=`c`.`id`
            WHERE `a`.`ed` >= '$date'
            AND a.`id_barang`='$id_barang' GROUP BY a.`nobatch`
        ) AS ab");

        return $sql;
    }
        function del_stok($id, $table)
    {
        $this->db->where('id_transaksi', $id);
        $this->db->where('transaksi' , 'Barang Keluar');
        $this->db->delete($table);
    }
   
         function max_no()
    {
        $level = $this->session->userdata['id_level'];
         $id_gudang = $this->session->userdata['id_gudang'];
         
        $this->db->where('id_gudang', $id_gudang);
        $m=date("m");
        $y=date("Y");
         $this->db->select('MAX(SUBSTR(faktur,4,5)) AS kode');
         $this->db->where('MONTH(tanggal)', $m);
         $this->db->where('YEAR(tanggal)', $y);
        $this->db->order_by('id','desc');
        return $this->db->get('keluar')->result_array();
    }

       function get_cetak($id)
    {   
       
        $this->db->where('a.id_keluar', $id);
         $this->db->select('a.*,b.nama as nama_barang, c.nama as nama_satuan');
        $this->db->join('barang b', 'a.id_barang=b.id');
        $this->db->join('satuan c', 'a.kemasan=c.id');
        return $this->db->get('keluar_detail a')->result();
    }

        function cek_barang($id_barang,$nobatch,$id_keluar)
    {
        $id_user = $this->session->userdata['id_user'];
        $this->db->where('nobatch',$nobatch);
        $this->db->where('id_keluar',$id_keluar);
        $this->db->where('id_barang', $id_barang);
        $this->db->where('id_user', $id_user);
        return $this->db->get('keluar_detail');
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

        $sql=$this->db->query("SELECT * FROM (
            SELECT  SUM(a.`masuk`) AS masuk, SUM(keluar) AS keluar, (SUM(a.`masuk`)-SUM(keluar)) AS sisa
            FROM `stok_opname` `a`
            JOIN `barang` `b` ON `a`.`id_barang`=`b`.`id`
            JOIN `satuan` `c` ON `b`.`kemasan`=`c`.`id`
            WHERE `a`.`ed` >= '$date'
            AND a.`id_barang`='$id_barang' AND a.nobatch='$nobatch' $and
        ) AS ab");

        return $sql;
    }

    function get_detail_keluar($id,$nobatch)
    {   
        
        $this->db->where('id',$id);
        $this->db->where('nobatch',$nobatch);
        return $this->db->get('keluar_detail');
    }

     function get_tanda_tangan($urutan)
    {
        $level = $this->session->userdata['id_level'];
         $id_gudang = $this->session->userdata['id_gudang'];
         
        $this->db->where('id_gudang', $id_gudang);
        $this->db->where('urutan', $urutan);
        $this->db->where('transaksi', 'Barang Keluar');
        return $this->db->get('tanda_tangan')->row();
    }

}