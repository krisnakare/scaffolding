<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Penyewaan_model extends CI_Model
{
    public function data($number, $offset)
    {
        $this->db->join('detail_sewa', 'detail_sewa.invoice_id = tabel_sewa.invoice_id');
        return $this->db->get('tabel_sewa', $number, $offset)->result();
    }

    public function getPenyewaan()
    {
        return $this->db->get('tabel_sewa')->result();
    }

    public function search($invoice_id)
    {
        $query = "SELECT * FROM tabel_sewa
        INNER JOIN detail_sewa
        ON tabel_sewa.invoice_id = detail_sewa.invoice_id
        -- ON detail_sewa.id_barang = barang.id_barang
        WHERE tabel_sewa.invoice_id = '$invoice_id'";
        return $this->db->query($query)->row_array();
    }

    public function hapus_penyewaan($invoice_id)
    {
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('tabel_sewa');
    }

    public function hapus_detail($invoice_id)
    {
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('detail_sewa');
    }

    public function getHargaSewa($id_barang)
    {
        $this->db->select('harga_sewa');
        $this->db->where('id_barang', $id_barang);

        return $this->db->get('barang')->row()->harga_sewa;
    }
}
