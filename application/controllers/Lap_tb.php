<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Lap_tb extends MY_Controller
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
            $this->template->load('layoutbackend','laporan/lap_tb',$data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }
        public function laporan()
    {
        $id_supplier=$this->input->post('supplier');
        $tglrange =$this->input->post('tgl');
        $faktur =$this->input->post('faktur');
        $data['act'] = "";
        $data['lap'] = $this->Mod_laporan->get_laporan_tb($id_supplier,$tglrange,$faktur);
        $this->load->view('laporan/vlap_tb',$data);
    }
    
       public function lap_excel()
    {
        $id_supplier=$this->input->post('supplier');
        $tglrange =$this->input->post('tgl');
        $faktur =$this->input->post('faktur');
        $list = $this->Mod_laporan->get_laporan_tb($id_supplier,$tglrange,$faktur)->result();
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', 'No');
      $sheet->setCellValue('B1', 'Faktur');
      $sheet->setCellValue('C1', 'Tanggal');
      $sheet->setCellValue('D1', 'Supplier');
      $sheet->setCellValue('E1', 'Nama Barang');
      $sheet->setCellValue('F1', 'Kemasan');
      $sheet->setCellValue('G1', 'Ed');
      $sheet->setCellValue('H1', 'No Batch');
      $sheet->setCellValue('I1', 'Jumlah');
      $sheet->setCellValue('J1', 'Harga');
      $sheet->setCellValue('K1', 'Subtotal');
      $no = 1;
      $x = 2;
      foreach($list as $row)
      {
        $subt= ($row->harga*$row->jumlah);
        $sheet->setCellValue('A'.$x, $no++);
        $sheet->setCellValue('B'.$x, $row->faktur);
        $sheet->setCellValue('C'.$x, date("d/m/Y", strtotime($row->tanggal)));
        $sheet->setCellValue('D'.$x, $row->nama_supplier);
        $sheet->setCellValue('E'.$x, $row->nama_barang);
        $sheet->setCellValue('F'.$x, $row->nama_kemasan);
        $sheet->setCellValue('G'.$x, $row->ed);
        $sheet->setCellValue('H'.$x, $row->nobatch);
        $sheet->setCellValue('I'.$x, $row->jumlah);
        $sheet->setCellValue('J'.$x, $row->harga);
        $sheet->setCellValue('K'.$x, $subt);
        $x++;
      }
      $writer = new Xlsx($spreadsheet);
      $filename = 'laporan_penerimaan';

      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'. $filename .'.xls"'); 
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
    }
}