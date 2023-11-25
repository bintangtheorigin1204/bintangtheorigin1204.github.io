<?php
if (isset($_POST['btnSimpan'])) {
    $nama     = $_POST['nama'];
    $username = $_POST['username'];
    $level    = $_POST['level'];
    $password = md5($_POST['password']);
    $alamat   = $_POST['alamat'];
    $jk       = $_POST['jk'];
    $queryPasien = mysqli_query($koneksidb, "INSERT INTO user 
                              (username,password,nama,jk,alamat,level,created_at) 
                              VALUES ('$username','$password','$nama','$jk','$alamat','$level',now())");

    if ($queryPasien) {
        header("Location:?page=user");
        exit();
    }
}

if (isset($_POST['btnEdit'])) {
    $id = $_GET['id'];
    $nama     = $_POST['nama'];
    $username = $_POST['username'];
    $level    = $_POST['level'];
    if(!empty($_POST['password'])){
        $password = $_POST['password'];
    }else{
        $password = $_POST['passwordLama'];
    }
    $password = md5($_POST['password']);
    $alamat   = $_POST['alamat'];
    $jk       = $_POST['jk'];

    $queryPasien = mysqli_query($koneksidb, "UPDATE user SET username='$username',
                                                             nama='$nama',
                                                             password='$password',
                                                             jk='$jk',
                                                             alamat='$alamat',
                                                             level='$level'
                                             WHERE id='$id'");

    if ($queryPasien) {
        header("Location:?page=user");
        exit();
    }
}

if (isset($_GET['act']) == 'delete') {
    $id = $_GET['id'];
    $queryPasien = mysqli_query($koneksidb, "DELETE FROM user WHERE id='$id'");

    if ($queryPasien) {
        header("Location:?page=user");
        exit();
    }
}

//Tampil edit
$queryUser = mysqli_query($koneksidb, "SELECT * FROM user WHERE id='$_GET[id]'");
$dataUser = mysqli_fetch_array($queryUser);
?>
<div class="card" style="background: transparent;">
  <h5 class="card-header">Edit Data User</h5>
  <div class="card-body">
  <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
<div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Username</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="username" required value="<?php echo $dataUser['username'];?>">
    </div>
  </div>
   <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Nama</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="nama" value="<?php echo $dataUser['nama'];?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="password">
      <input type="hidden" class="form-control" name="passwordLama"  value="<?php echo $dataUser['password'];?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Jenis Kelamin</label>
    <div class="col-sm-8">
    <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="jk" id="inlineRadio1" value="Laki-laki" <?php if($dataUser['jk']=='Laki-laki'){ echo 'checked';} ?>>
  <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="jk" id="inlineRadio2" value="Perempuan" <?php if($dataUser['jk']=='Perempuan'){ echo 'checked';} ?>>
  <label class="form-check-label" for="inlineRadio2">Perempuan</label>
</div>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Alamat</label>
    <div class="col-sm-8">
      <textarea class="form-control" name="alamat" rows="5" required><?php echo $dataUser['alamat'];?></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Level</label>
    <div class="col-sm-8">
     <select name="level" class="form-control">
       <option value="">--Pilih--</option>
       <option value="Administrator" <?php if($dataUser['level']=='Administrator'){ echo 'selected';} ?>>Administrator</option>
       <!-- <option value="Admin" <?php if($dataUser['level']=='Admin'){ echo 'selected';} ?>>Admin</option> -->
       <?php
$query = mysqli_query($koneksidb, "SELECT * FROM poli");
while ($data = mysqli_fetch_array($query)) {
    ?>
          <option value="<?php echo $data['nama_poli']; ?>" <?php if($dataUser['level']==$data['nama_poli']){ echo 'selected';} ?>><?php echo $data['nama_poli']; ?></option>
<?php }?>
     </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label"></label>
    <div class="col-sm-8">
      <input type="submit" class="btn btn-primary" name="btnEdit" value="Simpan">
    </div>
  </div>
  </form>
  </div>
</div>