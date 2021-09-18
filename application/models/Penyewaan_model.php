<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Penyewaan_model extends CI_Model
{
    public function data($number, $offset)
    {
        return $this->db->get('tabel_sewa', $number, $offset)->result();
    }

    public function getPenyewaan()
    {
        return $this->db->get('tabel_sewa')->result();
    }

    public function hapus_penyewaan($id_sewa)
    {
        $this->db->where('id_sewa', $id_sewa);
        $this->db->delete('tabel_sewa');
    }

    public function getHargaSewa($id_barang)
    {
        $this->db->select('harga_sewa');
        $this->db->where('id_barang', $id_barang);

        return $this->db->get('barang')->row()->harga_sewa;
    }
}
