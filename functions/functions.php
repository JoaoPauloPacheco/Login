<?php 

/**************** Helper functions. *******************/

function clean($string){
    return htmlentities($string);
}

function redirect($location){
    return header("Location: {$location}");
}

function set_message($message){
    if (!empty($message)){
        $_SESSION['message'] = $message;
    } else{
        $message = "";
    }
}

function display_message(){
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

function token_generator(){
    $token = $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    return $token;
}

function validation_errors($error){
    return '<div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>'.$error.'
            </div>';
}

function validation_success($success){
    return '<div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <strong>Thank you! </strong>'.$success.'
            </div>';
}

function email_exists($email){
    $sql = "SELECT id FROM users WHERE email = '$email'";
    $result = query($sql);
    if (row_count($result) == 1){ // If we got email from the database.
        return true;
    } else {
        return false;
    }
}

function username_exists($username){
    $sql = "SELECT id FROM users WHERE username = '$username'";
    $result = query($sql);
    if (row_count($result) == 1){ // If we got email from the database.
        return true;
    } else {
        return false;
    }
}

function send_email($email, $subject, $msg, $headers){
    return mail($email, $subject, $msg, $headers);
}


/**************** Registration functions. *******************/

function validate_registration_form(){
    $errors = [];
    $min = 2;
    $max = 20;
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $first_name         = clean($_POST['first_name']);
        $last_name          = clean($_POST['last_name']);
        $username           = clean($_POST['username']);
        $email              = clean($_POST['email']);
        $password           = clean($_POST['password']);
        $password_confirm   = clean($_POST['password_confirm']);
        // First Name errors.
        if (strlen($first_name) < $min){
            $errors[] = "Your First name cannot be less than {$min} characters.";
        }
        if (strlen($first_name) > $max){
            $errors[] = "Your First name cannot be more than {$max} characters.";
        }
        // Last Name errors.
        if (strlen($last_name) < $min){
            $errors[] = "Your Last name cannot be less than {$min} characters.";
        }
        if (strlen($last_name) > $max){
            $errors[] = "Your Last name cannot be more than {$max} characters.";
        }
        // Username errors.
        if (strlen($username) < $min){
            $errors[] = "Your Username cannot be less than {$min} characters.";
        }
        if (strlen($username) > $max){
            $errors[] = "Your Username cannot be more than {$max} characters.";
        }
        if (username_exists($username)){
            $errors[] = "This Username is already taken.";
        }
        // Email errors.
        if (email_exists($email)){
            $errors[] = "This Email is already registered.";
        }
        // Password errors.
        if ($password !== $password_confirm){
            $errors[] = "Your Password fields do not match.";
        }
        // Display errors.
        if(!empty($errors)){
            foreach ($errors as $error) {
                echo validation_errors($error);
            }
        } else{
            if (register_user($first_name, $last_name, $username, $email, $password)){
                $text = "Please, check your email for activation link.";
                set_message(validation_success($text));
                display_message();
            } else {
                $text = "Sorry, the registration failed. Please, try again.";
                set_message(validation_errors($text));
                display_message();
            }
        }
    } // POST
} // end validate_registration_form

function register_user($first_name, $last_name, $username, $email, $password){
    $first_name = escape($first_name);
    $last_name  = escape($last_name);
    $username   = escape($username);
    $email      = escape($email);
    $password   = escape($password);
    if (email_exists($email) || username_exists($username)){
        return false;
    } else {
        $password = md5($password); // hashing the password
        $validation_code = md5($username + microtime()); // creating the validation_code by using username

        $sql = "INSERT INTO users (first_name, last_name, username, email, password, validation_code, active, joined)";
        $sql.=  " VALUES ('$first_name', '$last_name', '$username', '$email', '$password', '$validation_code', 0, CURRENT_TIMESTAMP)";
        $result = query($sql);

        // Sending email.
        $subject = "Account Confirmation";
        $msg = " <p><strong>Hey $first_name $last_name,</strong></p>
                <p>We're ready to activate your account. All we need to do is make sure 
                this is your email address.</p>
                <a href='http://localhost/dev/login/activate.php?email=$email&code=$validation_code'><strong>Verify Address</strong></a>
                <p>If you didn't create an account in our website, just delete this email and 
                everything will go back to the way in was.</p>";
        $headers = "From: noreply@mywebsite.com";
        send_email($email, $subject, $msg, $headers);
        return true;
    }
} // end register_user

