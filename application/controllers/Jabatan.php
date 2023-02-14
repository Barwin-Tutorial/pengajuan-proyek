<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Jabatan extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_jabatan');
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
            $this->template->load('layoutbackend','jabatan/index',$data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $list = $this->Mod_jabatan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pel) {

            $no++;
            $row = array();
            $row[] = $pel->nama_jabatan;
            $row[] = "<a class=\"btn btn-xs btn-outline-primary edit\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit('$pel->id_jabatan')\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger delete\" href=\"javascript:void(0)\" title=\"Delete\"  onclick=\"hapus('$pel->id_jabatan')\"><i class=\"fas fa-trash\"></i></a>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_jabatan->count_all(),
            "recordsFiltered" => $this->Mod_jabatan->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {
       
        $id_user = $this->session->userdata['id_user'];
        $save  = array(
            'nama_jabatan'         => htmlspecialchars_decode(ucwords($this->input->post('nama_jabatan'))),
          
        );
        $this->Mod_jabatan->insert("jabatan", $save);
        echo json_encode(array("status" => TRUE));

    }

    public function update()
    {
        // $this->_validate();
        $id      = $this->input->post('id');
        $save  = array(
            'nama_jabatan'         => htmlspecialchars_decode(ucwords($this->input->post('nama_jabatan'))),
        );

        $this->Mod_jabatan->update($id, $save);
        echo json_encode(array("status" => TRUE));

    }

    public function edit($id)
    {
        $data = $this->Mod_jabatan->get($id);
        echo json_encode($data);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->Mod_jabatan->delete($id, 'jabatan');        
        echo json_encode(array("status" => TRUE));
    }
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nama_jabatan') == '')
        {
            $data['inputerror'][] = 'nama_jabatan';
            $data['error_string'][] = 'Nama jabatan Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }
       

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}