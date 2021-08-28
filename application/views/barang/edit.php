<form action="" method="post">
    <div class="modal-body">
        <input type="hidden" name="id_barang" value="<?= (set_value('id_barang')) ? set_value('id_barang') : $barang['id_barang']; ?>">
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama barang" value="<?= (set_value('nama_barang')) ? set_value('nama_barang') : $barang['nama_barang']; ?>">
        </div>
        <div class="form-group">
            <label for="jenis_barang">Jenis Barang</label>
            <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" placeholder="Jenis Barang" value="<?= (set_value('jenis_barang')) ? set_value('jenis_barang') : $barang['jenis_barang']; ?>">
        </div>
        <div class="form-group">
            <label for="stok">Stok Barang</label>
            <input type="number" class="form-control" id="stok" name="stok" placeholder="stok" value="<?= (set_value('stok')) ? set_value('stok') : $barang['stok']; ?>">
        </div>
        <div class="form-group">
            <label for="harga_sewa">Harga Sewa</label>
            <input type="number" class="form-control" id="harga_sewa" name="harga_sewa" placeholder="Harga Sewa" value="<?= (set_value('harga_sewa')) ? set_value('harga_sewa') : $barang['harga_sewa']; ?>">
        </div>
        <div class="form-group">
            <label for="harga_barang">Harga Barang</label>
            <input type="number" class="form-control" id="harga_barang" name="harga_barang" placeholder="Harga Barang" value="<?= (set_value('harga_barang')) ? set_value('harga_barang') : $barang['harga_barang']; ?>">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Edit Barang</button>
    </div>
</form>