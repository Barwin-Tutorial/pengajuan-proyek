<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Lap_kb extends MY_Controller
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
            $this->template->load('layoutbackend','laporan/lap_kb',$data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }

 /*   public function get_brg()
    {
        
       $id = $this->input->get('term');
        $data = $this->Mod_keluar->get_brg($id);
        if (count($data) > 0) {
            foreach ($data as $row) {
                $arr_result[] = array( 'label'  => $row->nama, 'produk_nama'  => $row->nama, 'id_barang' => $row->id, 'produk_harga' =>  $row->harga, 'id_kemasan' => $row->kemasan, 'nama_satuan' => $row->nama_satuan);
            }
            echo json_encode($arr_result);
        }else{
            $arr_result = array( 'produk_nama'  => "Data Tidak di Temukan" );
            echo json_encode($arr_result);
        }

    }*/

    public function laporan()
    {
        $group=$this->input->post('group');
        $tglrange =$this->input->post('tgl');
        $id_pelanggan =$this->input->post('id_pelanggan');
        
        $data['act'] = $group;
        $data['lap'] = $this->Mod_laporan->get_laporan_kb($tglrange,$id_pelanggan,$group);
        $this->load->view('laporan/vlap_kb',$data);
    }

        public function cetak()
    {
        $group=$this->input->post('group');
        $tglrange =$this->input->post('tgl');
        $id_pelanggan =$this->input->post('id_pelanggan');
        $data['act'] = $group;
        $data['lap'] = $this->Mod_laporan->get_laporan_kb($tglrange,$id_pelanggan,$group);
        $this->load->view('laporan/cetak_kb',$data);
    }

     public function lap_excel()
    {
        $group=$this->input->post('group');
        $tglrange =$this->input->post('tgl');
        $id_pelanggan =$this->input->post('id_pelanggan');
        $data['act'] = $group;
        $list = $this->Mod_laporan->get_laporan_kb($tglrange,$id_pelanggan,$group)->result();
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', 'No');
      $sheet->setCellValue('B1', 'Tanggal');
      $sheet->setCellValue('C1', 'Pelanggan');
      $sheet->setCellValue('D1', 'Nama Barang');
      $sheet->setCellValue('E1', 'Satuan');
      $sheet->setCellValue('F1', 'Ed');
      $sheet->setCellValue('G1', 'No Batch');
      $sheet->setCellValue('H1', 'Jumlah');
      $sheet->setCellValue('I1', 'Harga');
      $sheet->setCellValue('J1', 'Subtotal');
      $no = 1;
      $x = 2;
      foreach($list as $row)
      {
        $subt= ($row->harga*$row->jumlah);
        $sheet->setCellValue('A'.$x, $no++);
        $sheet->setCellValue('B'.$x, date("d/m/Y", strtotime($row->tanggal)));
        $sheet->setCellValue('C'.$x, $row->nama_pelanggan);
        $sheet->setCellValue('D'.$x, $row->nama_barang);
        $sheet->setCellValue('E'.$x, $row->nama_kemasan);
        $sheet->setCellValue('F'.$x, $row->ed);
        $sheet->setCellValue('G'.$x, $row->nobatch);
        $sheet->setCellValue('H'.$x, $row->jumlah);
        $sheet->setCellValue('I'.$x, $row->harga);
        $sheet->setCellValue('J'.$x, $subt);
        $x++;
      }
      $writer = new Xlsx($spreadsheet);
      $filename = 'laporan_barang_keluar';

      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'. $filename .'.xls"'); 
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
    }
}