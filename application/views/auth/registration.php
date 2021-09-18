    <div class="container">

    	<div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
    		<div class="card-body p-0">
    			<!-- Nested Row within Card Body -->
    			<div class="row">
    				<div class="col-lg">
    					<div class="p-5">
    						<div class="text-center">
    							<h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
    						</div>
    						<form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
    							<div class="form-group">
                                    <label for="name">Nama Lengkap</label>
    								<input type="text" class="form-control form-control-user" id="name" name="name"
    									placeholder="Full Name" value="<?= set_value('name'); ?>">
    								<?=
                                        form_error('name', '<small class="text-danger pl-3">', '</small>');
                                    ?>
    							</div>
    							<div class="form-group">
                                    <label for="username">Username</label>
    								<input type="text" class="form-control form-control-user" id="username"
    									name="username" placeholder="Username" value="<?= set_value('username'); ?>">
    								<?=
                                        form_error('username', '<small class="text-danger pl-3">', '</small>');
                                    ?>
    							</div>
    							<div class="form-group">
                                    <label for="no_telp">Nomor Telepon</label>
    								<input type="text" class="form-control form-control-user" id="no_telp"
    									name="no_telp" placeholder="no_telp" value="<?= set_value('no_telp'); ?>">
    								<?=
                                        form_error('no_telp', '<small class="text-danger pl-3">', '</small>');
                                    ?>
    							</div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <div class="form-check">
                                        <label class="radio-inline">
                                            <input type="radio" name="jenis_kelamin" value="laki-laki" checked>Laki-Laki
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="jenis_kelamin" value="perempuan">Perempuan
                                        </label>
                                    </div>
                                </div>
    							<div class="form-group row">
    								<div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="password1">Password</label>
    									<input type="password" class="form-control form-control-user" id="password1"
    										name="password1" placeholder="Password">
    									<?=
                                            form_error('password1', '<small class="text-danger pl-3">', '</small>');
                                        ?>
    								</div>
    								<div class="col-sm-6">
                                        <label for="password2">Repeat Password</label>
    									<input type="password" class="form-control form-control-user" id="password2"
    										name="password2" placeholder="Repeat Password">
    								</div>
    							</div>
    							<button type="submit" class="btn btn-primary btn-user btn-block">
    								Register Account
    							</button>
    						</form>
    						<hr>
    						<div class="text-center">
    							<a class="small" href="<?= base_url('auth'); ?>">Already have an account? Login!</a>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>

    </div>
