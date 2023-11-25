<div class="card-group">
 <div class="card" style="background: transparent;">
     <div class="card-body">
         <!-- Page 1 -->
     <div class="card-deck">
<?php
$limit = 2; // Jumlah data per halamannya
$limit_start = (1 - 1) * $limit;

$queryPoli = mysqli_query($koneksidb, "SELECT antrian.nomor_antrian, poli.id, poli.nama_poli, poli.inisial FROM poli
LEFT JOIN antrian ON poli.id_antrian=antrian.id WHERE id_antrian!='0' ORDER BY poli.id DESC LIMIT $limit_start, $limit");
while ($dataPoli = mysqli_fetch_array($queryPoli)) {
    $totalAntrian = mysqli_num_rows(mysqli_query($koneksidb, "SELECT * FROM antrian WHERE id_poli='$dataPoli[id]' AND tanggal='" . date('Y-m-d') . "'"));

    ?>
<div class="card" style="background: transparent;">
  <div class="card-header bg-primary text-white">
 <div style="font-size:30px; font-weight:bold; text-align: center;"><?php echo strtoupper($dataPoli['nama_poli']); ?></div>
  </div>
    <div class="card-body">
    <h5 class="card-title"><center>Total Antrian Hari ini</center></h5>
    <div style="font-size:50px; font-weight:bold; text-align: center;"><?php echo $totalAntrian; ?></div>
    </div>
     </div>
<?php }?>
     </div>
     <br/>
     <!-- Page 2 -->
     <div class="card-deck">
<?php
$limit = 2; // Jumlah data per halamannya
$limit_start = (2 - 1) * $limit;

$queryPoli = mysqli_query($koneksidb, "SELECT antrian.nomor_antrian,  poli.id, poli.nama_poli, poli.inisial FROM poli
LEFT JOIN antrian ON poli.id_antrian=antrian.id WHERE id_antrian!='0' ORDER BY poli.id DESC LIMIT $limit_start, $limit");
while ($dataPoli = mysqli_fetch_array($queryPoli)) {
    $totalAntrian = mysqli_num_rows(mysqli_query($koneksidb, "SELECT * FROM antrian WHERE id_poli='$dataPoli[id]' AND tanggal='" . date('Y-m-d') . "'"));
    ?>
<div class="card" style="background: transparent;">
  <div class="card-header bg-primary text-white">
 <div style="font-size:30px; font-weight:bold; text-align: center;"><?php echo strtoupper($dataPoli['nama_poli']); ?></div>
  </div>
    <div class="card-body">
    <h5 class="card-title"><center>Total Antrian Hari ini</center></h5>
    <div style="font-size:50px; font-weight:bold; text-align: center;"><?php echo $totalAntrian; ?></div>
    </div>
     </div>
<?php }?>
     </div>
     <br/>
       <!-- Page 3 -->
       <div class="card-deck">
<?php
$limit = 2; // Jumlah data per halamannya
$limit_start = (3 - 1) * $limit;

$queryPoli = mysqli_query($koneksidb, "SELECT antrian.nomor_antrian, poli.id, poli.nama_poli, poli.inisial FROM poli
LEFT JOIN antrian ON poli.id_antrian=antrian.id WHERE id_antrian!='0' ORDER BY poli.id DESC LIMIT $limit_start, $limit");
while ($dataPoli = mysqli_fetch_array($queryPoli)) {
    $totalAntrian = mysqli_num_rows(mysqli_query($koneksidb, "SELECT * FROM antrian WHERE id_poli='$dataPoli[id]' AND tanggal='" . date('Y-m-d') . "'"));
    ?>
<div class="card" style="background: transparent;">
  <div class="card-header bg-primary text-white">
 <div style="font-size:30px; font-weight:bold; text-align: center;"><?php echo strtoupper($dataPoli['nama_poli']); ?></div>
  </div>
    <div class="card-body">
    <h5 class="card-title"><center>Total Antrian Hari ini</center></h5>
    <div style="font-size:50px; font-weight:bold; text-align: center;"><?php echo $totalAntrian; ?></div>
    </div>
     </div>
<?php }?>
     </div>
     <br/>
       <!-- Page 4 -->
       <div class="card-deck">
<?php
$limit = 2; // Jumlah data per halamannya
$limit_start = (4 - 1) * $limit;

$queryPoli = mysqli_query($koneksidb, "SELECT antrian.nomor_antrian, poli.id, poli.nama_poli, poli.inisial FROM poli
LEFT JOIN antrian ON poli.id_antrian=antrian.id WHERE id_antrian!='0' ORDER BY poli.id DESC LIMIT $limit_start, $limit");
while ($dataPoli = mysqli_fetch_array($queryPoli)) {
    $totalAntrian = mysqli_num_rows(mysqli_query($koneksidb, "SELECT * FROM antrian WHERE id_poli='$dataPoli[id]' AND tanggal='" . date('Y-m-d') . "'"));
    ?>
<div class="card" style="background: transparent;">
  <div class="card-header bg-primary text-white">
 <div style="font-size:30px; font-weight:bold; text-align: center;"><?php echo strtoupper($dataPoli['nama_poli']); ?></div>
  </div>
    <div class="card-body">
    <h5 class="card-title"><center>Total Antrian Hari ini</center></h5>
    <div style="font-size:50px; font-weight:bold; text-align: center;"><?php echo $totalAntrian; ?></div>
    </div>
     </div>
<?php }?>
     </div>
     <br/>
       <!-- Page 5 -->
       <div class="card-deck">
<?php
$limit = 2; // Jumlah data per halamannya
$limit_start = (5 - 1) * $limit;

$queryPoli = mysqli_query($koneksidb, "SELECT antrian.nomor_antrian, poli.id, poli.nama_poli, poli.inisial FROM poli
LEFT JOIN antrian ON poli.id_antrian=antrian.id WHERE id_antrian!='0' ORDER BY poli.id DESC LIMIT $limit_start, $limit");
while ($dataPoli = mysqli_fetch_array($queryPoli)) {
    $totalAntrian = mysqli_num_rows(mysqli_query($koneksidb, "SELECT * FROM antrian WHERE id_poli='$dataPoli[id]' AND tanggal='" . date('Y-m-d') . "'"));
    ?>
<div class="card" style="background: transparent;">
  <div class="card-header bg-primary text-white">
 <div style="font-size:30px; font-weight:bold; text-align: center;"><?php echo strtoupper($dataPoli['nama_poli']); ?></div>
  </div>
    <div class="card-body">
    <h5 class="card-title"><center>Total Antrian Hari ini</center></h5>
    <div style="font-size:50px; font-weight:bold; text-align: center;"><?php echo $totalAntrian; ?></div>
    </div>
     </div>
<?php }?>
     </div>
     </div>
 </div>
  </div>
