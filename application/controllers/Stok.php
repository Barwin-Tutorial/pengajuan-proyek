<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Stok extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_stok');
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
            $this->template->load('layoutbackend','stok/stok',$data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $list = $this->Mod_stok->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pel) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $pel->nama_barang;
            $row[] = $pel->nobatch;
            $row[] = $pel->ed;
            $row[] = $pel->masuk;
            $row[] = $pel->keluar;
            $row[] = $pel->sisa;

             // $row[] = "<a class=\"btn btn-xs btn-outline-primary edit\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit('$pel->id')\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger delete\" href=\"javascript:void(0)\" title=\"Delete\"  onclick=\"hapus('$pel->id')\"><i class=\"fas fa-trash\"></i></a>";
            $row[] = "<a class=\"btn btn-xs btn-outline-danger delete\" href=\"javascript:void(0)\" title=\"Delete\"  onclick=\"hapus('$pel->id')\"><i class=\"fas fa-trash\"></i></a>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_stok->count_all(),
            "recordsFiltered" => $this->Mod_stok->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {
        $this->_validate();
        $id_user = $this->session->userdata['id_user'];
        $id_gudang = $this->session->userdata['id_gudang'];
        $save  = array(
            'id_barang'         => $this->input->post('id_barang'),
            'tanggal'         => $this->input->post('tanggal'),
            'transaksi'         => $this->input->post('transaksi'),
            'nobatch'         => $this->input->post('nobatch'),
            'ed'         => $this->input->post('ed'),
            'masuk'         => $this->input->post('masuk'),
            'keluar'         => $this->input->post('keluar'),
            'user_input'  => $id_user,
            'id_gudang'  => $id_gudang
        );
        $this->Mod_stok->insert("stok_opname", $save);
        echo json_encode(array("status" => TRUE));

    }

    public function update()
    {
        $this->_validate();
        $id      = $this->input->post('id');
        $save  = array(
            'id_barang'         => $this->input->post('id_barang'),
            'nobatch'         => $this->input->post('nobatch'),
            'ed'         => $this->input->post('ed'),
            'transaksi'         => $this->input->post('transaksi'),
            'masuk'         => $this->input->post('masuk'),
            'keluar'         => $this->input->post('keluar'),
        );

        $this->Mod_stok->update($id, $save);
        echo json_encode(array("status" => TRUE));

    }

    public function edit($id)
    {
        $data = $this->Mod_stok->get($id);
        echo json_encode($data);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->Mod_stok->delete($id, 'stok_opname');        
        echo json_encode(array("status" => TRUE));
    }

    public function get_brg()
    {
        
     $id = $this->input->get('term');
     $data = $this->Mod_stok->get_brg($id);
     if (count($data) > 0) {
        foreach ($data as $row) {
            $arr_result[] = array( 'label'  => $row->nama, 'produk_nama'  => $row->nama, 'produk_id' => $row->id, 'produk_harga' =>  $row->harga, 'id_kemasan' => $row->kemasan, 'nama_satuan' => $row->nama_satuan);
        }
        echo json_encode($arr_result);
    }else{
        $arr_result = array( 'produk_nama'  => "Data Tidak di Temukan" );
        echo json_encode($arr_result);
    }

}
private function _validate()
{
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if($this->input->post('nama_barang') == '')
    {
        $data['inputerror'][] = 'nama_barang';
        $data['error_string'][] = 'Barang Tidak Boleh Kosong';
        $data['status'] = FALSE;
    }

    if($this->input->post('transaksi') == '')
    {
        $data['inputerror'][] = 'transaksi';
        $data['error_string'][] = 'Alasan Tidak Boleh Kosong';
        $data['status'] = FALSE;
    }

    if($this->input->post('nobatch') == '')
    {
        $data['inputerror'][] = 'nobatch';
        $data['error_string'][] = 'No Batch Tidak Boleh Kosong';
        $data['status'] = FALSE;
    }
    if($this->input->post('ed') == '')
    {
        $data['inputerror'][] = 'ed';
        $data['error_string'][] = 'Expired Date Tidak Boleh Kosong';
        $data['status'] = FALSE;
    }
    if($data['status'] === FALSE)
    {
        echo json_encode($data);
        exit();
    }
}

public function get_sisa_stok()
{
   $id_barang = $this->input->post('id_barang');
   $nobatch = $this->input->post('nobatch');   
   $row=$this->Mod_stok->get_sisa_stok($id_barang,$nobatch)->row();
   echo json_encode($row);
}
}