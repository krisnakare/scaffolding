    <!-- Page Heading -->

    <div class="row">
        <div class="col-lg-10">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?php $this->session->flashdata('message'); ?>

            <a href="<?= base_url('pengembalian/add'); ?>" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Pengembalian</a>

            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php echo $this->pagination->create_links(); ?>
                </ul>
            </nav>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Id Pengembalian</th>
                        <th scope="col">Invoice id</th>
                        <th scope="col">Tanggal Pengembalian</th>
                        <th scope="col">Total Biaya</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = $this->uri->segment('3') + 1; ?>
                    <?php foreach ($pengembalian as $k) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $k->id_pengembalian ?></td>
                            <td><?= $k->invoice_id ?></td>
                            <td><?= $k->tgl_pengembalian ?></td>
                            <td>Rp. <?= number_format($k->biaya, 2) ?></td>
                            <td>
                                <span onclick="deletePengembalian(<?= $k->invoice_id ?>)" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="newPengembalian" tabindex="-1" aria-labelledby="newPengembalian" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Pengembalian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('pengembalian/add'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_penyewa">Nama Penyewa</label>
                            <input type="text" class="form-control" id="nama_penyewa" name="nama_penyewa" placeholder="Nama Penyewa">
                        </div>
                        <div class="form-group">
                            <label for="tgl_sewa">Tanggal Sewa</label>
                            <input type="date" class="form-control" id="tgl_sewa" name="tgl_sewa" placeholder="Tanggal Sewa">
                        </div>
                        <div class="form-group">
                            <label for="lama_sewa">Lama Sewa</label>
                            <input type="text" class="form-control" id="lama_sewa" name="lama_sewa" placeholder="lama Sewa">
                        </div>
                        <div class="form-group">
                            <label for="id_barang">Barang</label>
                            <select name="id_barang" id="id_barang" class="form-control">
                                <option>Pilih Barang</option>
                                <?php foreach ($barang as $b) : ?>
                                    <option value="<?= $b->id_barang ?>"><?= $b->nama_barang ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="banyak_barang">Banyak Barang</label>
                            <input type="text" class="form-control" name="banyak_barang" id="banyak_barang">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function deletePengembalian(invoice_id) {
            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus data pengembalian ini?',
                showDenyButton: true,
                confirmButtonText: 'Hapus',
                denyButtonText: `Batal`,
            }).then((result) => {
                if (result.isConfirmed) {
                    urlDeletePengembalian = `<?php echo base_url('pengembalian/hapus_pengembalian/` + invoice_id + `') ?>`;
                    console.log(urlDeletePengembalian);
                    $.ajax({
                        url: urlDeletePengembalian,
                        method: "DELETE",
                        error: function() {
                            console.log('failed delete');
                        },
                        success: function() {
                            console.log('success delete');
                        }
                    });
                    Swal.fire('Data pengembalian sudah terhapus!', '', 'success')
                    setTimeout(function(){ window.location.href = ''; }, 2000);
                } else if (result.isDenied) {
                    Swal.fire('Data pengembalian batal dihapus', '', 'error')
                }
            })
        }
    </script>