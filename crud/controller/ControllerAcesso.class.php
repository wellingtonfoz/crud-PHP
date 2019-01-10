<?php
@session_start();
if(!isset($_SESSION["admin"]))
{
				echo "<script language='javaScript'>window.location.href='/crud/admin.php'</script>";	
				exit(1);
}        
?>