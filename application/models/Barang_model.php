<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Barang_model extends CI_Model
{
    public function data($number, $offset)
    {
        return $this->db->get('barang', $number, $offset)->result();
    }

    public function update_barang()
    {
        
    }
    public function hapus_barang($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        $this->db->delete('barang');
    }
}
