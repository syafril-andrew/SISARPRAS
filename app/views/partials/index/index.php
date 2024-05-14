        <?php
		$page_id = null;
		$comp_model = new SharedController;
		?>



        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        	<div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        		<div class="d-flex align-items-center justify-content-center w-100">
        			<div class="row justify-content-center w-100">
        				<div class="col-md-12 col-lg-12 col-xxl-10">
        					<div class="card mb-0">
        						<div class="card-body">
        							<a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
        								<img src="assets/images/inventory.png" width="180" alt="">
        							</a>
        							<p class="text-center">Welcome To <?php echo SITE_NAME ?></p>
        							<?php
									$this::display_page_errors();
									?>
        							<form name="loginForm" action="<?php print_link('index/login/?csrf_token=' . Csrf::$token); ?>" class="needs-validation form page-form" method="post">
        								<div class="mb-3">
        									<label class="form-label">Username</label>
        									<input placeholder="Username Or Email" name="username" required="required" for="exampleInputEmail1" z type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        								</div>
        								<div class="mb-4">
        									<label for="exampleInputPassword1" class="form-label">Password</label>
        									<input placeholder="Password" required="required" v-model="user.password" name="password" type="password" class=" form-control" id="exampleInputPassword1">
        								</div>
        								<div class="d-flex align-items-center justify-content-between mb-4">
        									<div class="form-check">
        										<input class="form-check-input primary" value="true" type="checkbox" name="rememberme" id="flexCheckChecked" checked>
        										<label class="form-check-label text-dark" for="flexCheckChecked">
        											Remeber this Device
        										</label>
        									</div>
        									<a class="text-primary fw-bold" href="<?php print_link('passwordmanager') ?>">Reset Password?</a>
        								</div>
        								<button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>

        							</form>
        						</div>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
