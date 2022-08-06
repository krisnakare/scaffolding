<div class="col-lg-8">
    <h3>Edit Data Barang</h3>
    <form action="" method="post">
        <input type="hidden" name="id_barang" value="<?= (set_value('id_barang')) ? set_value('id_barang') : $barang['id_barang']; ?>">
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama barang" value="<?= (set_value('nama_barang')) ? set_value('nama_barang') : $barang['nama_barang']; ?>" required>
        </div>
        <div class="form-group">
            <label for="stok">Stok Barang</label>
            <input type="number" class="form-control" id="stok" name="stok" placeholder="stok" value="<?= (set_value('stok')) ? set_value('stok') : $barang['stok']; ?>" required>
        </div>
        <div class="form-group">
            <label for="harga_sewa">Harga Sewa</label>
            <input type="number" class="form-control" id="harga_sewa" name="harga_sewa" placeholder="Harga Sewa" value="<?= (set_value('harga_sewa')) ? set_value('harga_sewa') : $barang['harga_sewa']; ?>" required>
        </div>
        <div class="form-group">
            <label for="harga_barang">Harga Barang</label>
            <input type="number" class="form-control" id="harga_barang" name="harga_barang" placeholder="Harga Barang" value="<?= (set_value('harga_barang')) ? set_value('harga_barang') : $barang['harga_barang']; ?>" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Edit Barang</button>
        </div>
    </form>
</div>