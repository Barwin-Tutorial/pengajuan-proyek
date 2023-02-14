<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Pengembalian extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_pengembalian');
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
            $data['jurusan'] = $this->Mod_fungsi->get_jurusan();
            $data['kondisi'] = $this->Mod_fungsi->get_kondisi();
            $data['satuan'] = $this->Mod_fungsi->get_satuan();
            // $data['alat'] = $this->Mod_fungsi->get_alat();
            $data['jabatan'] = $this->Mod_fungsi->get_jabatan();
            $data['guru'] = $this->Mod_fungsi->get_guru();
            $this->template->load('layoutbackend','pengembalian/index',$data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $list = $this->Mod_pengembalian->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pel) {

            $no++;
            $row = array();
            $row[] = $pel->nama;
            $row[] = $pel->nama_jabatan;
            $row[] = $pel->nama_alat;
            $row[] = $pel->stok_in;
            $row[] = $pel->nama_satuan;
            $row[] = $pel->kondisi;
            $row[] = $pel->tgl_in;
            $row[] = $pel->keterangan;
            $row[] = "<a class=\"btn btn-xs btn-outline-primary edit\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit('$pel->id_pengembalian')\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger delete\" href=\"javascript:void(0)\" title=\"Delete\"  onclick=\"hapus('$pel->id_pengembalian')\"><i class=\"fas fa-trash\"></i></a>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_pengembalian->count_all(),
            "recordsFiltered" => $this->Mod_pengembalian->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {
     
        $id_user = $this->session->userdata['id_user'];
        $id_jurusan = $this->session->userdata['id_jurusan'];
        $save  = array(
            'nama'         => htmlspecialchars_decode(ucwords($this->input->post('nama'))),
            'id_jabatan'    => $this->input->post('id_jabatan'),
            'id_alat'    => $this->input->post('id_alat'),
            'id_satuan'    => $this->input->post('id_satuan'),
            'id_kondisi'    => $this->input->post('id_kondisi'),
            'tgl_in'    => $this->input->post('tgl_in'),
            'stok_in'    => $this->input->post('stok_in'),
            'keterangan'    => $this->input->post('keterangan'),
            'id_user'    => $id_user,
            'id_jurusan' => $id_jurusan
            
        );
        $this->Mod_pengembalian->insert("pengembalian", $save);
        echo json_encode(array("status" => TRUE));

    }

    public function update()
    {
        // $this->_validate();
        $id      = $this->input->post('id');
        $save  = array(
            'nama'         => htmlspecialchars_decode(ucwords($this->input->post('nama'))),
            'id_jabatan'    => $this->input->post('id_jabatan'),
            'id_alat'    => $this->input->post('id_alat'),
            'id_satuan'    => $this->input->post('id_satuan'),
            'id_kondisi'    => $this->input->post('id_kondisi'),
            'tgl_in'    => $this->input->post('tgl_in'),
            'stok_in'    => $this->input->post('stok_in'),
            'keterangan'    => $this->input->post('keterangan'),
            
        );

        $this->Mod_pengembalian->update($id, $save);
        echo json_encode(array("status" => TRUE));

    }

    public function edit($id)
    {
        $data = $this->Mod_pengembalian->get($id);
        echo json_encode($data);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->Mod_pengembalian->delete($id, 'pengembalian');        
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
            $data['error_string'][] = 'Nama pengembalian Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }
        

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function get_alat_bar()
    {
        $barcode = $this->input->post('barcode');
        $data = $this->Mod_fungsi->get_alat_bar($barcode)->row();
        echo json_encode($data);
        
    }
    public function get_alat()
    {
        $nama = $this->input->get('term');
        $data = $this->Mod_fungsi->get_alat($nama);
        if (count($data->result()) > 0) {

            foreach ($data->result() as $row){
                $arr_result[] = array( 'value' => $row->id_alat, 'label'  => $row->nama_alat,  );
            } 
            echo json_encode($arr_result);
        }else{
            $arr_result = array( 'label'  => "Data Tidak di Temukan" );
            echo json_encode($arr_result);
        }
    }
}