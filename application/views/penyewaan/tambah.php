<<<<<<< HEAD
<!-- <h1>Form Tambah Penyewaan</h1>

<a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newBarang">Add Barang Baru</a>

<form action="<?php echo base_url('penyewaan/tambah_sewa')?>" method="post">
  <div class="form-group">
    <label for="nama_penyewa">Nama Penyewa</label>
    <input type="text" class="form-control" name="nama_penyewa" id="nama_penyewa" placeholder="nama">
  </div>
  <div class="form-group">
    <label for="tgl_sewa">Tanggal Sewa</label>
    <input type="date" class="form-control" name="tgl_sewa" id="tgl_sewa" placeholder="">
  </div>
  <div class="form-group">
    <label for="lama_sewa">Lama Sewa</label>
    <input type="text" class="form-control" name="lama_sewa" id="lama_sewa" placeholder="">
  </div>
  
  <button type="submit" class="btn btn-primary">Add</button>
</form> -->

    <!-- Modal -->
    <!-- <div class="modal fade" id="newBarang" tabindex="-1" aria-labelledby="newBarang" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newPenyewaan">Tambah Keranjang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <fuorm action="<?= base_url('penyewaaan/tambah_keranjang'); ?>" method="post">
                    <div class="modal-body">
                    <div class="form-group">
                      <label for="id_barang">Nama Barang</label>
                      <select class="form-control" name="id_barang" id="id_barang">
                        <?php foreach ($barang as $b) :?>
                          <option value="<?php echo $b->id_barang;?>"><?php echo $b->nama_barang; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="banyak_barang" name="banyak_barang" placeholder="banyak Barang">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
=======
<h1>Form Tambah Penyewaan</h1>
<form action="<?php echo base_url('penyewaan/tambah_keranjang') ?>" method="post">
  <div class="form-group">
    <label for="id_barang">Nama Barang</label>
    <select class="form-control" name="id_barang" id="id_barang">
      <?php foreach ($barang as $b) : ?>
        <option value="<?= $b->id_barang; ?>"><?= $b->nama_barang; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="banyak_barang">Banyak Barang</label>
    <input type="text" class="form-control" name="banyak_barang" id="banyak_barang" required="required">
  </div>
  <button type="submit" class="btn btn-primary">Add</button>
</form>
>>>>>>> 52fca6864215d18a753067763eb29a4a37151a6c
