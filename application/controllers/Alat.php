<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Alat extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_alat');
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
            $data['merk'] = $this->Mod_fungsi->get_merk();
            $data['satuan'] = $this->Mod_fungsi->get_satuan();
            $data['ruang'] = $this->Mod_fungsi->get_ruang();
            $this->template->load('layoutbackend','alat/index',$data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $list = $this->Mod_alat->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pel) {

            $no++;
            $row = array();
            $row[] = $pel->barcode;
            $row[] = $pel->nama_alat;
            $row[] = $pel->nama_merk;
            $row[] = $pel->stok;
            $row[] = $pel->nama_satuan;
            $row[] = $pel->tgl_input;
            $row[] = $pel->photo;
            $row[] = $pel->kondisi;
            $row[] = $pel->nama_ruang;
            $row[] = $pel->keterangan;
            $row[] = "<a class=\"btn btn-xs btn-outline-primary edit\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit('$pel->id_alat')\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger delete\" href=\"javascript:void(0)\" title=\"Delete\"  onclick=\"hapus('$pel->id_alat')\"><i class=\"fas fa-trash\"></i></a>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_alat->count_all(),
            "recordsFiltered" => $this->Mod_alat->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {
        $id_user = $this->session->userdata['id_user'];
        $id_jurusan = $this->session->userdata['id_jurusan'];
        $m=date('m');
        $y=date('y');
        $trx= $this->Mod_alat->max_no($id_jurusan);
        if ($trx[0]['kode']==NULL) {
            $n="0001";
            $kode='A'.$id_jurusan.$y.$m.$n;
        }else{
            $n=$trx[0]['kode']+1;
            $x='0000'.$n;
            $kode='A'.$id_jurusan.$y.$m.substr($x, -4);
        }
        if(!empty($_FILES['imagefile']['name'])) {
        // $this->_validate();
            $id = $this->input->post('id_user');

            $nama = slug($this->input->post('nama_alat'));
            $config['upload_path']   = './assets/foto/alat/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '1000';
            $config['max_width']     = '2000';
            $config['max_height']    = '1024';
            $config['file_name']     = $nama; 
            
            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')){
             $gambar = $this->upload->data();
             $save  = array(
                'nama_alat'         => htmlspecialchars_decode(ucwords($this->input->post('nama_alat'))),
                'id_merk'         => htmlspecialchars_decode($this->input->post('id_merk')),
                'id_satuan'         => htmlspecialchars_decode($this->input->post('id_satuan')),
                'stok'         => htmlspecialchars_decode($this->input->post('stok')),
                'id_kondisi'         => htmlspecialchars_decode($this->input->post('id_kondisi')),
                'id_ruang'         => htmlspecialchars_decode($this->input->post('id_ruang')),
                'keterangan'         => htmlspecialchars_decode($this->input->post('keterangan')),
                'photo'         => $gambar['file_name'],
                'id_jurusan'    => $id_jurusan,
                'barcode'       => $kode

            );
             $this->Mod_alat->insert("alat", $save);
             echo json_encode(array("status" => TRUE));
         }
     }else{
         $save  = array(
            'nama_alat'         => htmlspecialchars_decode(ucwords($this->input->post('nama_alat'))),
            'id_merk'         => htmlspecialchars_decode($this->input->post('id_merk')),
            'id_satuan'         => htmlspecialchars_decode($this->input->post('id_satuan')),
            'stok'         => htmlspecialchars_decode($this->input->post('stok')),
            'id_kondisi'         => htmlspecialchars_decode($this->input->post('id_kondisi')),
            'id_ruang'         => htmlspecialchars_decode($this->input->post('id_ruang')),
            'keterangan'         => htmlspecialchars_decode($this->input->post('keterangan')),
            'id_jurusan'    => $id_jurusan,
            'barcode'       => $kode

        );
         $this->Mod_alat->insert("alat", $save);
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
        $config['upload_path']   = './assets/foto/alat/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']      = '1000';
        $config['max_width']     = '2000';
        $config['max_height']    = '1024';
        $config['file_name']     = $nama; 
        
        $this->upload->initialize($config);

        if ($this->upload->do_upload('imagefile')){
           $gambar = $this->upload->data();
           $save  = array(
            'nama_alat'         => htmlspecialchars_decode(ucwords($this->input->post('nama_alat'))),
            'id_merk'         => htmlspecialchars_decode($this->input->post('id_merk')),
            'id_satuan'         => htmlspecialchars_decode($this->input->post('id_satuan')),
            'stok'         => htmlspecialchars_decode($this->input->post('stok')),
            'id_kondisi'         => htmlspecialchars_decode($this->input->post('id_kondisi')),
            'id_ruang'         => htmlspecialchars_decode($this->input->post('id_ruang')),
            'keterangan'         => htmlspecialchars_decode($this->input->post('keterangan')),
            'photo'         => $gambar['file_name']

        );

           $this->Mod_alat->update($id, $save);
           echo json_encode(array("status" => TRUE));
       }
   }else{
    $save  = array(
        'nama_alat'         => htmlspecialchars_decode(ucwords($this->input->post('nama_alat'))),
        'id_merk'         => htmlspecialchars_decode($this->input->post('id_merk')),
        'id_satuan'         => htmlspecialchars_decode($this->input->post('id_satuan')),
        'stok'         => htmlspecialchars_decode($this->input->post('stok')),
        'id_kondisi'         => htmlspecialchars_decode($this->input->post('id_kondisi')),
        'id_ruang'         => htmlspecialchars_decode($this->input->post('id_ruang')),
        'keterangan'         => htmlspecialchars_decode($this->input->post('keterangan')),

    );
    $this->Mod_alat->update($id, $save);
    echo json_encode(array("status" => TRUE));
}

}

public function edit($id)
{
    $data = $this->Mod_alat->get($id);
    echo json_encode($data);
}

public function delete()
{
    $id = $this->input->post('id');
    $this->Mod_alat->delete($id, 'alat');        
    echo json_encode(array("status" => TRUE));
}
private function _validate()
{
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if($this->input->post('nama_alat') == '')
    {
        $data['inputerror'][] = 'nama_alat';
        $data['error_string'][] = 'Nama alat Tidak Boleh Kosong';
        $data['status'] = FALSE;
    }


    if($data['status'] === FALSE)
    {
        echo json_encode($data);
        exit();
    }
}
}