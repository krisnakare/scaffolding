<?php
$listBulan = [];
$listTahun = [];
$bulan = array (1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');

foreach ($all_laporan as $report => $value) {
    $timeString = strtotime($value->tgl_sewa);
    $date = getdate($timeString);
    $month = $date["mon"];
    if(!in_array($month, $listBulan, true)) {
        array_push($listBulan, $month);
    }
}

foreach ($all_laporan as $report => $value) {
    $timeString = strtotime($value->tgl_sewa);
    $date = getdate($timeString);
    $year = $date["year"];
    if(!in_array($year, $listTahun, true)) {
        array_push($listTahun, $year);
    }
}

sort($listBulan);
sort($listTahun);
?>
<!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="col-lg-4 col-md-6">
        <h5>Filter Laporan Penyewaan</h5>
        <div class="form-group">
            <label for="filter_bulan">Bulan</label>
            <select class="form-control" id="filter_bulan">
                <option value="">Pilih Bulan</option>
                <?php foreach ($listBulan as $key => $value) :?>
                    <option value="<?= $value ?>"><?= $bulan[$value]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="filter_tahun">Tahun</label>
            <select class="form-control" id="filter_tahun">
                <option value="">Pilih Tahun</option>
                <?php foreach ($listTahun as $key => $value) :?>
                    <option value="<?= $value ?>"><?= $value ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button id="submit_filter" class="btn btn-primary">Filter</button>
    </div>

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
        // $('#filter_bulan').on('click', function() {
        //     const month = this.value;
        //     if(month){
        //         console.log(month);
        //         $.ajax({
        //             type: "post",
        //             url: "<?php echo base_url(); ?>laporan/filter",
        //             data: {
        //                 month: month
        //             },
        //             success: function(response) {
        //                 $("#table_sewa").html(response);
        //             },
        //             error: function(error) {
        //                 console.error("ERROR", error);
        //             }
        //         });
        //     }
        // });
        // $('#filter_tahun').on('click', function() {
        //     const year = this.value;
        //     if(year){
        //         $.ajax({
        //             type: "post",
        //             url: "<?php echo base_url(); ?>laporan/filter",
        //             data: {
        //                 year: year
        //             },
        //             success: function(response) {
        //                 $("#table_sewa").html(response);
        //             },
        //             error: function(error) {
        //                 console.error("ERROR", error);
        //             }
        //         });
        //     }
        // });

        $('#submit_filter').on('click', function(){
            const month = $('#filter_bulan').val();
            const year = $('#filter_tahun').val();

            if(month && year) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>laporan/filter",
                    data: {
                        month: month,
                        year: year
                    },
                    success: function(response) {
                        $("#table_sewa").html(response);
                    },
                    error: function(error) {
                        console.error("ERROR", error);
                    }
                });
            }
        })
    </script>