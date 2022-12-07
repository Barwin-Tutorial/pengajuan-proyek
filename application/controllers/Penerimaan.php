<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Penerimaan extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_penerimaan');
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
           $data['barang'] = $this->Mod_penerimaan->get_barang_all();
           $data['supplier'] = $this->Mod_penerimaan->get_supplier_all();
            $this->template->load('layoutbackend','penerimaan/penerimaan',$data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $list = $this->Mod_penerimaan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pel) {

            $no++;
            $row = array();
            $row[] = $pel->faktur;
            $row[] = $pel->tanggal;
            $row[] = $pel->id_supplier;
            $row[] = $pel->id_supplier;
            $row[] = $pel->id_supplier;
            $row[] = "<a class=\"btn btn-xs btn-outline-primary edit\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit('$pel->id')\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger delete\" href=\"javascript:void(0)\" title=\"Delete\"  onclick=\"hapus('$pel->id')\"><i class=\"fas fa-trash\"></i></a>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_penerimaan->count_all(),
            "recordsFiltered" => $this->Mod_penerimaan->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {
        $waktu = date("H:i:s");
       $tanggal=date("Y-m-d H:i:s", strtotime($this->input->post('tanggal').$waktu));
       
        $id_user = $this->session->userdata['id_user'];
        $save  = array(
            'faktur'         => $this->input->post('faktur'),
            'tanggal'         => $tanggal,
            'id_supplier'         => $this->input->post('id_supplier'),
            'user_input'  => $id_user
        );
        $this->Mod_penerimaan->insert("penerimaan", $save);
        $id_penerimaan = $this->db->insert_id();
        foreach ($this->cart->contents() as $items) {
            $id_barang = $items['id'];
            $kemasan = $items['kemasan'];
            $jumlah = $items['qty'];
            $nobatch = $items['nobatch'];
            $ed     = $items['ed'];
            $harga = $items['price'];
            $subtotal = $items['subtotal'];

            $save_detail  = array(
                'id_penerimaan'         => $id_penerimaan,
                'id_barang'         => $id_barang,
                'kemasan'         => $kemasan,
                'nobatch'         => $nobatch,
                'jumlah'         => $jumlah,
                'ed'         => $ed,
                'harga'         => $harga,

            );
            $this->Mod_penerimaan->insert("penerimaan_detail", $save_detail);
        }

        echo json_encode(array("status" => TRUE));

    }

    public function update()
    {
        // $this->_validate();
        $id      = $this->input->post('id');
        $waktu = date("H:i:s");
       $tanggal=date("Y-m-d H:i:s", strtotime($this->input->post('tanggal').$waktu));
        $save  = array(
            'faktur'         => $this->input->post('faktur'),
            'tanggal'         => $tanggal,
            'id_supplier'         => $this->input->post('id_supplier')
        );

        $this->Mod_penerimaan->update($id, $save);
        foreach ($this->cart->contents() as $items) {

            $id_detail = $items['id'];
            var_dump($id_detail);
            $kemasan = $items['kemasan'];
            $jumlah = $items['qty'];
            $nobatch = $items['nobatch'];
            $ed     = $items['ed'];
            $harga = $items['price'];
            $subtotal = $items['subtotal'];

            $save_detail  = array(
                'kemasan'         => $kemasan,
                'nobatch'         => $nobatch,
                'jumlah'         => $jumlah,
                'ed'         => $ed,
                'harga'         => $harga,

            );
            $this->Mod_penerimaan->update_detail($id_detail, $save_detail);
        }

        echo json_encode(array("status" => TRUE));

    }

    public function edit($id)
    {
        $data = $this->Mod_penerimaan->get($id);
        
        echo json_encode($data);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->Mod_penerimaan->delete($id, 'penerimaan');        
        echo json_encode(array("status" => TRUE));
    }
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nama') == '')
        {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama penerimaan Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }
       

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }



        function edit_to_cart(){ //fungsi Edit To Cart
        // var_dump($this->input->post('produk_id'));
        $id = $this->input->post('id');
        $list = $this->Mod_penerimaan->get_detail($id);
        foreach ($list as $dp) {

            $data = array(
                'id' => $dp->id, 
                'name' => $dp->nama_barang, 
                'price' => $dp->harga, 
                'qty' => $dp->jumlah, 
                'nobatch' => $dp->nobatch, 
                'ed' => $dp->ed,
                'kemasan' => $dp->kemasan,
                'id_barang' => $dp->id_barang,
            );
            $this->cart->insert($data);
        }
        echo $this->show_cart(); //tampilkan cart setelah added
    }

    function add_to_cart(){ //fungsi Add To Cart
        // var_dump($this->input->post('produk_id'));
        $option=array(
            'nobatch' => $this->input->post('nobatch'), 
            'ed' => $this->input->post('ed'),
            'kemasan' => $this->input->post('kemasan'),
        );
        $data = array(
            'id' => $this->input->post('produk_id'), 
            'name' => $this->input->post('produk_nama'), 
            'price' => $this->input->post('produk_harga'), 
            'qty' => $this->input->post('jumlah'), 
            'nobatch' => $this->input->post('nobatch'), 
            'ed' => $this->input->post('ed'),
            'kemasan' => $this->input->post('kemasan'),
        );
        $this->cart->insert($data);
        echo $this->show_cart(); //tampilkan cart setelah added
    }

    function show_cart(){ //Fungsi untuk menampilkan Cart
        $output = '';
        $no = 0;

        foreach ($this->cart->contents() as $items) {

            $no++;
            $output .='
                <tr>
                    <td>'.$no.'</td>
                    <td>'.$items['name'].'</td>
                    <td>'.$items['kemasan'].'</td>
                    <td><input type="text" size="5" class=" form-control item'.$no.'" onkeypress="return hanyaAngka(event)" value='.$items['qty'].'></td>
                    <td><input type="text" class="form-control nobatch'.$no.'" value='.$items['nobatch'].'></td>
                    <td><input type="date" class="form-control ed'.$no.'" value='.$items['ed'].'></td>
                    <td>'.number_format($items['price']).'</td>
                    <td>'.number_format($items['subtotal']).'</td>
                    <td>
                    <button type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-danger btn-xs">Hapus</button>
                    <button type="button" id="'.$items['rowid'].'" no="'.$no.'"  class="simpan_cart btn btn-success btn-xs">simpan</button>
                    </td>

                </tr>
            ';
        }
        $output .= '
            <tr>
                <th colspan="7">Total</th>
                <th colspan="2">'.'Rp '.number_format($this->cart->total()).'</th>
            </tr>
        ';
        return $output;
    }

    function load_cart(){ //load data cart
        echo $this->show_cart();
    }


    function hapus_cart(){ //fungsi untuk menghapus item cart
        $data = array(
            'rowid' => $this->input->post('row_id'), 
            'qty' => 0, 
        );
        $this->cart->update($data);
        echo $this->show_cart();
    }

    function update_cart(){ //fungsi untuk update item cart
     $data = array(
        'rowid' => $this->input->post('row_id'),
        'qty' => $this->input->post('item'), 
        'nobatch' => $this->input->post('nobatch'), 
        'ed' => $this->input->post('ed'),
    );
        $this->cart->update($data);
        echo $this->show_cart();
    }
}