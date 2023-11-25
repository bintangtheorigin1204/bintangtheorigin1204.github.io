<?php
include_once "../class/class_connection.php";
$id = $_GET['id'];
$query = mysqli_query($koneksidb,"SELECT * FROM poli where id='$id'");
$data = mysqli_fetch_assoc($query);
echo json_encode($data);
?>