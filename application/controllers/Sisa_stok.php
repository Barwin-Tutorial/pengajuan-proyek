<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Sisa_stok extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_arus_stok','Mod_laporan'));
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
          $data['lap'] = $this->Mod_laporan->get_laporan_sisa();
            $this->template->load('layoutbackend','stok/sisa_stok',$data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }



    public function get_brg()
    {
        
       $id = $this->input->get('term');
        $data = $this->Mod_arus_stok->get_brg($id);
        if (count($data) > 0) {
            foreach ($data as $row) {
                $arr_result[] = array( 'label'  => $row->nama, 'produk_nama'  => $row->nama, 'id_barang' => $row->id, 'produk_harga' =>  $row->harga, 'id_kemasan' => $row->kemasan, 'nama_satuan' => $row->nama_satuan);
            }
            echo json_encode($arr_result);
        }else{
            $arr_result = array( 'produk_nama'  => "Data Tidak di Temukan" );
            echo json_encode($arr_result);
        }

    }

    public function laporan()
    {
        $id_barang=$this->input->post('id_barang');
        $tglrange =$this->input->post('tanggal');
        $perundangan =$this->input->post('perundangan');
        $data['act'] = "";
        $data['lap'] = $this->Mod_laporan->get_laporan($id_barang,$tglrange,$perundangan);
        $this->load->view('stok/laporan',$data);
    }


        public function laporan_xls()
    {
        $id_barang=$this->input->post('id_barang');
        $tglrange =$this->input->post('tanggal');
        $perundangan =$this->input->post('perundangan');
        $list = $this->Mod_laporan->get_laporan($id_barang,$tglrange,$perundangan)->result();
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', 'No');
      $sheet->setCellValue('B1', 'Transaksi');
      $sheet->setCellValue('C1', 'Tanggal');
      $sheet->setCellValue('D1', 'Nama Barang');
      $sheet->setCellValue('E1', 'Pelanggan');
      $sheet->setCellValue('F1', 'Supplier');
      $sheet->setCellValue('G1', 'No. Batch');
      $sheet->setCellValue('H1', 'Faktur Penerimaan');
      $sheet->setCellValue('I1', 'Masuk');
      $sheet->setCellValue('J1', 'Keluar');
      $sheet->setCellValue('K1', 'Sisa');
      $no = 1;
      $x = 2;
      foreach($list as $row)
      {
        $sisa= ($row->masuk-$row->keluar);
        $sheet->setCellValue('A'.$x, $no++);
        $sheet->setCellValue('B'.$x, $row->transaksi);
        $sheet->setCellValue('C'.$x, date("d/m/Y", strtotime($row->tanggal)));
        $sheet->setCellValue('D'.$x, $row->nama_barang);
        $sheet->setCellValue('E'.$x, $row->nama_pelanggan);
        $sheet->setCellValue('F'.$x, $row->nama_supplier);
        $sheet->setCellValue('G'.$x, $row->nobatch);
        $sheet->setCellValue('H'.$x, $row->faktur);
        $sheet->setCellValue('I'.$x, $row->masuk);
        $sheet->setCellValue('J'.$x, $row->keluar);
        $sheet->setCellValue('K'.$x, $sisa);
        $x++;
      }
      $writer = new Xlsx($spreadsheet);
      $filename = 'arus_stok';

      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'. $filename .'.xls"'); 
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
    }
}