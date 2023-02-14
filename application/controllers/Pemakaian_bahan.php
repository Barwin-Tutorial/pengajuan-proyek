<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Pemakaian_bahan extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_pemakaian_bahan');
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
            $data['bahan'] = $this->Mod_fungsi->get_bahan();
            $data['jabatan'] = $this->Mod_fungsi->get_jabatan();
            $data['guru'] = $this->Mod_fungsi->get_guru();
            $this->template->load('layoutbackend','pemakaian_bahan/index',$data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $list = $this->Mod_pemakaian_bahan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pel) {

            $no++;
            $row = array();
            $row[] = $pel->nama;
            $row[] = $pel->nama_jabatan;
            $row[] = $pel->nama_bahan;
            $row[] = $pel->stok_out;
            $row[] = $pel->nama_satuan;
            $row[] = $pel->kondisi;
            $row[] = $pel->tgl_out;
            $row[] = $pel->nama_guru;
            $row[] = $pel->keterangan;
            $row[] = "<a class=\"btn btn-xs btn-outline-primary edit\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit('$pel->id_pemakaian_bahan')\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger delete\" href=\"javascript:void(0)\" title=\"Delete\"  onclick=\"hapus('$pel->id_pemakaian_bahan')\"><i class=\"fas fa-trash\"></i></a>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_pemakaian_bahan->count_all(),
            "recordsFiltered" => $this->Mod_pemakaian_bahan->count_filtered(),
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
            'id_bahan'    => $this->input->post('id_bahan'),
            'id_guru'    => $this->input->post('id_guru'),
            'id_satuan'    => $this->input->post('id_satuan'),
            'id_kondisi'    => $this->input->post('id_kondisi'),
            'tgl_out'    => $this->input->post('tgl_out'),
            'stok_out'    => $this->input->post('stok_out'),
            'keterangan'    => $this->input->post('keterangan'),
            'id_user'    => $id_user,
            'id_jurusan' => $id_jurusan
          
        );
        $this->Mod_pemakaian_bahan->insert("pemakaian_bahan", $save);
        echo json_encode(array("status" => TRUE));

    }

    public function update()
    {
        // $this->_validate();
        $id      = $this->input->post('id');
         $save  = array(
            'nama'         => htmlspecialchars_decode(ucwords($this->input->post('nama'))),
            'id_jabatan'    => $this->input->post('id_jabatan'),
            'id_bahan'    => $this->input->post('id_bahan'),
            'id_guru'    => $this->input->post('id_guru'),
            'id_satuan'    => $this->input->post('id_satuan'),
            'id_kondisi'    => $this->input->post('id_kondisi'),
            'tgl_out'    => $this->input->post('tgl_out'),
            'stok_out'    => $this->input->post('stok_out'),
            'keterangan'    => $this->input->post('keterangan'),
          
        );

        $this->Mod_pemakaian_bahan->update($id, $save);
        echo json_encode(array("status" => TRUE));

    }

    public function edit($id)
    {
        $data = $this->Mod_pemakaian_bahan->get($id);
        echo json_encode($data);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->Mod_pemakaian_bahan->delete($id, 'pemakaian_bahan');        
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
            $data['error_string'][] = 'Nama Pemakaian Bahan Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }
       

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}