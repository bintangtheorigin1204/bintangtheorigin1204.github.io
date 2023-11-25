<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-2">
<!-- <div class="container"> -->
  <a class="navbar-brand" href="#">ANTRIAN KLINIK</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php if(!empty($_SESSION['SES_LOGIN'])){?>
    <li class="nav-item active"> <a class="nav-link" href="?page=home">Home</a></li>
    <?php if ($_SESSION['SES_LEVEL'] == 'Administrator') {?>
      <li class="nav-item"><a class="nav-link" href="?page=pasien">Pasien</a> </li>
      <li class="nav-item"><a class="nav-link" href="?page=antrian">Antrian</a></li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Master Data
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="?page=user">User</a>
          <a class="dropdown-item" href="?page=poli">Poli</a>
          <a class="dropdown-item" href="?page=profile">Profile</a>
        </div>
      </li>
    </ul>
    <div class="my-2 my-lg-0">
    <ul class="navbar-nav">
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Hi <?php
echo $_SESSION['SES_LOGIN_USERNAME'];
    ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
      <?php } elseif ($_SESSION['SES_LEVEL'] == 'Admin') {?>
        <li class="nav-item"><a class="nav-link" href="?page=pasien">Pasien</a> </li>
      <li class="nav-item"><a class="nav-link" href="?page=antrian">Antrian</a></li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Master Data
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="?page=poli">Poli</a>
          <a class="dropdown-item" href="?page=profile">Profile</a>
        </div>
      </li>
    </ul>
    <div class="my-2 my-lg-0">
    <ul class="navbar-nav">
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Hi <?php echo $_SESSION['SES_LOGIN_USERNAME']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
      <?php } else {?>
      <li class="nav-item"><a class="nav-link" href="?page=panggil-antrian&hal=1">Panggil Antrian</a></li>
     
    </ul>
    <div class="my-2 my-lg-0">
    <ul class="navbar-nav">
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Hi <?php echo $_SESSION['SES_LOGIN_USERNAME']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
      <?php 
        }
      }
      ?>
    </ul>
    <?php if(empty($_SESSION['SES_LOGIN'])){?>
    <div class="my-2 my-lg-0">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link text-white btn btn-success" href="login.php">Login</a> </li>
    </ul>
</div>
<?php  } ?>
</div>
  </div>
<!-- </div> -->
</nav>
