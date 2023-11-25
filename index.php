<?php
session_start();
include_once "class/class_connection.php";
include_once "class/class_session.php";
ini_set('date.timezone', 'Asia/Jakarta');
//Initialisasi nilai untuk nomor loket
//Pada kasus nyata nomor loket dimabil pada saat login
//sesuai dengan data pada tabel admin
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aplikasi Antrian Klinik</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<script type="text/javascript" src="jquery-1.7.2.js"></script>
<script type="text/javascript" >
$(document).ready(function(){
	$("#play").click(function(){
		document.getElementById('suarabel').play();
	});


});
</script>
</head>
<body>
	<?php include_once "menu.php";?>
		<div class="m-3">
			<?php include_once "buka_file.php"; ?>
		</div>
</body>
</html>

<script src="assets/js/bootstrap.min.js"></script>