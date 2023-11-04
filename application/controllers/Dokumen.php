<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/**
 * 
 */
class Dokumen extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_dokumen','Mod_dashboard'));

    }

    public function index()
    {
        $this->load->helper('url');
        $data['dokumen'] = $this->Mod_dokumen->getAll();

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
            $this->template->load('layoutbackend', 'dokumen', $data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $list = $this->Mod_dokumen->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $dokumen) {
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
            $row[] = '<a download href="assets/dokumen/'.$dokumen->upload.'" target="_blank">Download</a>';
            $row[] = $dokumen->keterangan; 
            $row[] = $status;
            $row[] = "<a class=\"btn btn-xs btn-outline-primary edit\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit('$dokumen->id_dokumen')\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger delete\" href=\"javascript:void(0)\" title=\"Delete\"  onclick=\"hapus('$dokumen->id_dokumen')\"><i class=\"fas fa-trash\"></i></a>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_dokumen->count_all(),
            "recordsFiltered" => $this->Mod_dokumen->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {
       // var_dump($this->input->post('dokumenname'));
        $this->_validate();
        $id_user = $this->session->userdata['id_user'];

        
        $config['upload_path']   = './assets/dokumen/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|xml|html|xls|xlsx'; //mencegah upload backdor
        $config['overwrite']            = true;
        $config['max_size']             = 2048; // 2MB
        
        $this->upload->initialize($config);
        
        if ($this->upload->do_upload('file')){
            $gambar = $this->upload->data();

            $save  = array(
                'judul' => $this->input->post('judul'),
                'keterangan' => $this->input->post('keterangan'),
                'user_input'  => $id_user,
                'upload' => $gambar['file_name']
            );

            $this->Mod_dokumen->insert("tbl_dokumen", $save);
            echo json_encode(array("status" => TRUE));
        }

        }

      

        public function edit($id)
        {

            $data = $this->Mod_dokumen->get($id);
            echo json_encode($data);

        }


        public function update()
        {
        // $this->_validate();
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
                    'judul' => $this->input->post('judul'),
                    'keterangan' => $this->input->post('keterangan'),
                    'upload' => $gambar['file_name']
                );



                $g = $this->Mod_dokumen->get_file_name($id)->row_array();

                if (!empty($g['upload'])) {
                //hapus gambar yg ada diserver
                    unlink('assets/dokumen/'.$g['upload']);
                }


                $this->Mod_dokumen->update($id, $save);
                echo json_encode(array("status" => TRUE));
            }
        }
    }

    public function delete(){
        $id = $this->input->post('id');
        $g = $this->Mod_dokumen->get_file_name($id)->row_array();
        if ($g['upload'] != null || $g['upload'] != "") {
            //hapus gambar yg ada diserver
            unlink('assets/dokumen/'.$g['upload']);
        }
        $this->Mod_dokumen->delete($id, 'tbl_dokumen');
        $data['status'] = TRUE;
        echo json_encode($data);
    }

   public function download_pdf()
    {
        // die($tglrange);
        $tglrange =$this->input->get('tgl');
        $data['tgl'] = $tglrange;
        $data['lap'] = $this->Mod_dokumen->get_laporan($tglrange)->result();
        $date=date('ymdhis');
        $namafile='laporan_proyek'.$date;
      
        // setting paper
      $paper = 'A4'; 
        //orientasi paper potrait / landscape
      $orientation = "landscape";
      $html = $this->load->view('laporan',$data, true);     
      
        // run dompdf
      $this->pdfgenerator->generate($html, $namafile,$paper,$orientation);
      // exit();
    }
    public function download()
    {

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Judul');
        $sheet->setCellValue('C1', 'File Upload');
        $sheet->setCellValue('D1', 'Keterangan');

        $dokumen = $this->Mod_dokumen->getAll()->result();
        $no = 1;
        $x = 2;
        foreach($dokumen as $row)
        {
            $sheet->setCellValue('A'.$x, $no++);
            $sheet->setCellValue('B'.$x, $row->judul);
            $sheet->setCellValue('C'.$x, $row->upload);
            $sheet->setCellValue('D'.$x, $row->keterangan);
            $x++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan-dokumen';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }


    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('judul') == '')
        {
            $data['inputerror'][] = 'judul';
            $data['error_string'][] = 'Judul Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}