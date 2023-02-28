<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
class Dashboard extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->helper('myfunction_helper');
        $this->load->model(array('Mod_dashboard','Mod_aplikasi'));
    }

    function index()
    {
    	$logged_in = $this->session->userdata('logged_in');
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        }else{
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
            
            $data['level'] = $this->session->userdata['id_level'];
            if ($akses=="Y") {
                $data['jml_alat'] = $this->Mod_dashboard->jml_alat();
                $data['jml_bahan'] = $this->Mod_dashboard->jml_bahan();
                $data['jml_pinjam'] = $this->Mod_dashboard->jml_pinjam();
                $data['jml_pemakai_bahan'] = $this->Mod_dashboard->jml_pemakai_bahan();
                $data['jml_rusak'] = $this->Mod_dashboard->jml_rusak();
                $data['jml_perbaikan'] = $this->Mod_dashboard->jml_perbaikan();
               $this->template->load('layoutbackend','dashboard/dashboard_data',$data);
           }else{
            $data['page']=$link;
            $this->template->load('layoutbackend','admin/akses_ditolak',$data);
        }
    }

}

public function header_perusahaan()
{
    $apl = $this->db->get("aplikasi")->row();
    echo '<h1><center><font size="5" face="arial">'.$apl->nama_owner.'</font></center></h1><br>
    <center><b>'.$apl->alamat.'<b></center><br>
    <hr><width="100" height="75"></hr>';

}



}
/* End of file Controllername.php */
