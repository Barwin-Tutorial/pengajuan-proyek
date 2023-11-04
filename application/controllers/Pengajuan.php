<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/**
 * 
 */
class Pengajuan extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_pengajuan','Mod_dashboard'));

    }

    public function index()
    {
        $this->load->helper('url');
        $data['dokumen'] = $this->Mod_pengajuan->getAll();

        $link = $this->uri->segment(1);
        $level = $this->session->userdata['id_level'];
        // Cek Posisi Menu apakah Sub Menu Atau bukan
        $jml = $this->Mod_dashboard->get_akses_menu($link,$level)->num_rows();;
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
            $this->template->load('layoutbackend', 'pengajuan', $data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $level = $this->session->userdata['id_level'];
        $list = $this->Mod_pengajuan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $dokumen) {
            if ($dokumen->upload1==null) {
                $upload1="<a class=\"btn btn-xs btn-outline-primary edit\" href=\"javascript:void(0)\" title=\"Upload Anggaran\" onclick=\"edit('$dokumen->id_dokumen')\"><i class=\"fas fa-upload\"></i> Upload</a>";
            } else {
                $upload1= '<a download href="assets/dokumen/'.$dokumen->upload1.'" target="_blank">Download Anggaran</a>';
            }

            if ($dokumen->status=='1') {
                $status ='<span class="badge badge-info">Diajukan</span>';
            }elseif ($dokumen->status=='2') {
                $status ='<span class="badge badge-success">Disetujui</span>';
            }elseif ($dokumen->status=='3') {
                $status ='<span class="badge badge-danger">Ditolak</span>';
            }else{
                $status ='<span class="badge badge-secondary ">Proses</span>';
            }
            
            
            $no++;
            $row = array();
            $row[] = $dokumen->judul;
            $row[] = $dokumen->user_upload;
            $row[] = $dokumen->pengaju;
            $row[] = $dokumen->setuju;
            $row[] = '<a download href="assets/dokumen/'.$dokumen->upload.'" target="_blank">Download Dokumen</a>';
            $row[] = $upload1;
            $row[] = $dokumen->keterangan;
            $row[] = $status;
            if ($level=='8') {
                   $row[] = "<a class=\"btn btn-xs btn-outline-primary edit\" href=\"javascript:void(0)\" title=\"Upload Anggaran\" onclick=\"edit('$dokumen->id_dokumen')\"><i class=\"fas fa-upload\"></i> Upload</a>";
            }elseif ($level=='9') {
                   $row[] = "<a class=\"btn btn-xs btn-outline-primary \" href=\"javascript:void(0)\" title=\"Setujui / Tolak\" onclick=\"aksi('$dokumen->id_dokumen')\"> Setujui / Tolak</a>";
            }else{
                $row[]='';
            }
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_pengajuan->count_all(),
            "recordsFiltered" => $this->Mod_pengajuan->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

      

        public function edit($id)
        {

            $data = $this->Mod_pengajuan->get($id);
            echo json_encode($data);

        }


        public function update()
        {
        // $this->_validate();
            $id_user = $this->session->userdata['id_user'];
            $id = $this->input->post('id');
            if(!empty($_FILES['file']['name'])) {

                $config['upload_path']   = './assets/dokumen/';
            $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|xml|html'; //mencegah upload backdor
            $config['overwrite']            = true;
            $config['max_size']             = 2048; // 2MB

            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')){
                $gambar = $this->upload->data();

                $save  = array(
                    'user_pengaju' => $id_user,
                    'tgl_diajukan' => date("Y-m-d"),
                    'status' => '1',
                    'upload1' => $gambar['file_name']
                );



                $g = $this->Mod_pengajuan->get_file_name($id)->row_array();

                if (!empty($g['upload1'])) {
                //hapus gambar yg ada diserver
                    unlink('assets/dokumen/'.$g['upload1']);
                }


                $this->Mod_pengajuan->update($id, $save);
                echo json_encode(array("status" => TRUE));
            }
        }
    }


       public function aksi()
        {
        // $this->_validate();
            $id_user = $this->session->userdata['id_user'];
            $id = $this->input->post('id');
             $aksi = $this->input->post('aksi');
             if ($aksi=='tolak') {
                 $st='3';
             } 
             if ($aksi=='setuju')  {
                $st='2';
             }
             

                $save  = array(
                    'user_setuju' => $id_user,
                    'tgl_setuju' => date("Y-m-d"),
                    'status' => $st,
                );

                $this->Mod_pengajuan->update($id, $save);
                echo json_encode(array("status" => TRUE));
        
    }

    public function delete(){
        $id = $this->input->post('id');
        $g = $this->Mod_pengajuan->get_file_name($id)->row_array();
        if ($g['upload1'] != null || $g['upload1'] != "") {
            //hapus gambar yg ada diserver
            unlink('assets/dokumen/'.$g['upload1']);
        }
        $this->Mod_pengajuan->delete($id, 'tbl_dokumen');
        $data['status'] = TRUE;
        echo json_encode($data);
    }




  
}