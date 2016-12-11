<nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Login System</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
              <?php if (logged_in()){ ?>
                  <li><a href="admin.php">Admin</a></li>
                  <li><a href="logout.php">Logout</a></li>
              <?php  } ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
</nav> <!-- /nav -->
