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
            <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newBarang"><i class="fas fa-plus"></i> Tambah Barang Baru</a>

            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php echo $this->pagination->create_links(); ?>
                </ul>
            </nav>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">1</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Jenis Barang</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Harga Sewa</th>
                        <th scope="col">Harga Barang</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = $this->uri->segment('3') + 1; ?>
                    <?php foreach ($barang as $b) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $b->nama_barang ?></td>
                            <td><?= $b->jenis_barang ?></td>
                            <td><?= $b->stok ?></td>
                            <td>Rp. <?= number_format($b->harga_sewa, 2) ?></td>
                            <td>Rp. <?= number_format($b->harga_barang, 2) ?></td>
                            <td>
                                <a href="<?= base_url('barang/update_barang/') . $b->id_barang ?>" class="btn btn-warning"><i class="fas fa-fw fa-edit"></i></a>
                                <a href="<?= base_url('barang/hapus_barang/') . $b->id_barang ?>" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i></a>
                                </tb>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newBarang" tabindex="-1" aria-labelledby="newBarang" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newBarang">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('Barang/tambah_barang'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama barang" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_barang">Jenis Barang</label>
                            <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" placeholder="Jenis Barang" required>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok Barang</label>
                            <input type="number" class="form-control" id="stok" name="stok" placeholder="stok" required>
                        </div>
                        <div class="form-group">
                            <label for="harga_sewa">Harga Sewa</label>
                            <input type="number" class="form-control" id="harga_sewa" name="harga_sewa" placeholder="Harga Sewa" required>
                        </div>
                        <div class="form-group">
                            <label for="harga_barang">Harga Barang</label>
                            <input type="number" class="form-control" id="harga_barang" name="harga_barang" placeholder="Harga Barang" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i>Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>