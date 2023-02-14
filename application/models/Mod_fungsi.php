<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Mod_fungsi extends CI_Model
{


  function get_jabatan()
  {   
    return $this->db->get('jabatan');
}
function get_guru()
{   
    return $this->db->get('guru');
}
function get_satuan()
{   
    return $this->db->get('satuan');
}
function get_merk()
{   
    return $this->db->get('merk');
}

function get_jurusan()
{   
    return $this->db->get('jurusan');
}
function get_kondisi()
{   
    return $this->db->get('kondisi');
}
function get_ruang()
{   
    return $this->db->get('ruang');
}

function get_alat_by_id($id)
{   
    $this->db->where('id_alat', $id);
    return $this->db->get('alat');
}
function get_alat($nama)
{   
    $this->db->like('nama_alat', $nama);
    return $this->db->get('alat');
}
function get_alat_bar($barcode)
{   
    $this->db->where('barcode', $barcode);
    return $this->db->get('alat');
}
function get_bahan()
{   
    return $this->db->get('bahan');
}

}