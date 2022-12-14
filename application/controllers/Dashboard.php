<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->helper('myfunction_helper');
        $this->load->model('Mod_dashboard');
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

            $data['jmluser'] =  $this->Mod_dashboard->JmlUser();
            $data['jmlbarang'] =  $this->Mod_dashboard->Jmlbarang();
            $data['masuk'] =  $this->Mod_dashboard->Jmlmasuk();
            $data['keluar'] =  $this->Mod_dashboard->Jmlkeluar();
            if ($akses=="Y") {
                 $this->template->load('layoutbackend','dashboard/dashboard_data',$data);
             }else{
                $data['page']=$link;
                $this->template->load('layoutbackend','admin/akses_ditolak',$data);
            }
        }
        
    }

}
/* End of file Controllername.php */
 