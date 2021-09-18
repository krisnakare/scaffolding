    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?php $this->session->flashdata('message'); ?>

            <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newPenyewaan">Tambah Sewa</a>

            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php echo $this->pagination->create_links(); ?>
                </ul>
            </nav>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Penyewa</th>
                        <th scope="col">Tgl Sewa</th>
                        <th scope="col">Lama Sewa</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = $this->uri->segment('3') + 1; ?>
                    <?php foreach ($penyewaan as $p) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $p->nama_penyewa ?></td>
                            <td><?= $p->tgl_sewa ?></td>
                            <td><?= $p->lama_sewa ?></td>
                            <td>
                                <a href="<?= base_url('penyewaan/hapus_penyewaan/') . $p->invoice_id ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                <a href="<?= base_url('penyewaan/pengembalian/') . $p->invoice_id ?>" class="btn btn-info"><i class="fas fa-undo"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
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