<?php
include_once "class/class_connection.php";

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


if (isset($_POST['btnSimpan'])) {
    $ktp = $_POST['ktp'];
    $id_poli = $_POST['id_poli'];
    $keluhan = $_POST['keluhan'];
    $nama_pasien = $_POST['nama_pasien'];
    $dateNow = date('Y-m-d');

    $qryCekPasien = mysqli_query ($koneksidb,"SELECT COUNT('id') AS jmlId, pasien.* FROM pasien WHERE ktp='$ktp'");
    $cekDataPasien = mysqli_fetch_array($qryCekPasien);
    $idPasien = $cekDataPasien['id'];

    if($cekDataPasien['jmlId'] >= '1'){
      //cek antrian terakhir
      $qryNoTerakhir = mysqli_query($koneksidb, "SELECT * FROM antrian WHERE id_poli='$id_poli' ORDER BY id DESC LIMIT 1");
      $dataNoTerakhir = mysqli_fetch_array($qryNoTerakhir);
      $date = date('Y-m-d', strtotime($dataNoTerakhir['tanggal']));

     //Logika reset nomor antrian
      if ($date == $dateNow) {
          $noAntrian = $dataNoTerakhir['nomor_antrian'] + 1;
      } else {
          $noAntrian = 1;
      }
      //Query simpan antrian
      $queryAntrian = mysqli_query($koneksidb, "INSERT INTO antrian
                                (id, id_pasien,nomor_antrian,id_poli,keluhan,tanggal,waktu)
                                VALUES ('$kode','$idPasien','$noAntrian','$id_poli','$keluhan',now(),now())");
  
      if ($queryAntrian) {
          echo "<script>alert('Data berhasil di simpan.'); window.location.href='pendaftaran.php';</script>";
          echo "<script>";
          echo "window.open('cetak.php?id=$kode', width=840,height=600,left=100, top=25)";
          echo "</script>";

          exit();
      } 
    }else{

        //cek antrian terakhir
        $qryNoTerakhir = mysqli_query($koneksidb, "SELECT * FROM antrian WHERE id_poli='$id_poli' ORDER BY id DESC LIMIT 1");
        $dataNoTerakhir = mysqli_fetch_array($qryNoTerakhir);
        $date = date('Y-m-d', strtotime($dataNoTerakhir['tanggal']));

        //Logika reset nomor antrian
        if ($date == $dateNow) {
            $noAntrian = $dataNoTerakhir['nomor_antrian'] + 1;
        } else {
            $noAntrian = 1;
        }
        
        // Query simpan pasien baru
        $queryInsertPasienBaru = mysqli_query($koneksidb, "INSERT INTO pasien (nama_pasien,ktp,tanggal,waktu) VALUES ('$nama_pasien','$ktp',now(),now())");
        $querySelectPasienBaru = mysqli_query($koneksidb,"SELECT * FROM pasien WHERE ktp='$ktp'");
        $dataPasienBaru        = mysqli_fetch_array($querySelectPasienBaru);
        $idPasienBaru          = $dataPasienBaru['id'];
        $queryAntrian = mysqli_query($koneksidb, "INSERT INTO antrian
                                  (id,id_pasien,nomor_antrian,id_poli,keluhan,tanggal,waktu)
                                  VALUES ('$kode','$idPasienBaru','$noAntrian','$id_poli','$keluhan',now(),now())");
    
        if ($queryAntrian) {
          
          echo "<script>";
          echo "window.open('cetak.php?id=$kode', width=1200,height=800,left=0, top=0)";
          echo "</script>";

          echo "<script>alert('Data berhasil di simpan.'); window.location.href='pendaftaran.php';</script>";
          exit();
        } 
    }  
}
?>
<html>

<head>
    <title>Pendaftaran Antrian Pasien</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <?php
include_once "menu.php";
?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background: transparent;">
                <h5 class="card-header">Silahkan Mendaftar</h5>
                <div class="card-body">

                    <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="ktp" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nama_pasien" required>
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
                                    <option value="<?php echo $data['id']; ?>"><?php echo $data['nama_poli']; ?>
                                    </option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Keluhan</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" rows="5" name="keluhan" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-3">
                                <input type="submit" name="btnSimpan" class="btn btn-primary" value="CETAK">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


<script type="text/javascript">
/*edit data*/

$(document).ready(function() {
    $(document).on('click', '#edit_data', function() {
        var id = $(this).data('id');
        $('#form-update').attr('action', '?page=pasien&id=' + id);
        //  alert('{{ url("user/edit/") }}/'+id);
        $.ajax({
            url: "json/pasien-edit.php?id=" + id,
            method: "GET",
            // data: { id: id },
            dataType: "json",
            success: function(data) {
                $('#alamat').val(data.alamat);
                $('#nama_pasien').val(data.nama_pasien);
                // $('#update').val("Simpan Perubahan");
                $('#editData').modal('show');
            }
        });
    });

});
</script>