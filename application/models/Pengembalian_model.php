<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pengembalian_model extends CI_Model
{
    public function data($number, $offset)
    {
        return $this->db->get('tabel_pengembalian', $number, $offset)->result();
    }

    public function getPengembalian()
    {
        return $this->db->get('tabel_pengembalian')->result();
    }

    public function hapus_pengembalian($invoice_id)
    {
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('tabel_pengembalian');
    }

    public function hapus_detail($invoice_id)
    {
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('detail_pengembalian');
    }

    public function getHargaBarang($id_barang)
    {
        $this->db->select('harga_barang');
        $this->db->where('id_barang', $id_barang);

        return $this->db->get('barang')->row()->harga_barang;
    }
}
