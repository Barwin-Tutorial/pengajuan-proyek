<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require 'vendor/autoload.php';
use Zend\Barcode\Barcode;
/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Barang extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_barang');
        // $this->load->model('dashboard/Mod_dashboard');
    }

    public function index()
    {
        $link = $this->uri->segment(1);
        $level = $this->session->userdata['id_level'];
        
        $data['satuan'] = $this->Mod_barang->satuan()->result();
        $data['perundangan'] = $this->Mod_barang->perundangan()->result();
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
            $this->template->load('layoutbackend','barang/barang',$data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $list = $this->Mod_barang->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pel) {

            $no++;
            $row = array();
            $row[] = $pel->barcode;
            $row[] = $pel->nama;
            $row[] = $pel->nama_satuan;
            $row[] = $pel->berat;
            $row[] = $pel->nama_perundangan;
            $row[] = $pel->harga;
            $row[] = $pel->rak;
            $row[] = $pel->aktivasi;
            $row[] = "<a class=\"btn btn-xs btn-outline-primary edit\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit('$pel->id')\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger delete\" href=\"javascript:void(0)\" title=\"Delete\"  onclick=\"hapus('$pel->id')\"><i class=\"fas fa-trash\"></i></a> <a class=\"btn btn-xs btn-outline-danger barcode\" href=\"javascript:void(0)\" title=\"Barcode\"  onclick=\"barcode('$pel->id')\"><i class=\"fas fa-barcode\"></i></a>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_barang->count_all(),
            "recordsFiltered" => $this->Mod_barang->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {
        /*$trx= $this->Mod_barang->max_no();
       if ($trx[0]['kode']==NULL) {
            $n="00001";
            $kode='B'.$n;
        }else{
            $n=$trx[0]['kode']+1;
            $x='00000'.$n;
            $kode='B'.substr($x, -5);
        }*/
        $level = $this->session->userdata['id_level'];
        $id_user = $this->session->userdata['id_user'];
        $id_gudang = $this->session->userdata['id_gudang'];
        $save  = array(
            'nama'         => $this->input->post('nama'),
            'barcode'         => $this->input->post('barcode'),
            'kdbarang'         => $this->input->post('barcode'),
            'kemasan'         => $this->input->post('kemasan'),
            'berat'         => $this->input->post('berat'),
            'perundangan'         => $this->input->post('perundangan'),
            'harga'         => $this->input->post('harga'),
            'rak'         => $this->input->post('rak'),
            'aktivasi'         => $this->input->post('aktivasi'),
            'id_gudang'   => $id_gudang,
            'user_input'  => $id_user
        );
        $this->Mod_barang->insert("barang", $save);
        echo json_encode(array("status" => TRUE));

    }

    public function update()
    {
        // $this->_validate();
        $id      = $this->input->post('id');
        $save  = array(
            'nama'         => $this->input->post('nama'),
            'barcode'         => $this->input->post('barcode'),
            'kemasan'         => $this->input->post('kemasan'),
            'berat'         => $this->input->post('berat'),
            'perundangan'         => $this->input->post('perundangan'),
            'harga'         => $this->input->post('harga'),
            'rak'         => $this->input->post('rak'),
            'aktivasi'         => $this->input->post('aktivasi')
        );

        $this->Mod_barang->update($id, $save);
        echo json_encode(array("status" => TRUE));

    }

    public function edit($id)
    {
        $data = $this->Mod_barang->get($id);
        echo json_encode($data);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->Mod_barang->delete($id, 'barang');        
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
            $data['error_string'][] = 'Nama Barang Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('harga') == '')
        {
            $data['inputerror'][] = 'harga';
            $data['error_string'][] = 'Harga Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('kemasan') == '')
        {
            $data['inputerror'][] = 'kemasan';
            $data['error_string'][] = 'Kemasan Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }


        
    }

    public function print_barcode()
    {


        /*$p=$this->input->post('heigth');
        $t=$this->input->post('width');*/
        $barcode=$this->input->post('barcode');
        $data['jumlah']=$this->input->post('jumlah');
        $data['code']=$this->input->post('barcode');
        $data['barcode'] = $this->set_barcode($barcode);

        $this->load->view('barang/print_barcode',$data);
    }

    public function set_barcode($code)
    {
     $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
     return $generator->getBarcode($code, $generator::TYPE_CODE_128, 2, 42);
 }

  public function set_barcodePNG($code,$h,$w)
    {
     $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
     echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($code, $generator::TYPE_CODE_128, 1, 42)) . '">';
     // return $generator->getBarcode($code, $generator::TYPE_EAN_13, 2, 42);
 }
   
}