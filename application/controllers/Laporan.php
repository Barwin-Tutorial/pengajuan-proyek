<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Laporan extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_laporan');
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
            $this->template->load('layoutbackend','laporan/laporan',$data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }



    public function laporan()
    {
        $data['act'] = $this->input->post('act');
        $tglrange =$this->input->post('tgl');
        $data['lap'] = $this->Mod_laporan->get_laporan_projek($tglrange)->result();
        $this->load->view('projek/cetak',$data);
    }

    public function cetak_pdf()
    {
        $tglrange =$this->input->post('tgl');
        $data['lap'] = $this->Mod_laporan->get_laporan_projek($tglrange)->result();
        $data['act'] = $this->input->post('act');
        $date=date('ymdhis');
        $namafile='lap_projek_'.$date.'.pdf';
        // fungsi pdf dari library di autoload
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = $namafile;
        $this->pdf->load_view('projek/cetak', $data);
    }

    public function lap_excel()
    {

        $tglrange =$this->input->post('tgl');
        $list = $this->Mod_laporan->get_laporan_projek($tglrange)->result();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Tanggal');
        $sheet->setCellValue('C1', 'Nama Projek');
        $sheet->setCellValue('D1', 'Nama Klien');
        $sheet->setCellValue('E1', 'Tanggal Mulai');
        $sheet->setCellValue('F1', 'Tanggal Selesai');
        $sheet->setCellValue('G1', 'Status');
        $sheet->setCellValue('H1', 'Keterangan');
        $no = 1;
        $x = 2;
        foreach($list as $row)
        {
            $sheet->setCellValue('A'.$x, $no++);
            $sheet->setCellValue('B'.$x, tgl_indonesia($row->tgl_input));
            $sheet->setCellValue('C'.$x, $row->nama_projek);
            $sheet->setCellValue('D'.$x, $row->nama_klien);
            $sheet->setCellValue('E'.$x, $row->tgl_mulai);
            $sheet->setCellValue('F'.$x, $row->tgl_selesai);
            $sheet->setCellValue('G'.$x, $row->status);
            $sheet->setCellValue('H'.$x, htmlspecialchars_decode($row->keterangan,ENT_QUOTES));
            $x++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan_projek';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function word()
    {
     $filename = 'laporan_projek';
     header("Content-type: application/vnd.ms-word");
     header("Content-Disposition: attachment;Filename=".$filename.".doc");
     $data['act'] = $this->input->post('act');
     $tglrange =$this->input->post('tgl');
     $data['lap'] = $this->Mod_laporan->get_laporan_projek($tglrange)->result();
     $this->load->view('projek/cetak_word',$data);
 }
}