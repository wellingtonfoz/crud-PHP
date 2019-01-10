<?php
			require_once("../dao/ConexaoMySql.class.php");
			
			extract($_POST);
					

				if($usuario == "admin" && $senha == "admin"){

					@session_start();
					$_SESSION["admin"] = "admin";
					
					header("location:/crud/index.php");
				}
				else{
					header("location:/crud/admin.php");
				}
				

?>