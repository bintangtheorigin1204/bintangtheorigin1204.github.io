<?php

session_start();

if(!isset($_SESSION['SES_LOGIN']) ) {

} 
else {

unset($_SESSION);

session_unset();
session_destroy();

};

?>
<script language=javascript> window.location="index.php"</script>