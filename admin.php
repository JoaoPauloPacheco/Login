<?php
include('includes/header.php');
include('includes/nav.php');
include('includes/content.php');
?>
	
    <div class="jumbotron">
        <h1 class="text-center">Admin
            <?php
                if(logged_in()){
                    echo "You are logged in.";
                } else {
                    redirect("login.php");
                }
            ?>

        </h1>
    </div> <!-- /jumbotron -->

<?php include('includes/footer.php') ?>