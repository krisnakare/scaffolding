<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


class Sewa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('Keranjang_model');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Cart';
        $data['user'] = $this->User_model->user();
        $data['barang'] = $this->Keranjang_model->get_barang_all();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('shopping/list_produk', $data);
        $this->load->view('templates/footer');
    }
    public function tampil_cart()
    {
        $data['barang'] = $this->Keranjang_model->get_barang_all();
        $data['user'] = $this->User_model->user();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('shopping/tampil_cart', $data);
        $this->load->view('templates/footer');
    }

    public function check_out()
    {
        $data['barang'] = $this->Keranjang_model->get_barang_all();
        $this->load->view('templates/header', $data);
        $this->load->view('shopping/check_out', $data);
        $this->load->view('templates/footer');
    }

    public function detail_produk()
    {
        $id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['kategori'] = $this->Keranjang_model->get_kategori_all();
        $data['detail'] = $this->Keranjang_model->get_produk_id($id)->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('shopping/detail_produk', $data);
        $this->load->view('templates/footer');
    }

    function tambah()
    {
        $data_barang = array(
            'id_barang' => $this->input->post('id_barang'),
            'nama_barang' => $this->input->post('nama_barang'),
            'harga_barang' => $this->input->post('harga_barang'),
            'banyak_barang' => $this->input->post('banyak_barang')
        );
        $this->cart->insert($data_barang);
        redirect('sewa');
    }

    function hapus($rowid)
    {
        if ($rowid == "all") {
            $this->cart->destroy();
        } else {
            $data = array(
                'rowid' => $rowid,
                'qty' => 0
            );
            $this->cart->update($data);
        }
        redirect('shopping/tampil_cart');
    }

    function ubah_cart()
    {
        $cart_info = $_POST['cart'];
        foreach ($cart_info as $id => $cart) {
            $rowid = $cart['rowid'];
            $price = $cart['price'];
            $gambar = $cart['gambar'];
            $amount = $price * $cart['qty'];
            $qty = $cart['qty'];
            $data = array(
                'rowid' => $rowid,
                'price' => $price,
                'gambar' => $gambar,
                'amount' => $amount,
                'qty' => $qty
            );
            $this->cart->update($data);
        }
        redirect('shopping/tampil_cart');
    }

    public function proses_order()
    {
        //-------------------------Input data pelanggan--------------------------
        $data_pelanggan = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'telp' => $this->input->post('telp')
        );
        $id_pelanggan = $this->Keranjang_model->tambah_pelanggan($data_pelanggan);
        //-------------------------Input data order------------------------------
        $data_order = array(
            'tanggal' => date('Y-m-d'),
            'pelanggan' => $id_pelanggan
        );
        $id_order = $this->Keranjang_model->tambah_order($data_order);
        //-------------------------Input data detail order-----------------------
        if ($cart = $this->cart->contents()) {
            foreach ($cart as $item) {
                $data_detail = array(
                    'order_id' => $id_order,
                    'produk' => $item['id'],
                    'qty' => $item['qty'],
                    'harga' => $item['price']
                );
                $proses = $this->Keranjang_model->tambah_detail_order($data_detail);
            }
        }
        //-------------------------Hapus shopping cart--------------------------
        $this->cart->destroy();
        $data['kategori'] = $this->Keranjang_model->get_kategori_all();
        $this->load->view('templates/header', $data);
        $this->load->view('shopping/sukses', $data);
        $this->load->view('templates/footer');
    }
}
