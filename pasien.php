<?php
# Simpan Variabel KATA KUNCI
$kataKunci = isset($_GET['kataKunci']) ? $_GET['kataKunci'] : '';
$kataKunci = isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : $kataKunci;

if(isset($_POST['btnSimpan'])){
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $ktp = $_POST['ktp'];
    $tglLahir = $_POST['tgl_lahir'];
    $queryPasien = mysqli_query($koneksidb,"INSERT INTO pasien (nama_pasien,alamat,ktp, tgl_lahir, tanggal,waktu) VALUES ('$nama','$alamat','$ktp','$tglLahir',now(),now())");

    if($queryPasien ){
        header("Location:?page=pasien"); 
        exit();
    }
}

if(isset($_POST['btnEdit'])){
  $id = $_GET['id'];
  $nama = $_POST['nama_pasien'];
  $alamat = $_POST['alamat'];
  $ktp = $_POST['ktp'];
  $tglLahir = $_POST['tgl_lahir'];
  $queryPasien = mysqli_query($koneksidb,"UPDATE pasien SET nama_pasien='$nama',
                                                            ktp='$ktp',
                                                            tgl_lahir='$tglLahir',
                                                            alamat='$alamat'
                                           WHERE id='$id'");

  if($queryPasien ){
      header("Location:?page=pasien"); 
      exit();
  }
}

if(isset($_GET['act'])=='delete'){
    $id = $_GET['id'];
    $queryPasien = mysqli_query($koneksidb,"DELETE FROM pasien WHERE id='$id'");

    if($queryPasien ){
        header("Location:?page=pasien"); 
        exit();
    }
}

?>
<div class="card" style="background: transparent;">
  <h5 class="card-header">Data Pasien</h5>
  <div class="card-body">
      <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  ADD DATA
</button>
<hr/>
<form action="index.php?page=pasien" method="post">
  <div class="form-row mb-2">
  <div class="input-group mb-3">
  <input type="text" class="form-control col-md-3" value="<?php echo $kataKunci; ?>" name="txtKataKunci" placeholder="Cari nama atau nik" aria-label="Recipient's username" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <input class="btn btn-primary" type="submit" value="Search" name="btnCari">
  </div>
</div>
  </div>
</form>
    <table class="table table-striped">
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>TGL Lahir</th>
            <th>Alamat</th>
            <th>Tools</th>
        </tr>
        <?php 
        $page = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
        $limit = 50; // Jumlah data per halamannya
        $limit_start = ($page - 1) * $limit;

        $query = mysqli_query($koneksidb,"SELECT * FROM pasien WHERE nama_pasien LIKE '%".$kataKunci."%' OR ktp LIKE '%".$kataKunci."%' ORDER BY id DESC LIMIT $limit_start,$limit");
        $no =0;
         while($data= mysqli_fetch_array($query)) { 
        $no++;
            ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo date('d-m-Y', strtotime($data['tanggal'])). " ". $data['waktu']; ?></td>
            <td><?php echo $data['nama_pasien']; ?></td>
            <td><?php echo $data['ktp']; ?></td>
            <td><?php echo date('d-m-Y', strtotime($data['tgl_lahir'])); ?></td>
            <td><?php echo $data['alamat']; ?></td>
            <td><a href="window.onclick(0);" data-id="<?php echo $data['id']; ?>" id="edit_data"
                                    title="Edit data" data-toggle="modal" data-target="#editData">Edit</a>, <a href="?page=pasien&act=delete&id=<?php echo $data['id']; ?>" title="delete" id="delete" onclick="window.confirm('Apakah anda yakiningin menghapuas data ini ?')">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
  </div>
  <div class="card-footer">
  <nav aria-label="Page navigation">
  <ul class="pagination">
        <!-- LINK FIRST AND PREV -->
        <?php
if ($page == 1) { // Jika page adalah page ke 1, maka disable link PREV
    ?>
          <li class="disabled page-item"><a href="#" class="page-link">First</a></li>
          <li class="disabled page-item"><a href="#" class="page-link">&laquo;</a></li>
        <?php
} else { // Jika page bukan page ke 1
    $link_prev = ($page > 1) ? $page - 1 : 1;
    ?>
          <li class="page-item"><a href="?page=pasien&hal=1&kataKunci=<?php echo $kataKunci;?>"  class="page-link">First</a></li>
          <li class="page-item"><a href="?page=pasien&hal=<?php echo $link_prev; ?>&kataKunci=<?php echo $kataKunci;?>"  class="page-link">&laquo;</a></li>
        <?php
}
?>

        <!-- LINK NUMBER -->
        <?php
// Buat query untuk menghitung semua jumlah data
$sql2 = mysqli_query($koneksidb, "SELECT COUNT(*) AS jumlah FROM pasien WHERE nama_pasien LIKE '%".$kataKunci."%' OR ktp LIKE '%".$kataKunci."%'") or die("Query salah : " . mysqli_erno());
$get_jumlah = mysqli_fetch_array($sql2);

$jumlah_page = ceil($get_jumlah['jumlah'] / $limit); // Hitung jumlah halamannya
$jumlah_number = 5; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
$start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1; // Untuk awal link number
$end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number

for ($i = $start_number; $i <= $end_number; $i++) {
    $link_active = ($page == $i) ? ' active' : '';
    ?>
          <li class="page-item <?php echo $link_active; ?>"><a class="page-link" href="?page=pasien&hal=<?php echo $i; ?>&kataKunci=<?php echo $kataKunci;?>"><?php echo $i; ?></a></li>
        <?php
}
?>

        <!-- LINK NEXT AND LAST -->
        <?php
// Jika page sama dengan jumlah page, maka disable link NEXT nya
// Artinya page tersebut adalah page terakhir
if ($page == $jumlah_page) { // Jika page terakhir
    ?>
          <li class="disabled page-item"><a href="#" class="page-link">&raquo;</a></li>
          <li class="disabled page-item"><a href="#" class="page-link">Last</a></li>
        <?php
} else { // Jika Bukan page terakhir
    $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
    ?>
          <li class="page-item"><a class="page-link" href="?page=pasien&hal=<?php echo $link_next; ?>&kataKunci=<?php echo $kataKunci;?>">&raquo;</a></li>
          <li class="page-item"><a class="page-link" href="?page=pasien&hal=<?php echo $jumlah_page; ?>&kataKunci=<?php echo $kataKunci;?>">Last</a></li>
        <?php
}
?>
      </ul>
		 </nav>
  </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD DATA PASIEN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Nama</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="nama" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">KTP</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="ktp">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">TGL Lahir</label>
    <div class="col-sm-8">
      <input type="date" class="form-control" name="tgl_lahir" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">Alamat</label>
    <div class="col-sm-8">
      <textarea class="form-control" name="alamat" rows="5" required></textarea>
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
    <label for="inputPassword" class="col-sm-3 col-form-label">KTP</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="ktp" id="ktp">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-3 col-form-label">TGL Lahir</label>
    <div class="col-sm-8">
      <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" required>
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
                            $('#ktp').val(data.ktp);
                            $('#tgl_lahir').val(data.tgl_lahir);
                            // $('#update').val("Simpan Perubahan");
                            $('#editData').modal('show');
                        }
                    });
                });

            });
        
    </script>
