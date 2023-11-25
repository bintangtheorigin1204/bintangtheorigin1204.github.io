<style>
    body{
        bgcolor:"#e9ecef";
    }
</style>
<?php
include_once "../class/class_connection.php";

$qry2 = mysqli_query($koneksidb,"SELECT * FROM company_profile WHERE id='1'");
$data2 = mysqli_fetch_array($qry2);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="5" />
<title>Aplikasi Antrian Klinik</title>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<script type="text/javascript" src="../jquery-1.7.2.js"></script>
</head>
<body>
<div class="card-group m-2">
 <div class="card">
     <div class="card-body">
         <!-- Page 1 -->
     <div class="card-group">
<?php
$limit = 2; // Jumlah data per halamannya
$limit_start = (1 - 1) * $limit;

$queryPoli = mysqli_query($koneksidb, "SELECT antrian.nomor_antrian, poli.nama_poli, poli.inisial FROM poli
LEFT JOIN antrian ON poli.id_antrian=antrian.id WHERE id_antrian!='0' ORDER BY poli.id DESC LIMIT $limit_start, $limit");
while ($dataPoli = mysqli_fetch_array($queryPoli)) { 
?>
<div class="card">
  <div class="card-header bg-danger text-white">
 <div style="font-size:30px; font-weight:bold; text-align: center;"><?php echo strtoupper($dataPoli['nama_poli']);?></div>
  </div>
    <div class="card-body">
    <div style="font-size:50px; font-weight:bold; text-align: center;"><?php echo $dataPoli['inisial']. $dataPoli['nomor_antrian'];?></div>
    </div>
     </div>
<?php } ?>
     </div>
     <!-- Page 2 -->
     <div class="card-group">
<?php
$limit = 2; // Jumlah data per halamannya
$limit_start = (2 - 1) * $limit;

$queryPoli = mysqli_query($koneksidb, "SELECT antrian.nomor_antrian, poli.nama_poli, poli.inisial FROM poli
LEFT JOIN antrian ON poli.id_antrian=antrian.id WHERE id_antrian!='0' ORDER BY poli.id DESC LIMIT $limit_start, $limit");
while ($dataPoli = mysqli_fetch_array($queryPoli)) { 
?>
<div class="card">
  <div class="card-header bg-danger text-white">
 <div style="font-size:30px; font-weight:bold; text-align: center;"><?php echo strtoupper($dataPoli['nama_poli']);?></div>
  </div>
    <div class="card-body">
    <div style="font-size:50px; font-weight:bold; text-align: center;"><?php echo $dataPoli['inisial']. $dataPoli['nomor_antrian'];?></div>
    </div>
     </div>
<?php } ?>
     </div>
       <!-- Page 3 -->
       <div class="card-group">
<?php
$limit = 2; // Jumlah data per halamannya
$limit_start = (3 - 1) * $limit;

$queryPoli = mysqli_query($koneksidb, "SELECT antrian.nomor_antrian, poli.nama_poli, poli.inisial FROM poli
LEFT JOIN antrian ON poli.id_antrian=antrian.id WHERE id_antrian!='0' ORDER BY poli.id DESC LIMIT $limit_start, $limit");
while ($dataPoli = mysqli_fetch_array($queryPoli)) { 
?>
<div class="card">
  <div class="card-header bg-danger text-white">
 <div style="font-size:30px; font-weight:bold; text-align: center;"><?php echo strtoupper($dataPoli['nama_poli']);?></div>
  </div>
    <div class="card-body">
    <div style="font-size:50px; font-weight:bold; text-align: center;"><?php echo $dataPoli['inisial']. $dataPoli['nomor_antrian'];?></div>
    </div>
     </div>
<?php } ?>
     </div>
       <!-- Page 4 -->
       <div class="card-group">
<?php
$limit = 2; // Jumlah data per halamannya
$limit_start = (4 - 1) * $limit;

$queryPoli = mysqli_query($koneksidb, "SELECT antrian.nomor_antrian, poli.nama_poli, poli.inisial FROM poli
LEFT JOIN antrian ON poli.id_antrian=antrian.id WHERE id_antrian!='0' ORDER BY poli.id DESC LIMIT $limit_start, $limit");
while ($dataPoli = mysqli_fetch_array($queryPoli)) { 
?>
<div class="card">
  <div class="card-header bg-danger text-white">
 <div style="font-size:30px; font-weight:bold; text-align: center;"><?php echo strtoupper($dataPoli['nama_poli']);?></div>
  </div>
    <div class="card-body">
    <div style="font-size:50px; font-weight:bold; text-align: center;"><?php echo $dataPoli['inisial']. $dataPoli['nomor_antrian'];?></div>
    </div>
     </div>
<?php } ?>
     </div>
       <!-- Page 5 -->
       <div class="card-group">
<?php
$limit = 2; // Jumlah data per halamannya
$limit_start = (5 - 1) * $limit;

$queryPoli = mysqli_query($koneksidb, "SELECT antrian.nomor_antrian, poli.nama_poli, poli.inisial FROM poli
LEFT JOIN antrian ON poli.id_antrian=antrian.id WHERE id_antrian!='0' ORDER BY poli.id DESC LIMIT $limit_start, $limit");
while ($dataPoli = mysqli_fetch_array($queryPoli)) { 
?>
<div class="card">
  <div class="card-header bg-danger text-white">
 <div style="font-size:30px; font-weight:bold; text-align: center;"><?php echo strtoupper($dataPoli['nama_poli']);?></div>
  </div>
    <div class="card-body">
    <div style="font-size:50px; font-weight:bold; text-align: center;"><?php echo $dataPoli['inisial']. $dataPoli['nomor_antrian'];?></div>
    </div>
     </div>
<?php } ?>
     </div>
     </div>
 </div>
  <div class="card">
    <div class="card-body p-2">
      <p class="card-text"><?php echo $data2['isi'];?></p>
    </div>
  </div>
  </div>
</div>
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>