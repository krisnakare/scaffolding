<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Penyewaan_model extends CI_Model
{
    public function data($number, $offset)
    {
        return $this->db->get('tabel_sewa', $number, $offset)->result();
    }

    public function hapus_penyewaan($id_sewa)
    {
        $this->db->where('id_sewa', $id_sewa);
        $this->db->delete('tabel_sewa');
    }
}
