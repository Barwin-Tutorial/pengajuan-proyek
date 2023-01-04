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
            
            $data['level'] = $this->session->userdata['id_level'];
            $data['jmluser'] =  $this->Mod_dashboard->JmlUser();
            $data['jmlbarang'] =  $this->Mod_dashboard->Jmlbarang();
            $data['masuk'] =  $this->Mod_dashboard->Jmlmasuk();
            $data['keluar'] =  $this->Mod_dashboard->Jmlkeluar();
            $data['gudang'] = $this->Mod_dashboard->getAllGudang();
            $gudang='';
            $range='';
            $data['list'] =  $this->Mod_dashboard->get_laporan($gudang, $range);
            if ($akses=="Y") {
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

 function laporan()
{
    $range=$this->input->post('tanggal');
    //
    $gudang = $this->input->post('gudang');
    $date=explode(" - ", $range);
    $waktu = date("H:i:s");
    $tanggal = date("Y-m-d H:i:s", strtotime($date[1].' '.$waktu));
    
    $output ='<table class="table table-bordered table-sm" id="tbl-lap">
    <thead class="bg-success">
    <tr>
    <th rowspan="2">Gudang</th>
    <th rowspan="2">Stok Awal</th>
    <th colspan="2">Barang</th>
    <th colspan="2">Pengembalian Barang</th>
    <th rowspan="2">Stok Akhir</th>
    </tr>
    <tr>
    <th>Masuk</th>
    <th>Keluar</th>
    <th>Masuk</th>
    <th>Keluar</th>
    </tr>
    </thead>
    <tbody id="lap_detail">';
    $list = $this->Mod_dashboard->get_laporan($gudang, $range);
    foreach ($list->result() as $row) {

        $a = $this->Mod_dashboard->stokawal($row->id_gudang, $tanggal);
        $awal = (isset($a->awal)) ? $a->awal : '0' ;

        $b = $this->Mod_dashboard->stokakhir($row->id_gudang, $tanggal);
        $sisa = (isset($b->sisa)) ? $b->sisa : '0' ;

        $c = $this->Mod_dashboard->pmasuk($row->id_gudang, $tanggal);
        $pmasuk = (isset($c->pmasuk)) ? $c->pmasuk : '0' ;

        $d = $this->Mod_dashboard->pkeluar($row->id_gudang, $tanggal);
        $pkeluar = (isset($d->pkeluar)) ? $d->pkeluar : '0' ;

        $output .='<tr>
        <td>'.$row->namagudang.'</td>
        <td class="item">'.$awal.'</td>
        <td class="item">'.$row->masuk.'</td>
        <td class="item">'.$row->keluar.'</td>
        <td class="item">'.$pmasuk.'</td>
        <td class="item">'.$pkeluar.'</td>
        <td class="item">'.$sisa.'</td>
        </tr>';
    }
    $output .='</tbody>
    </table>';
    echo  $output;
}



}
/* End of file Controllername.php */
