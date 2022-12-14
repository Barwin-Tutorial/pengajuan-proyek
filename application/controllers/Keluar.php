<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Keluar extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_keluar');
        // $this->load->model('dashboard/Mod_dashboard');
    }

    public function index()
    {
        $link = $this->uri->segment(1);
        $level = $this->session->userdata['id_level'];
        // Cek Posisi Menu apakah Sub Menu Atau bukan
        $jml = $this->Mod_dashboard->get_akses_menu($link,$level)->num_rows();

        if ($jml > 0) {//Jika Menu
            $data['akses_menu'] = $this->Mod_dashboard->get_akses_menu($link,$level)->row();
            $a_menu = $this->Mod_dashboard->get_akses_menu($link,$level)->row();
            $akses=$a_menu->view;
        }else{
            $data['akses_menu'] = $this->Mod_dashboard->get_akses_submenu($link,$level)->row();
            $a_submenu = $this->Mod_dashboard->get_akses_submenu($link,$level)->row();
            $akses=$a_submenu->view;
        }


        if ($akses=="Y") {
            $this->hapus_all_cart();
            $this->template->load('layoutbackend','keluar/keluar',$data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }


    }

    public function ajax_list()
    {
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $list = $this->Mod_keluar->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pel) {

            $no++;
            $row = array();
            // $row[] = $no;
            // <a class=\"btn btn-xs btn-outline-info \" href=\"javascript:void(0)\" title=\"View\" onclick=\"views('$pel->id')\"><i class=\"fas fa-eye\"></i></a>
            $row[] = $pel->tanggal;
            $row[] = $pel->nama_pel;
            $row[] = $pel->nama_barang;
            $row[] = $pel->jumlah;
            $row[] = "  <a class=\"btn btn-xs btn-outline-primary edit\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit('$pel->id')\"><i class=\"fas fa-edit\"></i></a>  <a class=\"btn btn-xs btn-outline-danger delete\" href=\"javascript:void(0)\" title=\"Delete\"  onclick=\"hapus('$pel->id')\"><i class=\"fas fa-trash\"></i></a>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_keluar->count_all(),
            "recordsFiltered" => $this->Mod_keluar->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {
        $this->_validate();
        $list = $this->Mod_keluar->get_detail(0);
        if (count($list) == 0) {
           echo json_encode(array("status" => FALSE, 'pesan' => 0));

           exit();
       }
       $waktu = date("H:i:s");
       $tanggal=$this->input->post('tanggal');
       $id_gudang = $this->session->userdata['id_gudang'];
       $id_user = $this->session->userdata['id_user'];
       $save  = array(
        'tanggal'         => $tanggal,
        'id_pelanggan'         => $this->input->post('pelanggan'),
        'user_input'  => $id_user,
        'id_gudang'   =>  $id_gudang
    );
       $this->Mod_keluar->insert("keluar", $save);
       $id_keluar = $this->db->insert_id();


       foreach ($list as $items) {
        $save_detail = array('id_keluar' => $id_keluar);
        $id_detail=$items->id;
        $this->Mod_keluar->update_detail($id_detail, $save_detail);

        $save_stok  = array(
            'id_transaksi'         => $items->id,
            'id_barang'         => $items->id_barang,
            'tanggal'         => $tanggal,
            'transaksi'         => 'Keluar',
            'keluar'         => $items->jumlah,
            'ed'         => $items->ed,
            'nobatch'         => $items->nobatch,
            'user_input'  => $id_user,
            'id_gudang'   =>  $id_gudang
        );
        $this->Mod_keluar->insert("stok_opname", $save_stok);
    }

    echo json_encode(array("status" => TRUE));



}



public function update()
{
   $id_gudang = $this->session->userdata['id_gudang'];
   $id_user = $this->session->userdata['id_user'];
   $this->_validate();

   $id      = $this->input->post('id');
   $waktu = date("H:i:s");
   $tanggal=$this->input->post('tanggal');
   $save  = array(
    'tanggal'         => $tanggal,
    'id_pelanggan'         => $this->input->post('pelanggan')
);

   $this->Mod_keluar->update($id, $save);
   $list = $this->Mod_keluar->get_detail($id);

   foreach ($list as $items) {
    $id_keluar = $items->id_keluar;
    $id_detail = $items->id;
    $jumlah = $items->jumlah;

    $save_detail = array('id_keluar' => $id);
    $this->Mod_keluar->update_detail($id_detail, $save_detail);

    $cek=$this->Mod_keluar->get_stok($id_detail);
    if (count($cek) == 0) {
        $save_stok  = array(
            'id_transaksi'         => $items->id,
            'id_barang'         => $items->id_barang,
            'tanggal'         => $tanggal,
            'transaksi'         => 'Keluar',
            'keluar'         => $items->jumlah,
            'ed'         => $items->ed,
            'nobatch'         => $items->nobatch,
            'user_input'  => $id_user,
            'id_gudang'   =>  $id_gudang
        );
        $this->Mod_keluar->insert("stok_opname", $save_stok);
    }else{
     $save_stok  = array(
        'keluar'         => $jumlah,
        'ed'         => $items->ed,
        'nobatch'         => $items->nobatch,
    );
     $this->Mod_keluar->update_stok_opname($id_detail, $save_stok);
 }


}

echo json_encode(array("status" => TRUE));


}

public function edit($id)
{
    $data = $this->Mod_keluar->get($id);
    echo json_encode($data);
}

public function cek_nobatch()
{
    $nobatch = $this->input->post('nobatch');

    $data = $this->Mod_keluar->get_batch($nobatch);
    echo json_encode($data);
}

public function get_brg()
{

 $id = $this->input->get('term');
 $data = $this->Mod_keluar->get_brg($id);
 if (count($data) > 0) {
    foreach ($data as $row) {
        $arr_result[] = array( 'label'  => $row->nama_barang, 'produk_nama'  => $row->nama_barang, 'produk_id' => $row->id_barang, 'produk_harga' =>  $row->harga, 'id_kemasan' => $row->kemasan, 'nama_satuan' => $row->nama_satuan, 'ed' => $row->ed, 'nobatch' => $row->nobatch, 'jumlah' => $row->masuk);
    }
    echo json_encode($arr_result);
}else{
    $arr_result = array( 'produk_nama'  => "Data Tidak di Temukan" );
    echo json_encode($arr_result);
}

}

public function get_pelanggan()
{
    $id = $this->input->get('term');
    $data = $this->Mod_keluar->get_pelanggan($id);
    if (count($data) > 0) {

        foreach ($data as $row){
            $arr_result[] = array( 'value' => $row->id, 'label'  => $row->nama,  );
        } 
        echo json_encode($arr_result);
    }else{
        $arr_result = array( 'label'  => "Data Tidak di Temukan" );
        echo json_encode($arr_result);
    }
}

public function getAllPelanggan()
{
 $data = $this->Mod_keluar->get_supplier_all();
 echo json_encode($data);
}
public function delete()
{
    $id = $this->input->post('id');
    $list = $this->Mod_keluar->get_detail($id);
    foreach ($list as $items) {

        $id_detail = $items->id;
        $this->Mod_keluar->del_stok($id_detail, "stok_opname");

    }
    $this->Mod_keluar->delete($id, 'keluar'); 
    $this->Mod_keluar->delete_detail($id, 'keluar_detail');        
    echo json_encode(array("status" => TRUE));
}
private function _validate()
{
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if($this->input->post('vpel') == '')
    {
        $data['inputerror'][] = 'vpel';
        $data['error_string'][] = 'Pelanggan Tidak Boleh Kosong';
        $data['status'] = FALSE;
    }


    if($data['status'] === FALSE)
    {
        echo json_encode($data);
        exit();
    }
}



        function edit_to_cart(){ //fungsi Edit To Cart
            $id = $this->input->post('id');
        $this->load_cart($id); //tampilkan cart setelah added
    }

    function add_to_cart(){ //fungsi Add To Cart
     $id_user = $this->session->userdata['id_user'];
     $id_keluar = $this->input->post('id');
     $save_detail  = array(
        'id_barang'         => $this->input->post('produk_id'),
        'kemasan'         => $this->input->post('kemasan'),
        'nobatch'         => $this->input->post('nobatch'),
        'jumlah'         => $this->input->post('jumlah'),
        'ed'         => $this->input->post('ed'),
        'harga_jual'         => $this->input->post('produk_harga'),
        'id_keluar' => $id_keluar,
        'id_user'   => $id_user

    );
     $this->Mod_keluar->insert("keluar_detail", $save_detail);

         $this->load_cart($id_keluar); //tampilkan cart setelah added
     }


    function show_cart($id_keluar){ //Fungsi untuk menampilkan Cart
        $output = '';
        $no = 0;
        $total = 0;
        $list = $this->Mod_keluar->get_detail($id_keluar);
        foreach ($list as $items) {
            $subtotal = ($items->harga_jual * $items->jumlah);
            $total += $subtotal;
            $no++;
            $id_barang = $items->id_barang;
            $stokop = $this->Mod_keluar->get_stok_opname($id_barang);
            
            $output .='
            <tr>
            <td>'.$no.'</td>
            <td>'.$items->nama_barang.'</td>
            <td>'.$items->nama_satuan.'</td>
            <td><input type="text" size="5" class=" form-control form-control-sm item'.$no.'" onkeypress="return hanyaAngka(event)" value='.$items->jumlah.'></td>
            <td><input type="text" class="form-control form-control-sm ed'.$no.'" value='.$items->ed.' readonly></td>
            <td>';
            $output .= '
            <select class="form-control form-control-sm selbatch nobatch'.$no.'" no="'.$no.'">';
            foreach ($stokop as $k) {
                $sel = ($items->nobatch==$k->nobatch) ? 'selected' : '' ;
                $output .='<option value="'.$k->nobatch.'">'.$k->nobatch.'</option>';
            }
            $output .='</select>';
            $output .='</td>';
            $output .= '<td>'.number_format($items->harga_jual).'</td>';
            $output .= '<td>'.number_format($subtotal).'</td>
            <td>
            <button type="button" id_keluar="'.$items->id_keluar.'"  id_detail="'.$items->id.'" no="'.$no.'" class="hapus_cart btn btn-danger btn-xs">Hapus</button>
            <button type="button" id_keluar="'.$items->id_keluar.'" id_detail="'.$items->id.'"  no="'.$no.'" class="simpan_cart btn btn-success btn-xs">simpan</button>
            </td>

            </tr>
            ';
        }
        $output .= '
        <tr>
        <th colspan="7" style="text-align : center;">Total</th>
        <th colspan="2">'.'Rp '.number_format($total).'</th>
        </tr>
        ';
        return $output;
    }

    function load_cart($id_keluar){ //load data cart
        echo $this->show_cart($id_keluar);
    }


    function hapus_cart(){ //fungsi untuk menghapus item cart
        $id_keluar = $this->input->post('id');
        $id_detail = $this->input->post('id_detail');
        $this->Mod_keluar->delete($id_detail,'keluar_detail');
        $this->Mod_keluar->del_stok($id_detail,'stok_opname');
        $this->load_cart($id_keluar);
    }

    function update_cart(){ //fungsi untuk update item cart

        $id_keluar = $this->input->post('id');
        $id_detail = $this->input->post('id_detail');
        $save_detail  = array(
            'nobatch'         => $this->input->post('nobatch'),
            'jumlah'         => $this->input->post('jumlah'),
            'ed'         => $this->input->post('ed'),
        );

        $this->Mod_keluar->update_detail($id_detail, $save_detail);
        $this->load_cart($id_keluar);
    }

         function hapus_all_cart(){ //fungsi untuk menghapus item cart
            $id_keluar='0';
            $this->Mod_keluar->delete_detail($id_keluar, 'keluar_detail');
        }
}