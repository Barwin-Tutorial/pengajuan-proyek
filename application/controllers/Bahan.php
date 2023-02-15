<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Bahan extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_bahan');
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
            // $data['kondisi'] = $this->Mod_fungsi->get_kondisi();
            $data['merk'] = $this->Mod_fungsi->get_merk();
            $data['satuan'] = $this->Mod_fungsi->get_satuan();
            // $data['ruang'] = $this->Mod_fungsi->get_ruang();
            $this->template->load('layoutbackend','bahan/index',$data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $list = $this->Mod_bahan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pel) {

            $no++;
            $row = array();
            $row[] = "<a download=\"".$pel->barcode.".png"."\" href=\"./assets/foto/bahan/\" title=\"Download QR Code\">
                <img alt=\"Download QR Code\" src=\"./assets/foto/bahan/".$pel->barcode.".png"."\" width=\"50px\" height=\"50px\"> </a>";
            $row[] = $pel->nama_bahan;
            $row[] = $pel->stok;
            $row[] = "<img src=\"./assets/foto/bahan/".$pel->photo."\" width=\"50px\" height=\"50px\">";
            $row[] = $pel->keterangan;
            $row[] = "<a class=\"btn btn-xs btn-outline-primary edit\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit('$pel->id_bahan')\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger delete\" href=\"javascript:void(0)\" title=\"Delete\"  onclick=\"hapus('$pel->id_bahan')\"><i class=\"fas fa-trash\"></i></a> ";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_bahan->count_all(),
            "recordsFiltered" => $this->Mod_bahan->count_filtered(),
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
        $trx= $this->Mod_bahan->max_no($id_jurusan);
        if ($trx[0]['kode']==NULL) {
            $n="0001";
            $kode='B'.$id_jurusan.$y.$m.$n;
        }else{
            $n=$trx[0]['kode']+1;
            $x='0000'.$n;
            $kode='B'.$id_jurusan.$y.$m.substr($x, -4);
        }


        
        if(!empty($_FILES['imagefile']['name'])) {
        // $this->_validate();
            $id = $this->input->post('id_user');

            $nama = slug($this->input->post('nama_bahan'));
            $config['upload_path']   = './assets/foto/bahan/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '1000';
            $config['max_width']     = '2000';
            $config['max_height']    = '1024';
            $config['file_name']     = $nama; 
            
            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')){
               $gambar = $this->upload->data();
               $save  = array(
                'nama_bahan'         => htmlspecialchars_decode(ucwords($this->input->post('nama_bahan'))),
                'id_merk'         => htmlspecialchars_decode($this->input->post('id_merk')),
                'id_satuan'         => htmlspecialchars_decode($this->input->post('id_satuan')),
                'stok'         => htmlspecialchars_decode($this->input->post('stok')),
                /*'id_kondisi'         => htmlspecialchars_decode($this->input->post('id_kondisi')),
                'id_ruang'         => htmlspecialchars_decode($this->input->post('id_ruang')),*/
                'keterangan'         => htmlspecialchars_decode($this->input->post('keterangan')),
                'photo'         => $gambar['file_name'],
                'id_user'       => $id_user,
                'id_jurusan'    => $id_jurusan,
                'barcode'       => $kode

            );
               $this->Mod_bahan->insert("bahan", $save);
               echo json_encode(array("status" => TRUE));
           }
       }else{
           $save  = array(
            'nama_bahan'         => htmlspecialchars_decode(ucwords($this->input->post('nama_bahan'))),
            'id_merk'         => htmlspecialchars_decode($this->input->post('id_merk')),
            'id_satuan'         => htmlspecialchars_decode($this->input->post('id_satuan')),
            'stok'         => htmlspecialchars_decode($this->input->post('stok')),
            /*'id_kondisi'         => htmlspecialchars_decode($this->input->post('id_kondisi')),
            'id_ruang'         => htmlspecialchars_decode($this->input->post('id_ruang')),*/
            'keterangan'         => htmlspecialchars_decode($this->input->post('keterangan')),
            'id_jurusan'    => $id_jurusan,
            'barcode'       => $kode

        );
           $this->Mod_bahan->insert("bahan", $save);
           echo json_encode(array("status" => TRUE));
       }

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/foto/bahan/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
        $image_name=$kode.'.png'; 
        $params['data'] = $kode; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE


    }

    public function update()
    {
        // $this->_validate();
        $id      = $this->input->post('id');
        if(!empty($_FILES['imagefile']['name'])) {
        // $this->_validate();
            $id = $this->input->post('id_user');

            $nama = slug($this->input->post('nama_guru'));
            $config['upload_path']   = './assets/foto/bahan/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']      = '1000';
        $config['max_width']     = '2000';
        $config['max_height']    = '1024';
        $config['file_name']     = $nama; 
        
        $this->upload->initialize($config);

        if ($this->upload->do_upload('imagefile')){
         $gambar = $this->upload->data();
         $save  = array(
            'nama_bahan'         => htmlspecialchars_decode(ucwords($this->input->post('nama_bahan'))),
            'id_merk'         => htmlspecialchars_decode($this->input->post('id_merk')),
            'id_satuan'         => htmlspecialchars_decode($this->input->post('id_satuan')),
            'stok'         => htmlspecialchars_decode($this->input->post('stok')),
            /*'id_kondisi'         => htmlspecialchars_decode($this->input->post('id_kondisi')),
            'id_ruang'         => htmlspecialchars_decode($this->input->post('id_ruang')),*/
            'keterangan'         => htmlspecialchars_decode($this->input->post('keterangan')),
            'photo'         => $gambar['file_name']

        );

         $g = $this->Mod_bahan->getImage($id)->row();

         if (!empty($g->photo) || $g->photo != NULL) {
                //hapus gambar yg ada diserver
            unlink('assets/foto/bahan/'.$g->photo);
        }

        $this->Mod_bahan->update($id, $save);
        echo json_encode(array("status" => TRUE));
    }
}else{
    $save  = array(
        'nama_bahan'         => htmlspecialchars_decode(ucwords($this->input->post('nama_bahan'))),
        'id_merk'         => htmlspecialchars_decode($this->input->post('id_merk')),
        'id_satuan'         => htmlspecialchars_decode($this->input->post('id_satuan')),
        'stok'         => htmlspecialchars_decode($this->input->post('stok')),
        /*'id_kondisi'         => htmlspecialchars_decode($this->input->post('id_kondisi')),
        'id_ruang'         => htmlspecialchars_decode($this->input->post('id_ruang')),*/
        'keterangan'         => htmlspecialchars_decode($this->input->post('keterangan')),

    );
    $this->Mod_bahan->update($id, $save);
    echo json_encode(array("status" => TRUE));
}

}

