<script language="JavaScript">
<!-- Begin
function sendValue (s,n,k){

window.opener.document.getElementById('txtKode').value = s;
window.opener.document.getElementById('txtNama').value = n;
window.opener.document.getElementById('txtKtp').value = k;

window.close();
}
//  End -->
</script>
<?php
session_start();
include_once "class/class_session.php";
include_once "class/class_connection.php";

# Simpan Variabel KATA KUNCI
$kataKunci = isset($_GET['kataKunci']) ? $_GET['kataKunci'] : '';
$kataKunci = isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : $kataKunci;

//Query #1 (all)
$filterSQL 	= "SELECT * FROM pasien WHERE nama_pasien LIKE '%".$kataKunci."%' OR ktp LIKE '%".$kataKunci."%' ORDER BY id DESC";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;  // Jumlah baris data
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageQry = mysqli_query($koneksidb, $filterSQL);
$jml	 = mysqli_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pencarian Pasien</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
<table width="900" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2"><h2><b>PENCARIAN PASIEN </b></h2></td>
  </tr>
  <tr>
    <td colspan="2"><table width="552" height="63" border="0"  class="table-list">
      <tr>
        <td colspan="3" bgcolor="#CCCCCC"><strong>PENCARIAN </strong></td>
      </tr>
      <tr>
        <td width="134"><strong>Cari</strong></td>
        <td width="20"><strong>:</strong></td>
        <td width="384"><input name="txtKataKunci" placeholder="nama atau ktp" type="text" value="<?php echo $kataKunci; ?>" size="40" maxlength="100" />
            <input name="btnCari" type="submit" value="Cari" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="2" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <td width="32" bgcolor="#CCCCCC"><strong>No</strong></td>
        <td width="58" bgcolor="#CCCCCC"><strong>Nama</strong></td>
        <td width="58" bgcolor="#CCCCCC"><strong>KTP</strong></td>
        <td width="58" bgcolor="#CCCCCC"><strong>TGL Lahir</strong></td>
        <td width="95" bgcolor="#CCCCCC"><strong>Alamat</strong></td>
        <td width="91" align="right" bgcolor="#CCCCCC"><strong>Action</strong></td>
        </tr>
      <?php
	# MENJALANKAN QUERY CARI DI ATAS
	$myQry 	= mysqli_query($koneksidb,"SELECT * FROM pasien WHERE nama_pasien LIKE '%".$kataKunci."%' OR ktp LIKE '%".$kataKunci."%' ORDER BY id DESC LIMIT $hal, $row");
	$nomor  = 0; 
	while ($myData = mysqli_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['id'];
	?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['nama_pasien']; ?></td>
        <td><?php echo $myData['ktp']; ?></td>
        <td><?php echo date('d-m-Y', strtotime($myData['tgl_lahir'])); ?></td>
        <td><?php echo $myData['alamat']; ?></td>
        <td align="right"><a href="#" onClick="sendValue('<?php echo $myData['id']; ?>','<?php echo $myData['nama_pasien']; ?>','<?php echo $myData['ktp']; ?>');"><span class="btn-xs btn-success"><i class="icon-edit"></i>Pilih</span></a></td>
        </tr>
      <?php } ?>
      <tr>
        <td colspan="2" bgcolor="#CCCCCC"><b>Jumlah Data :</b> <?php echo $jml; ?> </td>
        <td colspan="4" align="right" bgcolor="#CCCCCC"><b>Halaman ke :</b>
        <?php
		for ($h = 1; $h <= $max; $h++) {
			$list[$h] = $row * $h - $row;
			echo " <a href='pencarian_pasien.php?hal=$list[$h]&kataKunci=$kataKunci'>$h</a> ";
		}
		?>	</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>


</body>
</html>