<?php
session_start();
include_once "class/class_connection.php";
// include_once "class/class_session.php";
ini_set('date.timezone', 'Asia/Jakarta');

$query = mysqli_query($koneksidb, "SELECT pasien.nama_pasien, poli.nama_poli, poli.nama_dokter, poli.inisial,antrian.* FROM antrian
                                   LEFT JOIN pasien ON antrian.id_pasien=pasien.id
                                   LEFT JOIN poli ON antrian.id_poli=poli.id
                                   WHERE antrian.id='$_GET[id]'");
$data = mysqli_fetch_array($query);
?>
<html>
    <head>
        <title>Cetak nomor antrian</title>
    </head>
    <body onload="window.print()">
    <table border="0" width="100%">
        <tr>
            <td>Tanggal</td>
            <td>: <?php echo date('d F Y', strtotime($data['tanggal'])); ?> <?php echo $data['waktu']; ?></td>
        </tr>
        <tr>
            <td>Nama pasien</td>
            <td>: <?php echo $data['nama_pasien']; ?></td>
        </tr>
        <tr>
            <td>Keluhan</td>
            <td>: <?php echo $data['keluhan']; ?></td>
        </tr>
        <tr height="100">
            <td></td>
            <td></td>
        </tr>
    </table>
    <table border="0" width="100%">
    <tr>
        <td colspan="2" align="center">
            <div class="mb-0" style="font-size: 24px; font-weight: bold;">
            <?php echo $data['nama_poli']; ?>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <div class="mb-0" style="font-size: 30px; font-weight: bold;">
            <?php echo "Antrian"; ?>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <div class="mb-0" style="font-size: 60px; font-weight: bold;">
            <?php echo "No. ". $data['inisial']. $data['nomor_antrian']; ?>
            </div>
        </td>
    </tr>
</table>
<a href="#" onclick="window.print();">Cetak</a>
    </body>
</html>


