<?php
include('includes/header.php');
include('includes/nav.php');
include('includes/content.php');
?>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <?php validate_registration_form();


            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">

                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="login.php">Login</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="register.php" class="active" id="">Register</a>
                        </div>
                    </div>
                    <hr>
                </div> <!-- /panel-heading -->

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="form-register" method="post" role="form">
                                <div class="form-group">
                                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email-register" class="form-control" placeholder="Email Address" value="" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Confirm Password" required>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="submit-register" id="submit-register" class="form-control btn btn-success text-uppercase" value="Register">
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

<?php
include('includes/footer.php');
?>