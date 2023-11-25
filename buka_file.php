<?php
# KONTROL MENU PROGRAM

if($_GET) {
	// Jika mendapatkan variabel URL ?page
	switch($_GET['page']){				

	//Member Area
			
		case 'home' :
			if(!file_exists ("konten.php")) die ("Sorry Empty Page!"); 
			include "konten.php"; break;
      case 'login' :
			if(!file_exists ("login.php")) die ("Sorry Empty Page!"); 
			include "login.php"; break;
		case 'logout' :
			if(!file_exists ("logout.php")) die ("Sorry Empty Page!"); 
			include "logout.php"; break;
		case 'pasien' :
			if(!file_exists ("pasien.php")) die ("Sorry Empty Page!"); 
			include "pasien.php"; break;
		case 'antrian' :
			if(!file_exists ("antrian.php")) die ("Sorry Empty Page!"); 
			include "antrian.php"; break;
			case 'panggil-antrian' :
		if(!file_exists ("panggil_antrian.php")) die ("Sorry Empty Page!"); 
			include "panggil_antrian.php"; break;
		case 'poli' :
			if(!file_exists ("poli.php")) die ("Sorry Empty Page!"); 
			include "poli.php"; break;
		case 'user' :
			if(!file_exists ("user.php")) die ("Sorry Empty Page!"); 
			include "user.php"; break;
		case 'user-edit' :
			if(!file_exists ("edit_user.php")) die ("Sorry Empty Page!"); 
			include "edit_user.php"; break;
		case 'profile' :
			if(!file_exists ("profile.php")) die ("Sorry Empty Page!"); 
			include "profile.php"; break;
		
	//# Upload dan Download
		case 'Upload' :
			if(!file_exists ("upload.php")) die ("Sorry Empty Page!"); 
			include "upload.php"; break;
		

	}
}

?>