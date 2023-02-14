<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Guru extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_guru');
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
            $data['jabatan'] = $this->Mod_fungsi->get_jabatan();
            $this->template->load('layoutbackend','guru/index',$data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $list = $this->Mod_guru->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pel) {

            $no++;
            $row = array();
            $row[] = $pel->nama_guru;
            $row[] = $pel->nama_jabatan;
            $row[] = $pel->photo;
            $row[] = "<a class=\"btn btn-xs btn-outline-primary edit\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit('$pel->id_guru')\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger delete\" href=\"javascript:void(0)\" title=\"Delete\"  onclick=\"hapus('$pel->id_guru')\"><i class=\"fas fa-trash\"></i></a>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_guru->count_all(),
            "recordsFiltered" => $this->Mod_guru->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {
     $id_user = $this->session->userdata['id_user'];
     if(!empty($_FILES['imagefile']['name'])) {
        // $this->_validate();
        $id = $this->input->post('id_user');
        
        $nama = slug($this->input->post('nama_guru'));
        $config['upload_path']   = './assets/foto/guru/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']      = '1000';
        $config['max_width']     = '2000';
        $config['max_height']    = '1024';
        $config['file_name']     = $nama; 
        
        $this->upload->initialize($config);

        if ($this->upload->do_upload('imagefile')){
         $gambar = $this->upload->data();
         $save  = array(
            'nama_guru'         => htmlspecialchars_decode(ucwords($this->input->post('nama_guru'))),
            'id_jabatan'         => $this->input->post('id_jabatan'),
            'photo'             => $gambar['file_name']
        );
         $this->Mod_guru->insert("guru", $save);
         echo json_encode(array("status" => TRUE));
     }
 }else{
     $save  = array(
        'nama_guru'         => htmlspecialchars_decode(ucwords($this->input->post('nama_guru'))),
        'id_jabatan'         => $this->input->post('id_jabatan'),
    );
     $this->Mod_guru->insert("guru", $save);
     echo json_encode(array("status" => TRUE));
 }

}

public function update()
{
        // $this->_validate();
    $id      = $this->input->post('id');

    if(!empty($_FILES['imagefile']['name'])) {
        // $this->_validate();
        $id = $this->input->post('id_user');
        
        $nama = slug($this->input->post('nama_guru'));
        $config['upload_path']   = './assets/foto/guru/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']      = '1000';
        $config['max_width']     = '2000';
        $config['max_height']    = '1024';
        $config['file_name']     = $nama; 
        
        $this->upload->initialize($config);

        if ($this->upload->do_upload('imagefile')){
            $gambar = $this->upload->data();
            $save  = array(
                'nama_guru'         => htmlspecialchars_decode(ucwords($this->input->post('nama_guru'))),
                'id_jabatan'         => $this->input->post('id_jabatan'),
                'photo'             => $gambar['file_name']
            );

            $this->Mod_guru->update($id, $save);
            echo json_encode(array("status" => TRUE));
        }
    }else{
        $save  = array(
            'nama_guru'         => htmlspecialchars_decode(ucwords($this->input->post('nama_guru'))),
            'id_jabatan'         => $this->input->post('id_jabatan'),
        );

        $this->Mod_guru->update($id, $save);
        echo json_encode(array("status" => TRUE));
    }

}

public function edit($id)
{
    $data = $this->Mod_guru->get($id);
    echo json_encode($data);
}

public function delete()
{
    $id = $this->input->post('id');
    $this->Mod_guru->delete($id, 'guru');        
    echo json_encode(array("status" => TRUE));
}
private function _validate()
{
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if($this->input->post('nama_guru') == '')
    {
        $data['inputerror'][] = 'nama_guru';
        $data['error_string'][] = 'Nama Guru Tidak Boleh Kosong';
        $data['status'] = FALSE;
    }


    if($data['status'] === FALSE)
    {
        echo json_encode($data);
        exit();
    }
}
}