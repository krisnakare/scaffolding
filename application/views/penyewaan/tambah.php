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