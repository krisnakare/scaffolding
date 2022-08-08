    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <form>
        <div class="form-group">
            <label for="filter_sewa">Filter Penyewaan per Bulan</label>
            <select class="form-control" id="filter_sewa">
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option> 
                <option value="11">November</option> 
                <option value="12">Desember</option> 
        </select>
        </div>
    </form>

    <div class="row">
        <div class="col-lg-12 p-4">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?php $this->session->flashdata('message'); ?>  
            <?php if(array_key_exists('message', $_SESSION)) {
                echo $_SESSION['message'];
            } ?>

            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php echo $this->pagination->create_links(); ?>
                </ul>
            </nav>
            <div id="hasil"></div>
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
            <br>
        </div>
    </div>
    <script>
        $('#filter_sewa').on('click', function() {
            const month = this.value;
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>laporan/filter",
                data: {
                    month: month
                },
                success: function(response) {
                    $("#table_sewa").html(response);
                },
                error: function(error) {
                    console.error("ERROR", error);
                }
            });
        });
    </script>