    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-10">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?php $this->session->flashdata('message'); ?>  
            <?php if(array_key_exists('message', $_SESSION)) {
                echo $_SESSION['message'];
            } ?>

            <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newPenyewaan"><i class="fas fa-fw fa-plus"></i> Tambah Sewa</a>

            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php echo $this->pagination->create_links(); ?>
                </ul>
            </nav>
            <table class="table table-hover" id="table_sewa">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Invoice Id</th>
                        <th scope="col">Nama Penyewa</th>
                        <th scope="col">Tgl Sewa</th>
                        <th scope="col">Tgl Pengembalian</th>
                        <th scope="col">Total Biaya</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = $this->uri->segment('3') + 1; ?>
                    <?php foreach ($penyewaan as $p) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $p->invoice_id ?></td>
                            <td><?= $p->nama_penyewa ?></td>
                            <td><?= $p->tgl_sewa ?></td>
                            <td><?= $p->tgl_pengembalian ?></td>
                            <td>Rp. <?= number_format($p->total_biaya, 2) ?></td>
                            <td><?= $p->status ?></td>
                            <td>
                                <span onclick="deletePenyewaan(<?= $p->invoice_id ?>)" class="btn btn-danger"><i class="fas fa-trash"></i></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="newPenyewaan" tabindex="-1" aria-labelledby="newPenyewaan" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New penyewaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('penyewaan/tambah_sewa'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_penyewa">Nama Penyewa</label>
                            <input type="text" class="form-control" id="nama_penyewa" name="nama_penyewa" placeholder="Nama Penyewa" required>
                        </div>
                        <div class="form-group">
                            <label for="tgl_sewa">Tanggal Sewa</label>
                            <input type="date" class="form-control" id="tgl_sewa" name="tgl_sewa" placeholder="Tanggal Sewa" required>
                        </div>
                        <div class="form-group">
                            <label for="tgl_pengembalian">Tanggal Pengembalian</label>
                            <input type="date" class="form-control" id="tgl_pengembalian" name="tgl_pengembalian" required>
                        </div>
                        <div class="form-group">
                            <label for="id_barang">Barang</label>
                            <select name="id_barang" id="id_barang" class="form-control" required>
                                <option>Pilih Barang</option>
                                <?php foreach ($barang as $b) : ?>
                                    <option value="<?= $b->id_barang ?>">
                                    <?= $b->nama_barang ?> | stok: <?= $b->stok ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="banyak_barang">Banyak Barang</label>
                            <input type="text" class="form-control" name="banyak_barang" id="banyak_barang" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="addButton" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function deletePenyewaan(invoice_id) {
            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus data penyewaan ini?',
                showDenyButton: true,
                confirmButtonText: 'Hapus',
                denyButtonText: `Batal`,
            }).then((result) => {
                if (result.isConfirmed) {
                    urldeletePenyewaan = `<?php echo base_url('penyewaan/hapus_penyewaan/` + invoice_id + `') ?>`;
                    $.ajax({
                        url: urldeletePenyewaan,
                        method: "DELETE",
                        error: function() {
                            console.log('failed delete');
                        },
                        success: function() {
                            console.log('success delete');
                        }
                    });
                    Swal.fire('Data penyewaan sudah terhapus!', '', 'success')
                    setTimeout(function(){ window.location.href = ''; }, 2000);
                } else if (result.isDenied) {
                    Swal.fire('Data penyewaan batal dihapus', '', 'error')
                }
            })
        };

        $(document).ready( function () {
            $('#table_sewa').DataTable();
        });
    </script>