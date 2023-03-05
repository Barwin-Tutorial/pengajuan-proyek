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
            $data['ruang'] = $this->Mod_fungsi->get_ruang();
            $this->template->load('layoutbackend','laporan/laporan',$data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }



    public function cetak_pinjam_alat()
    {
        $tglrange =$this->input->post('tgl');
        $id_ruang =$this->input->post('id_ruang');
        $data['tgl'] = $this->input->post('tgl');
        $data['lap'] = $this->Mod_laporan->get_laporan_pinjam($tglrange,$id_ruang)->result();

        $this->load->view('laporan/cetak_pinjam_alat',$data);
    }



    public function download_pdf_pinjam()
    {
        $tglrange =$this->input->post('tgl');
        $id_ruang =$this->input->post('id_ruang');
        $data['tgl'] = $this->input->post('tgl');
        $data['lap'] = $this->Mod_laporan->get_laporan_pinjam($tglrange,$id_ruang)->result();
        $data['act'] = $this->input->post('act');
        $date=date('ymdhis');
        $namafile='lap_pinjam_alat_'.$date.'.pdf';
        // fungsi pdf dari library di autoload
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = $namafile;
        $this->pdf->load_view('laporan/cetak_pinjam_alat', $data);
    }

    public function lap_pinjam_xls()
    {
        $filename = 'lap_pinjam_alat';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xls"'); 
        header('Cache-Control: max-age=0');
        $tglrange =$this->input->post('tgl');
        $id_ruang =$this->input->post('id_ruang');
        $data['tgl'] = $this->input->post('tgl');
        $data['lap'] = $this->Mod_laporan->get_laporan_pinjam($tglrange,$id_ruang)->result();

        $this->load->view('laporan/cetak_pinjam_alat',$data);
        // $writer->save('php://output');
    }

    public function cetak_pakai_bahan()
    {
        $tglrange =$this->input->post('tgl');
        // $id_ruang =$this->input->post('id_ruang');
        $data['tgl'] = $this->input->post('tgl');
        $data['lap'] = $this->Mod_laporan->get_laporan_pakai($tglrange)->result();

        $this->load->view('laporan/cetak_pemakaian_bahan',$data);
    }

    public function download_pdf_pakai_bahan()
    {
        $tglrange =$this->input->post('tgl');
        $data['tgl'] = $this->input->post('tgl');
        $data['lap'] = $this->Mod_laporan->get_laporan_pakai($tglrange)->result();
        $data['act'] = $this->input->post('act');
        $date=date('ymdhis');
        $namafile='lap_pemakaian_bahan_'.$date.'.pdf';
        // fungsi pdf dari library di autoload
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = $namafile;
        $this->pdf->load_view('laporan/cetak_pemakaian_bahan', $data);
    }

    public function lap_pemakaian_bahan()
    {
        $filename = 'lap_pemakaian_bahan';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xls"'); 
        header('Cache-Control: max-age=0');
        $tglrange =$this->input->post('tgl');
        $data['tgl'] = $this->input->post('tgl');
        $data['lap'] = $this->Mod_laporan->get_laporan_pakai($tglrange)->result();

        $this->load->view('laporan/cetak_pemakaian_bahan',$data);
        // $writer->save('php://output');
    }

    public function cetak_kerusakan_alat()
    {
        $tglrange =$this->input->post('tgl');
        // $id_ruang =$this->input->post('id_ruang');
        $data['tgl'] = $this->input->post('tgl');
        $data['lap'] = $this->Mod_laporan->get_laporan_kerusakan_alat($tglrange)->result();

        $this->load->view('laporan/cetak_kerusakan_alat',$data);
    }

    public function download_pdf_kerusakan_alat()
    {
        $tglrange =$this->input->post('tgl');
        $data['tgl'] = $this->input->post('tgl');
        $data['lap'] = $this->Mod_laporan->get_laporan_kerusakan_alat($tglrange)->result();
        $data['act'] = $this->input->post('act');
        $date=date('ymdhis');
        $namafile='Lap_kerusakan_alat'.$date.'.pdf';
        // fungsi pdf dari library di autoload
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = $namafile;
        $this->pdf->load_view('laporan/cetak_kerusakan_alat', $data);
    }

    public function lap_kerusakan_alat()
    {
        $filename = 'Lap_kerusakan_alat';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xls"'); 
        header('Cache-Control: max-age=0');
        $tglrange =$this->input->post('tgl');
        $data['tgl'] = $this->input->post('tgl');
        $data['lap'] = $this->Mod_laporan->get_laporan_kerusakan_alat($tglrange)->result();

        $this->load->view('laporan/cetak_kerusakan_alat',$data);
        // $writer->save('php://output');
    }

       public function cetak_kerusakan_bahan()
    {
        $tglrange =$this->input->post('tgl');
        // $id_ruang =$this->input->post('id_ruang');
        $data['tgl'] = $this->input->post('tgl');
        $data['lap'] = $this->Mod_laporan->get_laporan_kerusakan_bahan($tglrange)->result();

        $this->load->view('laporan/cetak_kerusakan_bahan',$data);
    }

    public function download_pdf_kerusakan_bahan()
    {
        $tglrange =$this->input->post('tgl');
        $data['tgl'] = $this->input->post('tgl');
        $data['lap'] = $this->Mod_laporan->get_laporan_kerusakan_bahan($tglrange)->result();
        $data['act'] = $this->input->post('act');
        $date=date('ymdhis');
        $namafile='Lap_kerusakan_bahan'.$date.'.pdf';
        // fungsi pdf dari library di autoload
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = $namafile;
        $this->pdf->load_view('laporan/cetak_kerusakan_bahan', $data);
    }

    public function lap_kerusakan_bahan()
    {
        $filename = 'Lap_kerusakan_bahan';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xls"'); 
        header('Cache-Control: max-age=0');
        $tglrange =$this->input->post('tgl');
        $data['tgl'] = $this->input->post('tgl');
        $data['lap'] = $this->Mod_laporan->get_laporan_kerusakan_bahan($tglrange)->result();

        $this->load->view('laporan/cetak_kerusakan_bahan',$data);
        // $writer->save('php://output');
    }
}