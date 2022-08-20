<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Laporan_model extends CI_Model
{
    public function data($number, $offset)
    {
        $this->db->join('detail_pengembalian', 'detail_pengembalian.invoice_id = tabel_sewa.invoice_id', 'left');
        $this->db->join('detail_sewa', 'detail_sewa.invoice_id = tabel_sewa.invoice_id');
        return $this->db->get('tabel_sewa', $number, $offset)->result();
    }

    public function getAllLaporan()
    {
        $this->db->join('detail_pengembalian', 'detail_pengembalian.invoice_id = tabel_sewa.invoice_id', 'left');
        $this->db->join('detail_sewa', 'detail_sewa.invoice_id = tabel_sewa.invoice_id');
        return $this->db->get('tabel_sewa')->result();
    }

    public function filterByTime($month, $year)
    {
        $this->db->join('detail_pengembalian', 'detail_pengembalian.invoice_id = tabel_sewa.invoice_id', 'left');
        $this->db->join('detail_sewa', 'detail_sewa.invoice_id = tabel_sewa.invoice_id');
        $this->db->where('month(tabel_sewa.tgl_sewa)', $month);
        $this->db->where('year(tabel_sewa.tgl_sewa)', $year);
        $results = $this->db->get('tabel_sewa')->result();
        return $results;
    }

}
