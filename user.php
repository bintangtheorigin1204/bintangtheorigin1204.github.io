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
    $nama = $_POST['nama_pasien'];
    $alamat = $_POST['alamat'];
    $queryPasien = mysqli_query($koneksidb, "UPDATE pasien SET nama_pasien='$nama',alamat='$alamat' WHERE id='$id'");

    if ($queryPasien) {
        header("Location:?page=pasien");
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

?>
<div class="card">
  <h5 class="card-header">Data User</h5>
  <div class="card-body">
      <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  ADD DATA
</button>
<hr/>
    <table class="table table-striped">
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Level</th>
            <th>Tools</th>
        </tr>
        <?php
$query = mysqli_query($koneksidb, "SELECT * FROM user ORDER BY id DESC");
$no = 0;
while ($data = mysqli_fetch_array($query)) {
    $no++;
    ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo date('d F Y', strtotime($data['created_at'])); ?></td>
            <td><?php echo $data['username']; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['jk']; ?></td>
            <td><?php echo $data['alamat']; ?></td>
            <td><?php echo $data['level']; ?></td>
            <td><a href="?page=user-edit&id=<?php echo $data['id']; ?>" title="Edit data">Edit</a>,
                 <a href="?page=user&act=delete&id=<?php echo $data['id']; ?>" title="delete" id="delete" onclick="window.confirm('Apakah anda yakiningin menghapuas data ini ?')">Delete</a></td>
        </tr>
        <?php }?>
    </table>
  </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD DATA USER</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Username</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="username" required>
    </div>
  </div>
   <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Nama</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="nama" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="password" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Jenis Kelamin</label>
    <div class="col-sm-8">
    <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="jk" id="inlineRadio1" value="Laki-laki">
  <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="jk" id="inlineRadio2" value="Perempuan">
  <label class="form-check-label" for="inlineRadio2">Perempuan</label>
</div>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Alamat</label>
    <div class="col-sm-8">
      <textarea class="form-control" name="alamat" rows="5" required></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Level</label>
    <div class="col-sm-8">
     <select name="level" class="form-control" required>
       <option value="">--Pilih--</option>
       <option value="Administrator">Administrator</option>
       <!-- <option value="Admin">Admin</option> -->
       <?php
$query = mysqli_query($koneksidb, "SELECT * FROM poli");
while ($data = mysqli_fetch_array($query)) {
    ?>
          <option value="<?php echo $data['nama_poli']; ?>"><?php echo $data['nama_poli']; ?></option>
<?php }?>
     </select>
    </div>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="btnSimpan" class="btn btn-primary" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Edit-->
<div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="POST" id="form-update">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDIT DATA PASIEN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Nama</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Alamat</label>
    <div class="col-sm-8">
    <textarea class="form-control" name="alamat" id="alamat" rows="5" required></textarea>
    </div>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="btnEdit" class="btn btn-primary" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
        /*edit data*/

        $(document).ready(function () {
                $(document).on('click', '#edit_data', function () {
                    var id = $(this).data('id');
                    $('#form-update').attr('action','?page=pasien&id='+id);
                  //  alert('{{ url("user/edit/") }}/'+id);
                    $.ajax({
                        url: "json/pasien-edit.php?id="+id,
                        method: "GET",
                       // data: { id: id },
                        dataType: "json",
                        success: function (data) {
                            $('#alamat').val(data.alamat);
                            $('#nama_pasien').val(data.nama_pasien);
                            // $('#update').val("Simpan Perubahan");
                            $('#editData').modal('show');
                        }
                    });
                });

            });

    </script>
