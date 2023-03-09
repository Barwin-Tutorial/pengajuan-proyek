<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Perbaikan_alat extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_perbaikan_alat');
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
            $this->template->load('layoutbackend','perbaikan_alat/index',$data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $list = $this->Mod_perbaikan_alat->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pel) {

            $no++;
            $row = array();
            $row[] = $pel->nama_alat;
            // $row[] = $pel->nama;
            $row[] = $pel->stok;
            $row[] = $pel->nama_satuan;
            $row[] = $pel->kondisi;
            $row[] = $pel->tgl_masuk;
            $row[] = $pel->keterangan;
            $row[] = "<a class=\"btn btn-xs btn-outline-primary edit\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit('$pel->id_perbaikan_alat')\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger delete\" href=\"javascript:void(0)\" title=\"Delete\"  onclick=\"hapus('$pel->id_perbaikan_alat')\"><i class=\"fas fa-trash\"></i></a>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_perbaikan_alat->count_all(),
            "recordsFiltered" => $this->Mod_perbaikan_alat->count_filtered(),
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

            $nama = encrypt_url($this->input->post('id_alat'));
            $config['upload_path']   = './assets/foto/images/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '1000';
            $config['max_width']     = '2000';
            $config['max_height']    = '1024';
            $config['file_name']     = $nama; 
            
            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')){
               $gambar = $this->upload->data();
               $save  = array(
                // 'nama'         => htmlspecialchars_decode(ucwords($this->input->post('nama'))),
                // 'id_jabatan'    => $this->input->post('id_jabatan'),
                'id_alat'    => $this->input->post('id_alat'),
                'id_satuan'    => $this->input->post('id_satuan'),
                'id_kondisi'    => $this->input->post('id_kondisi'),
                'tgl_masuk'    => $this->input->post('tgl_masuk'),
                'tgl_keluar'    => $this->input->post('tgl_keluar'),
                'stok'    => $this->input->post('stok_out'),
                'keterangan'    => $this->input->post('keterangan'),
                'id_user'    => $id_user,
                'id_jurusan' => $id_jurusan,
                'foto'         => $gambar['file_name'],

            );
               $this->Mod_perbaikan_alat->insert("perbaikan_alat", $save);
               echo json_encode(array("status" => TRUE));
           }
       }

   }

   public function update()
   {
        // $this->_validate();
    $id      = $this->input->post('id');
    $id_kondisi = $this->input->post('id_kondisi');
    $id_alat = $this->input->post('id_alat');

    if(!empty($_FILES['imagefile']['name'])) {
        // $this->_validate();

        $nama = encrypt_url($this->input->post('id_alat'));
        $config['upload_path']   = './assets/foto/images/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '1000';
            $config['max_width']     = '2000';
            $config['max_height']    = '1024';
            $config['file_name']     = $nama; 
            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')){
             $gambar = $this->upload->data();
             $save  = array(
                // 'nama'         => htmlspecialchars_decode(ucwords($this->input->post('nama'))),
                // 'id_jabatan'    => $this->input->post('id_jabatan'),
                'id_alat'    => $this->input->post('id_alat'),
                'id_satuan'    => $this->input->post('id_satuan'),
                'id_kondisi'    => $this->input->post('id_kondisi'),
                'tgl_masuk'    => $this->input->post('tgl_masuk'),
                'tgl_keluar'    => $this->input->post('tgl_keluar'),
                'stok'    => $this->input->post('stok_out'),
                'keterangan'    => $this->input->post('keterangan'),
                'foto'         => $gambar['file_name'],
            );

             $g = $this->Mod_perbaikan_alat->getImage($id)->row();

             if (!empty($g->foto) || $g->foto != NULL) {
                //hapus gambar yg ada diserver
                unlink('assets/foto/perbaikan_alat/'.$g->foto);
            }


            $this->Mod_perbaikan_alat->update($id, $save);
            echo json_encode(array("status" => TRUE));


        }


    }else{
        $save  = array(
            // 'nama'         => htmlspecialchars_decode(ucwords($this->input->post('nama'))),
                // 'id_jabatan'    => $this->input->post('id_jabatan'),
            'id_alat'    => $this->input->post('id_alat'),
            'id_satuan'    => $this->input->post('id_satuan'),
            'id_kondisi'    => $this->input->post('id_kondisi'),
            'tgl_keluar'    => $this->input->post('tgl_keluar'),
            'tgl_masuk'    => $this->input->post('tgl_masuk'),
            'stok'    => $this->input->post('stok_out'),
            'keterangan'    => $this->input->post('keterangan'),
        );
        $this->Mod_perbaikan_alat->update($id, $save);
        echo json_encode(array("status" => TRUE));



    }

    if ($id_kondisi=='3') {
        $r=$this->Mod_fungsi->get_alat_by_id($id_alat)->row();
        $stok =$r->stok;
        $stok_in=$this->input->post('stok_out');
        $jml_stok=$stok+$stok_in;
        $save  = array(
            'stok'    => $jml_stok,
        );
        $this->Mod_perbaikan_alat->update_stok($id_alat, $save);
    }

    if ($id_kondisi=='2') {
       $id_user = $this->session->userdata['id_user'];
       $id_jurusan = $this->session->userdata['id_jurusan'];
       $data = $this->Mod_perbaikan_alat->get($id);
       $save1  = array(
        'id_alat'    => $this->input->post('id_alat'),
        'id_satuan'    => $this->input->post('id_satuan'),
        'id_kondisi'    => $this->input->post('id_kondisi'),
        'tgl_input'    => $this->input->post('tgl_masuk'),
        'stok_out'    => $this->input->post('stok_out'),
        'keterangan'    => $this->input->post('keterangan'),
        'id_user'    => $id_user,
        'id_jurusan' => $id_jurusan,
        'foto' => $data->foto
    );
       $this->Mod_perbaikan_alat->insert("kerusakan_alat", $save1);
   }

}


public function edit($id)
{
    $data = $this->Mod_perbaikan_alat->get($id);
    echo json_encode($data);
}

public function delete()
{
    $id = $this->input->post('id');
    $g = $this->Mod_perbaikan_alat->getImage($id)->row();

    if (!empty($g->foto) || $g->foto != NULL) {
                //hapus gambar yg ada diserver
        unlink('assets/foto/images/'.$g->foto);
    }
    $this->Mod_perbaikan_alat->delete($id, 'perbaikan_alat');        
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

public function get_alat_by_id()
{
    $id = $this->input->post('id_alat');
    $alat = $this->Mod_fungsi->get_alat_by_id($id)->row();
    echo json_encode($alat);
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
            $arr_result[] = array( 'value' => $row->id_alat, 'label'  => $row->nama_alat, 'id_satuan' => $row->id_satuan, 'id_kondisi' => $row->id_kondisi, 'stok' => $row->stok, );
        } 
        echo json_encode($arr_result);
    }else{
        $arr_result = array( 'label'  => "Data Tidak di Temukan" );
        echo json_encode($arr_result);
    }
}
}