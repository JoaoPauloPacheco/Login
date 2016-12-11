<?php
include('includes/header.php');
include('includes/content.php');
?>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="alert-placeholder">
                <?php
                    display_message();
                    reset_password();
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            <h3>Reset Password</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="form-register" method="post" role="form">
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control"
                                           placeholder="Password" value="" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password-confirm" id="password-confirm" class="form-control"
                                           placeholder="Confirm Password" value="" required>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="reset-submit-password" id="reset-submit-password"
                                                   class="form-control btn btn-success text-uppercase" value="Reset">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="hide" name="token" id="token" value="<?php echo token_generator(); ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include('includes/footer.php') ?>