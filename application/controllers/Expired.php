<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Expired extends MY_Controller
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
            $data['lap'] = $this->Mod_laporan->get_expired();
            $this->template->load('layoutbackend','laporan/expired',$data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }



    public function lap_expired_xls()
    {
        $id_barang=$this->input->post('id_barang');
        $tglrange =$this->input->post('tanggal');
        $perundangan =$this->input->post('perundangan');
        $list = $this->Mod_laporan->get_expired()->result();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Barang');
        $sheet->setCellValue('C1', 'ED');
        $sheet->setCellValue('D1', 'BATCH');
        $sheet->setCellValue('E1', 'Sisa');
        $sheet->setCellValue('F1', 'Berat');
        $no = 1;
        $x = 2;
        foreach($list as $row)
        {
            $sisa= ($row->masuk-$row->keluar);
            $sheet->setCellValue('A'.$x, $no++);
            $sheet->setCellValue('B'.$x, $row->nama_barang);
            $sheet->setCellValue('C'.$x, date("d/m/Y", strtotime($row->ed)));
            $sheet->setCellValue('D'.$x, $row->nobatch);
            $sheet->setCellValue('E'.$x, $row->sisa);
            $sheet->setCellValue('F'.$x, $row->berat);
            $x++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan_expired';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xls"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    
}