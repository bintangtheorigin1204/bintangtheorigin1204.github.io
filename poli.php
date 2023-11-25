<?php
if(isset($_POST['btnSimpan'])){
    $namaPoli = $_POST['nama_poli'];
    $namaPetugas = $_POST['nama_petugas'];
    $namaDokter = $_POST['nama_dokter'];
    $inisial = $_POST['inisial'];
    $queryPoli = mysqli_query($koneksidb,"INSERT INTO poli (nama_poli,nama_dokter,nama_petugas,inisial,created_at) 
                                VALUES ('$namaPoli','$namaDokter','$namaPetugas','$inisial',now())");

    if($queryPoli){
        header("Location:?page=poli"); 
        exit();
    }else{
        echo "failed";
    }
}

if(isset($_POST['btnEdit'])){
  $id = $_GET['id'];
  $namaPoli = $_POST['nama_poli'];
  $namaPetugas = $_POST['nama_petugas'];
  $namaDokter = $_POST['nama_dokter'];
  $inisial = $_POST['inisial'];
  $queryPoli = mysqli_query($koneksidb,"UPDATE poli SET nama_poli='$namaPoli',
                                                          nama_dokter='$namaDokter',
                                                          nama_petugas='$namaPetugas',
                                                          inisial='$inisial'
                                          WHERE id='$id'");

  if($queryPoli){
      header("Location:?page=poli"); 
      exit();
  }
}

if(isset($_GET['act'])=='delete'){
    $id = $_GET['id'];
    $queryPoli = mysqli_query($koneksidb,"DELETE FROM poli WHERE id='$id'");

    if($queryPoli){
        header("Location:?page=poli"); 
        exit();
    }
}

?>
<div class="card" style="background: transparent;">
  <h5 class="card-header">Data Poli</h5>
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
            <th>Poli</th>
            <th>Dokter</th>
            <th>Petugas</th>
            <th>Inisial</th>
            <th>Tools</th>
        </tr>
        <?php 
        $query = mysqli_query($koneksidb,"SELECT * FROM poli ORDER BY id DESC");
        $no =0;
         while($data= mysqli_fetch_array($query)) { 
        $no++;
            ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo date('d F Y', strtotime($data['created_at'])); ?></td>
            <td><?php echo $data['nama_poli']; ?></td>
            <td><?php echo $data['nama_dokter']; ?></td>
            <td><?php echo $data['nama_petugas']; ?></td>
            <td><?php echo $data['inisial']; ?></td>
            <td><a href="window.onclick(0);" data-id="<?php echo $data['id']; ?>" id="edit_data"
                                    title="Edit data" data-toggle="modal" data-target="#editData">Edit</a>, <a href="?page=poli&act=delete&id=<?php echo $data['id']; ?>" title="delete" id="delete" onclick="window.confirm('Apakah anda yakiningin menghapuas data ini ?')">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
  </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD DATA POLI</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-4 col-form-label">Nama Poli</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="nama_poli" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-4 col-form-label">Nama Dokter</label>
    <div class="col-sm-8">
    <input type="text" class="form-control" name="nama_dokter" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-4 col-form-label">Nama Petugas</label>
    <div class="col-sm-8">
    <input type="text" class="form-control" name="nama_petugas" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-4 col-form-label">Inisial</label>
    <div class="col-sm-8">
    <input type="text" class="form-control" name="inisial" required>
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
    <label for="inputPassword" class="col-sm-4 col-form-label">Nama Poli</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="nama_poli" id="nama_poli" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-4 col-form-label">Nama Dokter</label>
    <div class="col-sm-8">
    <input type="text" class="form-control" name="nama_dokter" id="nama_dokter" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-4 col-form-label">Nama Petugas</label>
    <div class="col-sm-8">
    <input type="text" class="form-control" name="nama_petugas" id="nama_petugas" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-4 col-form-label">Inisial</label>
    <div class="col-sm-8">
    <input type="text" class="form-control" name="inisial" id="inisial" required>
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
                    $('#form-update').attr('action','?page=poli&id='+id);
                  //  alert('{{ url("user/edit/") }}/'+id);
                    $.ajax({
                        url: "json/poli-edit.php?id="+id,
                        method: "GET",
                       // data: { id: id },
                        dataType: "json",
                        success: function (data) {
                            $('#nama_poli').val(data.nama_poli);
                            $('#nama_dokter').val(data.nama_dokter);
                            $('#nama_petugas').val(data.nama_petugas);
                            $('#inisial').val(data.inisial);
                            // $('#update').val("Simpan Perubahan");
                            $('#editData').modal('show');
                        }
                    });
                });

            });
        
    </script>
