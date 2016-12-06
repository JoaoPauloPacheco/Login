<?php
include('includes/header.php');
include('includes/nav.php');
include('includes/content.php');
?>

    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <?php display_message();

            validate_login_form();
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">

                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="login.php" class="active" id="form-login-link">Login</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="register.php" id="">Register</a>
                        </div>
                    </div>
                    <hr>
                </div> <!-- /panel-heading -->

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="form-login" method="post" role="form" style="display: block;">
                                <div class="form-group">
                                    <input type="email" name="email" id="email-login" tabindex="1" class="form-control" placeholder="Email" value="" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password-login" tabindex="2" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="form-group text-center">
                                    <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                    <label for="remember"> Remember me</label>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="submit-login" id="submit-login" tabindex="4" class="form-control btn btn-primary text-uppercase" value="Login">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <a href="recover.php" tabindex="5" class="forgot-password">Forgot Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form> <!-- /form -->
                        </div>
                    </div>
                </div> <!-- /panel-body -->
            </div> <!-- /panel -->
        </div>
    </div>

<?php include('includes/footer.php') ?>