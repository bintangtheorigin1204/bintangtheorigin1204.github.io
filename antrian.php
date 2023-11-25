<?php
// mencari kode  dengan nilai paling besar
$query = "SELECT max(id) as maxKode FROM antrian";
$hasil = mysqli_query($koneksidb,$query);
$data = mysqli_fetch_array($hasil);
$kode = $data['maxKode'];
 
// mengambil angka atau bilangan dalam kode anggota terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'BRG001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int) substr($kode, 6, 6);
 
// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$noUrut++;
 
// membentuk kode anggota baru
// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%03s", 12); maka akan dihasilkan '012'
// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
$char = "A";
$kode = $char . sprintf("%06s", $noUrut);

# Simpan Variabel KATA KUNCI
$kataKunci = isset($_GET['kataKunci']) ? $_GET['kataKunci'] : '';
$kataKunci = isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : $kataKunci;

if (isset($_POST['btnSimpan'])) {

    $id_pasien = $_POST['id_pasien'];
    $id_poli = $_POST['id_poli'];
    $keluhan = $_POST['keluhan'];
    $dateNow = date('Y-m-d');

    $qryNoTerakhir = mysqli_query($koneksidb, "SELECT * FROM antrian WHERE id_poli='$id_poli' ORDER BY id DESC LIMIT 1");
    $dataNoTerakhir = mysqli_fetch_array($qryNoTerakhir);

    $date = date('Y-m-d', strtotime($dataNoTerakhir['tanggal']));

    if ($date == $dateNow) {
        $noAntrian = $dataNoTerakhir['nomor_antrian'] + 1;
    } else {
        $noAntrian = 1;
    }

    $queryAntrian = mysqli_query($koneksidb, "INSERT INTO antrian
                              (id,id_pasien,nomor_antrian,id_poli,id_user,keluhan,tanggal,waktu)
                              VALUES ('$kode','$id_pasien','$noAntrian','$id_poli','$_SESSION[SES_LOGIN]','$keluhan',now(),now())");

    if ($queryAntrian) {
        header("Location:?page=antrian");
        exit();
    }
}

if (isset($_POST['btnEdit'])) {
    $id = $_GET['id'];
    $id_pasien = $_POST['id_pasien'];
    $id_poli = $_POST['id_poli'];
    $keluhan = $_POST['keluhan'];
    $queryAntrian = mysqli_query($koneksidb, "UPDATE antrian SET id_pasien='$id_pasien', keluhan='$keluhan', id_poli='$id_poli' WHERE id='$id'");

    if ($queryAntrian) {
        header("Location:?page=antrian");
        exit();
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $queryPasien = mysqli_query($koneksidb, "DELETE FROM antrian WHERE id='$id'");

    if ($queryPasien) {
        header("Location:?page=antrian");
        exit();
    }
}

?>
<div class="card" style="background: transparent;">
  <h5 class="card-header">Data Antrian Pasien</h5>
  <div class="card-body">
<?php
if (isset($_GET['edit'])) {
    $qryEdit = mysqli_query($koneksidb, "SELECT pasien.ktp, pasien.nama_pasien, antrian.* FROM antrian 
                                        LEFT JOIN pasien ON antrian.id_pasien=pasien.id WHERE antrian.id='$_GET[id]' ORDER BY antrian.id DESC LIMIT 1");
    $dataEdit = mysqli_fetch_array($qryEdit);

    ?>
        <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="txtNama" value="<?php echo $dataEdit['nama_pasien']; ?>" onclick="window.open('pencarian_pasien.php','popuppage','width=920,toolbar=0,resizable=0,scrollbars=no,height=600,top=100,left=300');" required>
            <input type="hidden" class="form-control" name="id_pasien" id="txtKode" value="<?php echo $dataEdit['id_pasien']; ?>">
          </div>
        </div>
        
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label">NIK</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="txtKtp" value="<?php echo $dataEdit['ktp']; ?>" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Poli</label>
          <div class="col-sm-3">
           <select name="id_poli" class="form-control" required>
             <option value="">--Pilih--</option>
             <?php
$query = mysqli_query($koneksidb, "SELECT * FROM poli");
    while ($data = mysqli_fetch_array($query)) {
        ?>
            <option value="<?php echo $data['id']; ?>" <?php if ($dataEdit['id_poli'] == $data['id']) {echo "selected";}?>><?php echo $data['nama_poli']; ?></option>
      <?php }?>
           </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Keluhan</label>
          <div class="col-sm-6">
            <textarea class="form-control" rows="5" name="keluhan" required><?php echo $dataEdit['keluhan']; ?></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label"></label>
          <div class="col-sm-3">
          <input type="submit" name="btnEdit" class="btn btn-primary" value="Save">
          </div>
        </div>
        </form>
       <?php } else {?>
  <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="txtNama" onclick="window.open('pencarian_pasien.php','popuppage','width=920,toolbar=0,resizable=0,scrollbars=no,height=600,top=100,left=300');">
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">NIK</label>
    <div class="col-sm-4">
    <input type="text" class="form-control" id="txtKtp" readonly>
      <input type="hidden" class="form-control" name="id_pasien" id="txtKode">
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Poli</label>
    <div class="col-sm-3">
     <select name="id_poli" class="form-control" required>
       <option value="">--Pilih--</option>
       <?php
$query = mysqli_query($koneksidb, "SELECT * FROM poli");
    while ($data = mysqli_fetch_array($query)) {
        ?>
          <option value="<?php echo $data['id']; ?>"><?php echo $data['nama_poli']; ?></option>
<?php }?>
     </select>
    </div>
  </div>
  <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Keluhan</label>
          <div class="col-sm-6">
            <textarea class="form-control" name="keluhan" rows="5" required></textarea>
          </div>
        </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label"></label>
    <div class="col-sm-3">
    <input type="submit" name="btnSimpan" class="btn btn-primary" value="Save">
    </div>
  </div>
  </form>
<?php }?>

<hr/>
<form action="index.php?page=antrian" method="post">
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
            <th>Nomor Urut</th>
            <th>Poli</th>
            <th>Dokter</th>
            <th>Keluhan</th>
            <th>Ket</th>
            <th>Tools</th>
        </tr>
        <?php
$page = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
$limit = 100; // Jumlah data per halamannya
$limit_start = ($page - 1) * $limit;

$query = mysqli_query($koneksidb, "SELECT pasien.nama_pasien, pasien.ktp, poli.nama_poli, poli.inisial, poli.nama_dokter,antrian.* FROM antrian
                                   LEFT JOIN pasien ON antrian.id_pasien=pasien.id
                                   LEFT JOIN poli ON antrian.id_poli=poli.id
                                   WHERE pasien.nama_pasien LIKE '%".$kataKunci."%' OR pasien.ktp LIKE '%".$kataKunci."%' ORDER BY antrian.id DESC LIMIT $limit_start, $limit");
$no = 0;
while ($data = mysqli_fetch_array($query)) {
    $no++;
    ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo date('d-m-Y', strtotime($data['tanggal'])); ?> <?php echo $data['waktu']; ?></td>
            <td><?php echo $data['nama_pasien']; ?></td>
            <td><?php echo $data['inisial']. $data['nomor_antrian']; ?></td>
            <td><?php echo $data['nama_poli']; ?></td>
            <td><?php echo $data['nama_dokter']; ?></td>
            <td><?php echo $data['keluhan']; ?></td>
            <td><?php if($data['status']=='Y'){ echo "Dilayani";}else{echo "Tidak dilayani";} ?></td>
            <td><a href="?page=antrian&edit&id=<?php echo $data['id']; ?>" title="Edit data">Edit</a>,
                <a href="?page=antrian&delete&id=<?php echo $data['id']; ?>" title="delete" id="delete" onclick="window.confirm('Apakah anda yakiningin menghapuas data ini ?')">Delete</a>,
                <a href="cetak.php?id=<?php echo $data['id']; ?>" target="new" title="Cetak data">Cetak</a>
              </td>
        </tr>
        <?php }?>
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
          <li class="page-item"><a href="?page=antrian&hal=1&kataKunci=<?php echo $kataKunci;?>"  class="page-link">First</a></li>
          <li class="page-item"><a href="?page=antrian&hal=<?php echo $link_prev; ?>&kataKunci=<?php echo $kataKunci;?>"  class="page-link">&laquo;</a></li>
        <?php
}
?>

        <!-- LINK NUMBER -->
        <?php
// Buat query untuk menghitung semua jumlah data
$sql2 = mysqli_query($koneksidb, "SELECT COUNT(antrian.id) AS jumlah, pasien.nama_pasien, pasien.ktp FROM antrian
                          LEFT JOIN pasien ON antrian.id_pasien=pasien.id
                          WHERE pasien.nama_pasien LIKE '%".$kataKunci."%' OR pasien.ktp LIKE '%".$kataKunci."%'");
$get_jumlah = mysqli_fetch_array($sql2);

$jumlah_page = ceil($get_jumlah['jumlah'] / $limit); // Hitung jumlah halamannya
$jumlah_number = 5; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
$start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1; // Untuk awal link number
$end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number

for ($i = $start_number; $i <= $end_number; $i++) {
    $link_active = ($page == $i) ? ' active' : '';
    ?>
          <li class="page-item <?php echo $link_active; ?>"><a class="page-link" href="?page=antrian&hal=<?php echo $i; ?>&kataKunci=<?php echo $kataKunci;?>"><?php echo $i; ?></a></li>
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
          <li class="page-item"><a class="page-link" href="?page=antrian&hal=<?php echo $link_next; ?>&kataKunci=<?php echo $kataKunci;?>">&raquo;</a></li>
          <li class="page-item"><a class="page-link" href="?page=antrian&hal=<?php echo $jumlah_page; ?>&kataKunci=<?php echo $kataKunci;?>">Last</a></li>
        <?php
}
?>
      </ul>
		 </nav>
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