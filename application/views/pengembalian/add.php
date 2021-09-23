<h1>Form Pengembalian</h1>
<div class="col-lg-6">
<form action="<?= base_url('pengembalian/tambah_pengembalian'); ?>" method="post">
	<div class="modal-body">
		<div class="form-group">
			<label for="invoice_id">Invoice Id</label>
			<input type="text" class="form-control" id="invoice_id" name="invoice_id" placeholder="Invoice Id">
            <button type="button" class="btn btn-primary" onclick="checkInvoice()">Check Invoice ID</button>
		</div>
		<div class="form-group">
			<label for="tgl_pengembalian">Tanggal Pengembalian</label>
			<input type="date" class="form-control" id="tgl_pengembalian" name="tgl_pengembalian" placeholder="Tanggal Pengembalian">
		</div>
		<div class="form-group">
			<label for="id_barang">Barang</label>
			<select name="id_barang" id="id_barang" class="form-control">
				<option>Pilih Barang</option>
				<?php foreach ($barang as $b) : ?>
				<option value="<?= $b->id_barang ?>"><?= $b->nama_barang ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="jumlah_barang">Banyak Barang Kembali</label>
			<input type="text" class="form-control" name="jumlah_barang" id="jumlah_barang">
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary">Add</button>
	</div>
</form>
</div>

<script>
    function checkInvoice(){
    let invoice_id = document.getElementById('invoice_id').value;

    // ambil invoice_id sebagai parameter untuk get data tabel_sewa dan detail_sewa
    // Pakai ajax jquery
    // $.ajax({
    //     url: "<?php echo base_url('pengembalian/tambah_pengembalian')?>",
    //     method: "POST",
    //     data: invoice_id,
        
    // });
    }
</script>