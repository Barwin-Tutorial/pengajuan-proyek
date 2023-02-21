<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Kerusakan_bahan extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_kerusakan_bahan');
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
            $data['jabatan'] = $this->Mod_fungsi->get_jabatan();
            $this->template->load('layoutbackend','kerusakan_bahan/index',$data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $list = $this->Mod_kerusakan_bahan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pel) {

            $no++;
            $row = array();
            $row[] = $pel->nama_bahan;
            $row[] = $pel->nama;
            $row[] = $pel->stok_out;
            $row[] = $pel->nama_satuan;
            $row[] = $pel->kondisi;
            $row[] = $pel->tgl_input;
            $row[] = $pel->keterangan;
            $row[] = "<a class=\"btn btn-xs btn-outline-primary edit\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit('$pel->id_kerusakan_bahan')\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger delete\" href=\"javascript:void(0)\" title=\"Delete\"  onclick=\"hapus('$pel->id_kerusakan_bahan')\"><i class=\"fas fa-trash\"></i></a>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_kerusakan_bahan->count_all(),
            "recordsFiltered" => $this->Mod_kerusakan_bahan->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {

        $id_user = $this->session->userdata['id_user'];
        $id_jurusan = $this->session->userdata['id_jurusan'];
        $this->_validate();
        if(!empty($_FILES['imagefile']['name'])) {
        // 
            $id = $this->input->post('id_user');

            $nama = encrypt_url($this->input->post('nama'));
            $config['upload_path']   = './assets/foto/kerusakan_bahan/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '1000';
            $config['max_width']     = '2000';
            $config['max_height']    = '1024';
            $config['file_name']     = $nama; 
            
            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')){
             $gambar = $this->upload->data();
             $save  = array(
                'nama'         => htmlspecialchars_decode(ucwords($this->input->post('nama'))),
                // 'id_jabatan'    => $this->input->post('id_jabatan'),
                'id_bahan'    => $this->input->post('id_bahan'),
                'id_satuan'    => $this->input->post('id_satuan'),
                'id_kondisi'    => $this->input->post('id_kondisi'),
                'tgl_input'    => $this->input->post('tgl_input'),
                'stok_out'    => $this->input->post('stok_out'),
                'keterangan'    => $this->input->post('keterangan'),
                'id_user'    => $id_user,
                'id_jurusan' => $id_jurusan,
                'foto'         => $gambar['file_name'],

            );
             $this->Mod_kerusakan_bahan->insert("kerusakan_bahan", $save);
             echo json_encode(array("status" => TRUE));
         }
     }

 }

 public function update()
 {
        // $this->_validate();
    $id      = $this->input->post('id');
    if(!empty($_FILES['imagefile']['name'])) {
        // $this->_validate();
        $id = $this->input->post('id_user');

        $nama = encrypt_url($this->input->post('nama'));
        $config['upload_path']   = './assets/foto/kerusakan_bahan/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '1000';
            $config['max_width']     = '2000';
            $config['max_height']    = '1024';
            $config['file_name']     = $nama; 
            
            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')){
               $gambar = $this->upload->data();
               $save  = array(
                'nama'         => htmlspecialchars_decode(ucwords($this->input->post('nama'))),
                // 'id_jabatan'    => $this->input->post('id_jabatan'),
                'id_bahan'    => $this->input->post('id_bahan'),
                'id_satuan'    => $this->input->post('id_satuan'),
                'id_kondisi'    => $this->input->post('id_kondisi'),
                'tgl_input'    => $this->input->post('tgl_input'),
                'stok_out'    => $this->input->post('stok_out'),
                'keterangan'    => $this->input->post('keterangan'),
                'foto'         => $gambar['file_name'],
            );

               $g = $this->Mod_kerusakan_bahan->getImage($id)->row();

               if (!empty($g->foto) || $g->foto != NULL) {
                //hapus gambar yg ada diserver
                unlink('assets/foto/kerusakan_bahan/'.$g->foto);
            }

            $this->Mod_kerusakan_bahan->update($id, $save);
            echo json_encode(array("status" => TRUE));
        }
    }else{
        $save  = array(
            'nama'         => htmlspecialchars_decode(ucwords($this->input->post('nama'))),
                // 'id_jabatan'    => $this->input->post('id_jabatan'),
            'id_bahan'    => $this->input->post('id_bahan'),
            'id_satuan'    => $this->input->post('id_satuan'),
            'id_kondisi'    => $this->input->post('id_kondisi'),
            'tgl_input'    => $this->input->post('tgl_input'),
            'stok_out'    => $this->input->post('stok_out'),
            'keterangan'    => $this->input->post('keterangan'),
        );
        $this->Mod_kerusakan_bahan->update($id, $save);
        echo json_encode(array("status" => TRUE));
    }

}


public function edit($id)
{
    $data = $this->Mod_kerusakan_bahan->get($id);
    echo json_encode($data);
}

public function delete()
{
    $id = $this->input->post('id');
    $g = $this->Mod_kerusakan_bahan->getImage($id)->row();

    if (!empty($g->foto) || $g->foto != NULL) {
                //hapus gambar yg ada diserver
        unlink('assets/foto/kerusakan_bahan/'.$g->foto);
    }
    $this->Mod_kerusakan_bahan->delete($id, 'kerusakan_bahan');        
    echo json_encode(array("status" => TRUE));
}
private function _validate()
{
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    
    if(empty($_FILES['imagefile']['name']))
    {
        $data['inputerror'][] = 'imagefile';
        $data['error_string'][] = 'Foto Wajib Dilampirkan';
        $data['status'] = FALSE;
    }

    if($data['status'] === FALSE)
    {
        echo json_encode($data);
        exit();
    }
}

public function get_bahan_by_id()
{
    $id = $this->input->post('id_bahan');
    $bahan = $this->Mod_fungsi->get_bahan_by_id($id)->row();
    echo json_encode($bahan);
}
public function get_bahan_bar()
{
    $barcode = $this->input->post('barcode');
    $data = $this->Mod_fungsi->get_bahan_bar($barcode)->row();
    echo json_encode($data);

}
public function get_bahan()
{
    $nama = $this->input->get('term');
    $data = $this->Mod_fungsi->get_bahan($nama);
    if (count($data->result()) > 0) {

        foreach ($data->result() as $row){
            $arr_result[] = array( 'value' => $row->id_bahan, 'label'  => $row->nama_bahan, 'id_satuan' => $row->id_satuan, 'id_kondisi' => $row->id_kondisi, 'stok' => $row->stok, );
        } 
        echo json_encode($arr_result);
    }else{
        $arr_result = array( 'label'  => "Data Tidak di Temukan" );
        echo json_encode($arr_result);
    }
}
}