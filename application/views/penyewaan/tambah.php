<h1>Form Tambah Penyewaan</h1>
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
  <div class="form-group">
    <label for="id_barang">Nama Barang</label>
    <select class="form-control" name="id_barang" id="id_barang">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Add</button>
</form>