public function edit($id)
{
    $data = $this->Mod_bahan->get($id);
    echo json_encode($data);
}

public function delete()
{
    $id = $this->input->post('id');
    $g = $this->Mod_bahan->getImage($id)->row();
    if (!empty($g->photo) || $g->photo != NULL) {
        unlink('assets/foto/bahan/'.$g->photo);
        unlink('assets/foto/bahan/'.$g->barcode.'.png');
    }
    $this->Mod_bahan->delete($id, 'bahan');        
    echo json_encode(array("status" => TRUE));
}
private function _validate()
{
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if($this->input->post('nama_bahan') == '')
    {
        $data['inputerror'][] = 'nama_bahan';
        $data['error_string'][] = 'Nama bahan Tidak Boleh Kosong';
        $data['status'] = FALSE;
    }


    if($data['status'] === FALSE)
    {
        echo json_encode($data);
        exit();
    }
}

public function get_satuan_by_nama()
{
    $nama = $this->input->get('term');
    $data = $this->Mod_fungsi->get_satuan_by_nama($nama);
    if (count($data->result()) > 0) {

        foreach ($data->result() as $row){
            $arr_result[] = array( 'value' => $row->id, 'label'  => $row->nama_satuan,  );
        } 
        echo json_encode($arr_result);
    }else{
        $arr_result = array( 'label'  => "Data Tidak di Temukan" );
        echo json_encode($arr_result);
    }
}

public function get_merk_by_nama()
{
    $nama = $this->input->get('term');
    $data = $this->Mod_fungsi->get_merk_by_nama($nama);
    if (count($data->result()) > 0) {

        foreach ($data->result() as $row){
            $arr_result[] = array( 'value' => $row->id_merk, 'label'  => $row->nama_merk,  );
        } 
        echo json_encode($arr_result);
    }else{
        $arr_result = array( 'label'  => "Data Tidak di Temukan" );
        echo json_encode($arr_result);
    }
}

}