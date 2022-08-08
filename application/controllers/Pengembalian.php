<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Pengembalian_model');
        $this->load->model('Barang_model');
    }

    public function index()
    {
        $data['title'] = 'Data Pengembalian';
        $data['user'] = $this->User_model->user();
        $data['pengembalian'] = $this->pagination();
        $data['barang'] = $this->Barang_model->getBarang();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pengembalian/index', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $data['title'] = 'Form Pengembalian';
        $data['user'] = $this->User_model->user();
        $data['barang'] = $this->Barang_model->getBarang();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pengembalian/add', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_pengembalian()
    {
        $invoice_id = $this->input->post('invoice_id');
        $tgl_pengembalian = $this->input->post('tgl_pengembalian');

        $data = array(
            'invoice_id' => $invoice_id,
            'tgl_pengembalian' => $tgl_pengembalian,
        );
        $this->db->insert('tabel_pengembalian', $data);

        $id_barang = $this->input->post('id_barang');
        $telat_bulan = $this->input->post('telat_bulan'); //banyak telat bulan misal seharusnya tgl 27 tetapi dikembalikan tgl 29 maka telat bulan adalah 2 bulan
        $biaya_telat = 0; //nilai default untuk biaya telat misal jika tidak telat maka tidak ada biaya tambahan
        $biaya_hilang = 0; //nilai default untuk biaya barang hilang misal jika barang yang disewa kurang dari barang yang dikembalikan
        if ($telat_bulan > 0) { //jika lama sewa lebih dari 0 bulan maka hitung biaya telat
            $biaya_telat_per_bulan = 5000; //!inget diganti untuk berapa biaya telat per bulannya, tergantung pemilik
            $biaya_telat = $telat_bulan * $biaya_telat_per_bulan; //perkalian dari banyak telat dan biaya telat per bulan
        }
        $banyak_barang = $this->input->post('banyak_barang'); //banyak barang adalah banyak dari barang yang disewa (otomatis input ketika mencari dengan invoice_id)
        $jumlah_barang = $this->input->post('jumlah_barang'); //jumlah barang yang akan dikembalikan, disini akan mengecek apakah kurang dari banyak barang yang disewa
        $jumlah_barang_hilang = $banyak_barang - $jumlah_barang; //pengurangan banyak barang yang dipinjam dengan jumlah barang yang dikembalikan adalah nilai dari jumlah barang hilang

        if ($jumlah_barang < $banyak_barang) { //cek barang yang kurang dari barang yang disewa berapa di tabel_sewa
            //jika jumlah barang yang dikembalikan kurang dari jumlah barang yang dipinjam maka biaya harus ditambahkan dengan harga barangsssss
            $harga_barang = $this->Barang_model->getBarangById($id_barang)['harga_barang']; //diambil jika barang ilang
            $biaya_hilang = $harga_barang * $jumlah_barang_hilang;
        }
        $total_biaya = $biaya_telat + $biaya_hilang;

        $data2 = array(
            'invoice_id' => $invoice_id,
            'id_barang' => $id_barang,
            'telat_bulan' => $telat_bulan,
            'banyak_barang' => $jumlah_barang_hilang,
            'jumlah_barang' => $jumlah_barang,
            'biaya' => $total_biaya
        );
        $this->db->insert('detail_pengembalian', $data2);

        $this->db
            ->set('status')
            ->where('invoice_id', $invoice_id)
            ->update('tabel_sewa', array('status' => 'kembali')); //mengubah status jika barang sudah dikembalikan
        redirect('pengembalian');
    }

    public function hapus_pengembalian($invoice_id)
    {
        $this->Pengembalian_model->hapus_pengembalian($invoice_id);
        $this->Pengembalian_model->hapus_detail($invoice_id);
        redirect('pengembalian');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data pengembalian has been deleted!</div>');
    }


    private function pagination()
    {
        $this->load->library('pagination');
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $config['base_url'] = base_url() . 'pengembalian/index';
        $config['total_rows'] = $this->db->count_all('tabel_pengembalian');
        $config['per_page'] = 10;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        return $this->Pengembalian_model->data($config['per_page'], $from);
    }
}
