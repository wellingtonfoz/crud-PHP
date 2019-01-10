<?php
@session_start("admin");
unset($_SESSION['admin']);
//session_destroy();

echo "<script>location.href='/crud/index.php'</script>";
?>
