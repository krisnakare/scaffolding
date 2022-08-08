<table class="table table-hover" id="table_sewa">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Invoice Id</th>
            <th scope="col">Nama Penyewa</th>
            <th scope="col">Tgl Sewa</th>
            <th scope="col">Tgl Pengembalian</th>
            <th scope="col">Total Biaya</th>
            <th scope="col">Jumlah Barang</th>
            <th scope="col">Biaya</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = $this->uri->segment('3') + 1; ?>
        <?php foreach ($laporan as $l) : ?>
            <tr>
                <th scope="row"><?= $i++; ?></th>
                <td><?= $l->invoice_id ?></td>
                <td><?= $l->nama_penyewa ?></td>
                <td><?= $l->tgl_sewa ?></td>
                <td><?= $l->tgl_pengembalian ?></td>
                <td>Rp. <?= number_format($l->total_biaya, 2) ?></td>
                <td><?= $l->jumlah_barang ?></td>
                <td>Rp. <?= number_format($l->biaya, 2) ?></td>
                <td><?= $l->status ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>