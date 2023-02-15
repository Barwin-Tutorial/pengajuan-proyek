<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Mod_fungsi extends CI_Model
{

  function get_tahun()
  {   
    return $this->db->get('tahun');
}

function get_dana()
  {   
    return $this->db->get('dana');
}
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
function get_bahan_by_id($id)
{   
    $this->db->where('id_bahan', $id);
    return $this->db->get('bahan');
}
function get_bahan($nama)
{   
    $this->db->like('nama_bahan', $nama);
    return $this->db->get('bahan');
}
function get_bahan_bar($barcode)
{   
    $this->db->where('barcode', $barcode);
    return $this->db->get('bahan');
}

function get_satuan_by_nama($nama='')
{   
    $this->db->like('nama_satuan', $nama);
    return $this->db->get('satuan');
}
function get_merk_by_nama($nama='')
{   
    $this->db->like('nama_merk', $nama);
    return $this->db->get('merk');
}

}