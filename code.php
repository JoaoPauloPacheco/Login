<?php
include('includes/header.php');
include('includes/content.php');
?>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<div class="alert-placeholder">
			<?php
				display_message();
				validate_code();
			?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-offset-3 col-md-6 col-md-offset-3">
			<div class="alert-placeholder">

			</div>
			<div class="panel panel-success">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="text-center"><h2><b> Enter Code</b></h2></div>
							<form id="form-register" method="post" role="form" autocomplete="off">
								<div class="form-group">
									<input type="text" name="code" id="code" class="form-control"
										placeholder="#####" value="">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-lg-offset-2 col-md-3 col-md-offset-2 col-sm-3 col-sm-offset-2">
											<input type="submit" name="code-cancel" id="code-cancel"
												   class="form-control btn btn-danger" value="Cancel">
										</div>
										<div class="col-lg-3 col-lg-offset-2 col-md-3 col-md-offset-2 col-sm-3 col-sm-offset-2">
											<input type="submit" name="code-success" id="code-success"
												   class="form-control btn btn-success" value="Continue">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include('includes/footer.php') ?>