<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
		<div class="card m-5" style="background:  url(../assets/img/dasha_taran.png);">
			<div class="card-header">
				Login Antrian Klinik Bintang
			</div>
		<div class="card-body">
<form action="ceklogin.php" method="POST">
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-3 col-form-label">Username</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="username" placeholder="Username" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" name="password" placeholder="Password" required>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-8">
      <input type="submit" class="btn btn-primary" value="Sign in" name="btnLogin">
    </div>
  </div>
</form>
		</div>
</div>
        </div>
    </div>
</div>