function activate_user(){
    if ($_SERVER['REQUEST_METHOD'] == "GET"){
        if (isset($_GET['email'])){
            $email = clean($_GET['email']);
            $validation_code = clean($_GET['code']);

            $sql = "SELECT id FROM users WHERE email = '".escape($_GET['email'])."' ";
            $sql.= "AND validation_code = '".escape($_GET['code'])."'";
            $result = query($sql);

            if(row_count($result) == 1) {
                $sql2 ="UPDATE users SET active = 1, validation_code = 0 
                        WHERE email = '".escape($email)."' AND validation_code = '".escape($validation_code)."'";
                $result2 = query($sql2);

                $text = "Your account has been activated. Please, login.";
                set_message(validation_success($text));
                redirect("login.php");
            } else {
                $text = "Sorry, your account could not be activated.";
                set_message(validation_errors($text));
                redirect("login.php");
            }
        } else {

        }
    }
} // end activate_user

/**************** Login functions. *******************/

function validate_login_form(){
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $email      = clean($_POST['email']);
        $password   = clean($_POST['password']);
        $remember   = isset($_POST['remember']);
        if (empty($email)){
            $errors[] = "Please, type in your Email address.";
        }
        if (empty($password)){
            $errors[] = "Please, type in your Password.";
        }
        if(!empty($errors)){
            foreach ($errors as $error) {
                echo validation_errors($error);
            }
        } else {
            if(login_user($email, $password, $remember)) {
                redirect("admin.php");
            } else {
                echo validation_errors("Wrong Email or Password. Please, try again.");
            }
        }
    }
} // end validate_login_form

function login_user($email, $password, $remember){
    $sql = "SELECT id, password FROM users WHERE email = '".escape($email)."' AND active = 1";
    $result = query($sql);
    if(row_count($result) == 1){ // if the query returns a result - it has some data in it.
        $row = fetch_array($result);
        $db_password = $row['password'];
        if(md5($password) === $db_password){
            if($remember == "on"){ // if checkbox is checked
                // Set cookie called $email for time = 1 day (change for any time).
                setcookie('email', $email, time() + 86400);

            }
            $_SESSION['email'] = $email;
            return true;
        } else{
            return false;
        }
        return true;
    } else{
        return false;
    }
} // end login_user

function logged_in(){
    if (isset($_SESSION['email']) || isset($_COOKIE['email'])){
        return true;
    } else {
        return false;
    }
} // end logged_in

/**************** Password Recover functions. *******************/

function recover_password(){
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']){
            $email = clean($_POST['email']);
            if(email_exists($email)){
                $validation_code = md5($email + microtime());
                setcookie('temp_code', $validation_code, time()+1800); // 30 minutes.

                $sql = "UPDATE users SET validation_code = '".escape($validation_code)."' 
                        WHERE email = '".escape($email)."'";
                $result = query($sql);

                $subject = "Reset password";
                $message = "<p>Please, copy this code {$validation_code} and paste it into the code</p>
                    <p>validation field by going to this page: </p>
                    <p><a href='http://localhost/dev/login/code.php?email=$email&code=$validation_code'>Code page</a></p>";
                $headers = "From: noreply@mywebsite.com";
                if (send_email($email, $subject, $message, $headers)){
                    echo validation_success("Email has been sent. Please, check your email.");
                } else{
                    echo validation_errors("Email could not be sent.");
                }
            } else {
                echo validation_errors("This email was not registered. Please try again.");
            }
        } else {
            redirect("index.php");
        }
    }
} // end recover_password

function validate_code(){
    if (isset($_COOKIE['temp_code'])){
        if(!isset($_GET['email']) && !isset($_GET['code'])){
            redirect("index.php");
        } elseif (empty($_GET['email']) || empty($_GET['code'])){
            redirect("index.php");
        } else {
            if(isset($_POST['code'])) {
                $email = clean($_GET['email']);
                $validation_code = clean($_POST['code']);
                $sql = "SELECT id FROM users WHERE validation_code = '".escape($validation_code)."' 
                        AND email = '".escape($email)."'";
                $result = query($sql);

                if (row_count($result) == 1){
                    redirect("reset.php?email=$email&code=$validation_code");
                } else {
                    echo validation_errors("Sorry, wrong validation code. Please, try again.");
                }
            }
        }

    } else {
        $text = "Sorry, your verification code has expired. Please, try again.";
        set_message(validation_errors($text));
        redirect("recover.php");
    }
}



