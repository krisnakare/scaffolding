<h2>Daftar Barang</h2>
<?php
foreach ($barang as $row) {
?>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="kotak">
            <form method="post" action="<?php echo base_url(); ?>sewa/tambah" method="post" accept-charset="utf-8">
                <div class="card-body">
                    <h4 class="card-title">
                        <p><?php echo $row['nama_barang']; ?></p>
                    </h4>
                    <h5>Rp. <?php echo number_format($row['harga_barang'], 0, ",", "."); ?></h5>
                </div>
                <div class="card-footer">
                    <input type="hidden" name="id_barang" value="<?php echo $row['id_barang']; ?>" />
                    <input type="hidden" name="nama_barang" value="<?php echo $row['nama_barang']; ?>" />
                    <input type="hidden" name="harga_barang" value="<?php echo $row['harga_barang']; ?>" />
                    <input type="hidden" name="banyak_barang" value="1" />
                    <button type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Beli</button>
                </div>
            </form>
        </div>
    </div>
<?php
}
?>