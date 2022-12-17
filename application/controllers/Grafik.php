<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Grafik extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_barang');
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
            // $data['lap'] = $this->Mod_laporan->get_expired();
            $data['perundangan'] = $this->Mod_barang->perundangan()->result();
            $this->template->load('layoutbackend','grafik/grafik',$data);
        }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }

    public function terlaris()
    {
        $id = $this->input->post('id');
        $tgl = $this->input->post('tgl');
        $data= $this->Mod_dashboard->terlaris($id,$tgl)->result();
        echo json_encode($data);

    }

    public function chart_pelanggan()
    {
       $tgl = $this->input->post('tgl');
        $data= $this->Mod_dashboard->chart_pelanggan($tgl)->result();
        echo json_encode($data);

    }
}