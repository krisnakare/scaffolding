<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Barang_model');
    }

    public function index()
    {
        $data['title'] = 'Data Barang';
        $data['user'] = $this->User_model->user();

        $data['barang'] = $this->pagination();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('barang/index', $data);
        $this->load->view('templates/footer');
    }

    public function search()
    {
        $id_barang = $this->input->post('id_barang');
        $barang = $this->Barang_model->search($id_barang);

        if (!$barang) {
            echo '<div class="alert alert-primary" role="alert">Invoice yang dicari tidak ada!</div>';
        } else {
            $data['barang'] = $barang;

            $this->load->view('pengembalian/hasil', $data);
        }
    }


    public function tambah_barang()
    {
        $nama_barang = htmlspecialchars($this->input->post('nama_barang'));
        $stok = htmlspecialchars($this->input->post('stok'));
        $harga_sewa = htmlspecialchars($this->input->post('harga_sewa'));
        $harga_barang = htmlspecialchars($this->input->post('harga_barang'));

        $data = array(
            'nama_barang' => $nama_barang,
            'stok' => $stok,
            'harga_sewa' => $harga_sewa,
            'harga_barang' => $harga_barang
        );

        $this->db->insert('barang', $data);

        redirect('barang');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        New Item has been added!</div>');
    }

    public function hapus_barang($id_barang)
    {
        $this->Barang_model->hapus_barang($id_barang);
        redirect('barang');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Barang has been deleted!</div>');
    }

    public function stok()
    {
        $banyak_barang = $this->input->post('banyak_barang');
        $id_barang = $this->input->post('id_barang');
        $this->form_validation->set_rules('banyak_barang', 'Banyak Barang', 'trim|required');
        $this->form_validation->set_rules('id_barang', 'ID Barang', 'trim|required');
        $barang = $this->Barang_model->stok($id_barang, $banyak_barang);

        return $barang;

        // if (!$barang) {

        // } else {
        //     $decoded_stok = $barang['stok'];
        //     if($banyak_barang <= $decoded_stok) {
        //         die("masuk if bro");
        //     } else {
        //         die("masuk else bro");
        //     }
        // }
    }

    public function update_barang($id)
    {
        $this->form_validation->set_rules('nama_barang', 'Nama barang', 'required');
        $this->form_validation->set_rules('stok', 'stok', 'required');
        $this->form_validation->set_rules('harga_sewa', 'harga_sewa', 'required');
        $this->form_validation->set_rules('harga_barang', 'harga_barang', 'required');
        if ($this->form_validation->run() == false) {
            $data['title'] = "Edit Data Barang";
            $data['user'] = $this->User_model->user();
            $data['barang'] = $this->Barang_model->getBarangById($id);

            //$data['barang'] = $this->Barang_model->getJurusan();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('barang/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Barang_model->update_barang();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Barang Berhasil diubah!</div>');
            redirect('barang');
        }
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
        $config['base_url'] = base_url() . 'barang/index';
        $config['total_rows'] = $this->db->count_all('barang');
        $config['per_page'] = 10;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        return $this->Barang_model->data($config['per_page'], $from);
    }
}
