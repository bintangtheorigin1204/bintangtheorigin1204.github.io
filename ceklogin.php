<?php 
  include "class/class_connection.php";

if(isset($_POST['btnLogin'])){
	# Baca variabel form
	$username 	= $_POST['username'];
	//$email 	= str_replace("'","&acute;",$email);
	$password   = md5($_POST['password']);
	//$txtPassword= str_replace("'","&acute;",$txtPassword);
	
		 
# LOGIN CEK KE TABEL USER LOGIN
		$loginQry = mysqli_query($koneksidb,"SELECT * FROM user WHERE username='$username' AND password='$password'");

		# JIKA LOGIN SUKSES
		if (mysqli_num_rows($loginQry) >=1) {
			$loginData = mysqli_fetch_array($loginQry);
           
            session_start();
			$_SESSION['SES_LOGIN'] 	= $loginData['id'];
			$_SESSION['SES_LOGIN_USERNAME'] = $loginData['username']; 
            $_SESSION['SES_LEVEL'] 	= $loginData['level'];
			
		   echo "<meta http-equiv='refresh' content='0; url=index.php?page=home'>";
        }else{
            echo "<meta http-equiv='refresh' content='0; url=index.php'>";
        }
    }
			
// End POST
?>