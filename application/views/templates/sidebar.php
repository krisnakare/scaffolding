<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>">
		<div class="sidebar-brand-icon">
			<i class="fas fa-shopping-cart"></i>
		</div>
		<div class="sidebar-brand-text mx-3">Penyewaan Scaffolding</div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider ">
	<div class="sidebar-heading">Barang</div>
	<?php if ($title == "Daftar Barang") : ?>
	<li class="nav-item active">
		<?php else : ?>
	<li class="nav-item">
		<?php endif; ?>
		<a class="nav-link" href="<?= base_url('barang'); ?>">
			<i class="fas fa-box fa-fw"></i>
			<span>Daftar Barang</span></a>
    </li>

    <?php if ($title == "Daftar Penyewaan") : ?>
	<li class="nav-item active">
		<?php else : ?>
	<li class="nav-item">
		<?php endif; ?>
		<a class="nav-link" href="<?= base_url('penyewaan'); ?>">
			<i class="fas fa-sign-out-alt fa-fw"></i>
			<span>Daftar Penyewaan</span></a>
	</li>
	<hr class="sidebar-divider ">
	<div class="sidebar-heading">User</div>

	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('user'); ?>">
			<i class="fas fa-sign-out-alt fa-fw"></i>
			<span>User Profile</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('user/edit'); ?>">
			<i class="fas fa-sign-out-alt fa-fw"></i>
			<span>Edit Profile</span></a>
	</li>
	<!-- Nav Item - Logout -->
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('auth/logout'); ?>">
			<i class="fas fa-sign-out-alt fa-fw"></i>
			<span>Log Out</span></a>
	</li>


	<!-- Sidebar Toggler Sidebar -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>
<!-- End of Sidebar -->
