<?php

$date1 = strtotime($penyewaan['tgl_sewa']);
$date2 = strtotime($penyewaan['tgl_pengembalian']);
$now = strtotime(date('Y-m-d'));
$interval = $date2 - $date1;
$jarak_bulan = $now - $date1;
$lama_sewa = round($interval / 2628000);
$telat_bulan = round($jarak_bulan / 2628000);
// jika barang kembali kurang dari $penyewaan['banyak_barang'] maka dikenakan biaya setiap barang yang kurang
?>
<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col">Tanggal Sewa</th>
            <th scope="col">Lama Sewa</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $penyewaan['tgl_sewa'] ?></td>
            <td><?php echo $lama_sewa ?> bulan</td>
        </tr>
    </tbody>
</table>
<input type="hidden" name="telat_bulan" id="telat_bulan" value="<?= $telat_bulan; ?>">
<div class="form-group">
    <label for="id_barang">ID Barang</label>
    <input type="text" class="form-control" name="id_barang" id="id_barang" onload="getBarang" value="<?php echo $penyewaan['id_barang'] ?>" readonly>
</div>
<div class="form-group">
    <label for="banyak_barang">Jumlah Barang</label>
    <input type="text" class="form-control" name="banyak_barang" id="banyak_barang" value="<?php echo $penyewaan['banyak_barang'] ?>" readonly>
</div>
<script>
    function getBarang() {
        let id_barang = document.getElementById('id_barang').value;

        $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>barang/getbarangbyid",
            data: {
                id_barang: id_barang
            },
            success: function(response) {
                $("#hasil").html(response);
            },
            error: function() {
                alert("Invalid!");
            }
        });
    }
</script>