<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

<div class="row">
	<div class="col-lg-10">
		<form action="<?= base_url('pengembalian/tambah_pengembalian'); ?>" method="post">
			<div class="modal-body">
				<div class="form-group">
					<label for="invoice_id">Invoice Id</label>
					<input type="text" class="form-control" id="invoice_id" name="invoice_id" placeholder="Invoice Id" required>
				</div>
				<button id="btn" class="btn btn-info">Search</button>
				<hr>
				<div id="hasil"></div>
				<div class="form-group">
					<label for="tgl_pengembalian">Tanggal Pengembalian</label>
					<input type="date" class="form-control" name="tgl_pengembalian" id="tgl_pengembalian" value="<?php echo date('Y-m-d'); ?>" readonly>
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
</div>
<script>
	$(function() {
		$("#btn").click(function(event) {
			event.preventDefault();
			var invoice_id = $("#invoice_id").val();

			$.ajax({
				type: "post",
				url: "<?php echo base_url(); ?>penyewaan/search",
				data: {
					invoice_id: invoice_id
				},
				success: function(response) {
					$("#hasil").html(response);
				},
				error: function() {
					alert("Invalid!");
				}
			});
		});
	});
</script>