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
                            <form id="form-login" method="post" role="form">
                                <div class="form-group">
                                    <input type="email" name="email" id="email-register" class="form-control" placeholder="Email" value="" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                </div>
                                <!-- remember me -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="submit-login" id="submit-login" class="form-control btn btn-primary text-uppercase" value="Login">
                                        </div>
                                    </div>
                                </div>
                                <!-- forgot password -->
                            </form> <!-- /form -->
                        </div>
                    </div>
                </div> <!-- /panel-body -->
            </div> <!-- /panel -->
        </div>
    </div>

<?php include('includes/footer.php') ?>