<?php

require_once("ConexaoMySql.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crud/dados/Foto.class.php");

if(isset($_POST['acao']))
{
	$daoFoto = new DAOFoto();

	if( $_POST['acao'] == "excluir" )
		$daoFoto->deletar($_POST['id']) ;
	if( $_POST['acao'] == "fotoprincipal" )
		$daoFoto->setFotoPrincipal( $_POST['id'], $_POST['idCadastro'] ) ;
		
}else
	if(isset($_GET['inserir'])){
		$daoFoto = new DAOFoto();
		$id = $_GET['idCadastro'];
		$daoFoto->inserir($_GET['inserir'],$id);
	}else
if(isset($_POST['action'])){
	
	if($_POST['action'] == "getFotoPrincipal"){
		$obj = new DAOFoto(); 
		echo json_encode($obj->getFotoPrincipal($_POST['idcadastro']));
	}else
	if($_POST['action'] == "getFotosCadastro"){
		$obj = new DAOFoto(); 
		echo json_encode($obj->getFotosCadastro($_POST['idcadastro']));
	}
}



class DAOFoto{
	protected $conexao;

	public function getFotoPrincipal($idCadastro){
		$sql = "SELECT fotoPath from foto WHERE cadastro_id = ? 
		 and principal = 1 ORDER BY id LIMIT 1";
		try {
			$this->conexao = new ConexaoMySql();
			$this->conexao->conectar();
			$this->conexao->stmt = $this->conexao->conexao->prepare($sql);
			$this->conexao->stmt->bindValue(1, $idCadastro);		
			$run = $this->conexao->stmt->execute();
			$resultado = $this->conexao->stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->conexao->desconectar();

			foreach ($resultado as $row) {
				return $row['fotoPath']; 				
			}				
			return NULL;						
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
	
	
	public function getFotosCadastro($idCadastro){
		$sql = "SELECT id,fotoPath,principal from foto WHERE cadastro_id = ? 
		ORDER BY id";
		try {
			$this->conexao = new ConexaoMySql();
			$this->conexao->conectar();
			$this->conexao->stmt = $this->conexao->conexao->prepare($sql);
			$this->conexao->stmt->bindValue(1, $idCadastro);		
			$run = $this->conexao->stmt->execute();
			$resultado = $this->conexao->stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->conexao->desconectar();

			$listaFotos = NULL;
			foreach ($resultado as $row) {
				$foto = new Foto();
				$foto->setId($row['id']);
				$foto->setFotoPath($row['fotoPath']);
				$foto->setPrincipal($row['principal']);				
 			   	$listaFotos[] = $foto;  				
			}				
			return $listaFotos;						
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
	public function inserir($nome,$idCadastro){
		include($_SERVER['DOCUMENT_ROOT']."/crud/diversos/controller/ControllerAcesso.class.php");

		$sql = "INSERT INTO foto VALUES (0, '$nome', 0,$idCadastro)";
		
		try {
			$this->conexao = new ConexaoMySql();
			$this->conexao->conectar();
			$this->conexao->stmt = $this->conexao->conexao->prepare($sql);
			$this->conexao->stmt->bindValue(1, $idCadastro);		
			$run = $this->conexao->stmt->execute();
			$resultado = $this->conexao->stmt->fetchAll(PDO::FETCH_ASSOC);
			$aux = $this->conexao->conexao->lastInsertId();
			$this->conexao->desconectar();						
			$aux2[] =  array('id' => $aux);
			echo json_encode($aux2);			
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
	}
	
	
	public function setFotoPrincipal($id, $idCadastro){
		include($_SERVER['DOCUMENT_ROOT']."/crud/diversos/controller/ControllerAcesso.class.php");
		
			$target = $this->getFotoPrincipal($idCadastro);	
			if($target != NULL){
				$targetPath = $_SERVER['DOCUMENT_ROOT'].'/crud/diversos/uploads/uploadsM/';
				$targetFile =  str_replace('//','/',$targetPath).$target;
				$targetPath2 = $_SERVER['DOCUMENT_ROOT'].'/crud/diversos/uploads/uploadsG/';
				$targetFile2 =  str_replace('//','/',$targetPath2).$target;							
						
				if (file_exists($targetFile)) {
					unlink($targetFile);
				} 
				if (file_exists($targetFile2)) {
					unlink($targetFile2);
				} 				
			}			

		$sql = "UPDATE foto SET principal = 0 WHERE principal = 1 and cadastro_id = ?";
		$sql2 = "UPDATE foto SET principal = 1 WHERE id = ?";
		
		try {
			$this->conexao = new ConexaoMySql();
			$this->conexao->conectar();
			$this->conexao->stmt = $this->conexao->conexao->prepare($sql);			
			$this->conexao->stmt->bindValue(1, addslashes($idCadastro));		
			$run = $this->conexao->stmt->execute();
			$resultado = $this->conexao->stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->conexao->desconectar();
			
			$this->conexao = new ConexaoMySql();
			$this->conexao->conectar();
			$this->conexao->stmt = $this->conexao->conexao->prepare($sql2);
			$this->conexao->stmt->bindValue(1, addslashes($id));		
			$run = $this->conexao->stmt->execute();
			$resultado = $this->conexao->stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->conexao->desconectar();			

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
	}		
	
	public function getFotoPath($id){

		$sql = "SELECT fotoPath FROM foto WHERE id = ?";
		
		try {
			$this->conexao = new ConexaoMySql();
			$this->conexao->conectar();
			$this->conexao->stmt = $this->conexao->conexao->prepare($sql);
			$this->conexao->stmt->bindValue(1, addslashes($id));		
			$run = $this->conexao->stmt->execute();
			$resultado = $this->conexao->stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->conexao->desconectar();
			
			foreach ($resultado as $row) {
				return $row['fotoPath'];
			}				
			return NULL;			
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
	}
	
	public function deletar($id){
		include($_SERVER['DOCUMENT_ROOT']."/crud/controller/ControllerAcesso.class.php");

		$fotoPath = $this->getFotoPath($id);
		
			if($fotoPath != NULL){
				$targetPath = $_SERVER['DOCUMENT_ROOT'].'/crud/diversos/uploads/uploadsN/';
				$targetFile =  str_replace('//','/',$targetPath).$fotoPath;
				$targetPath2 = $_SERVER['DOCUMENT_ROOT'].'/crud/diversos/uploads/uploadsP/';
				$targetFile2 =  str_replace('//','/',$targetPath2).$fotoPath;	
				$targetPath3 = $_SERVER['DOCUMENT_ROOT'].'/crud/diversos/uploads/uploadsG/';
				$targetFile3 =  str_replace('//','/',$targetPath3).$fotoPath;	
				$targetPath4 = $_SERVER['DOCUMENT_ROOT'].'/crud/diversos/uploads/uploadsM/';
				$targetFile4 =  str_replace('//','/',$targetPath4).$fotoPath;															
						
				if (file_exists($targetFile)) {
					unlink($targetFile);
				} 
				if (file_exists($targetFile2)) {
					unlink($targetFile2);
				}
				if (file_exists($targetFile3)) {
					unlink($targetFile3);
				}
				if (file_exists($targetFile4)) {
					unlink($targetFile4);
				}								 				
			}		
		
		$sql = "DELETE FROM foto WHERE id = ?";
		
		try {
			$this->conexao = new ConexaoMySql();
			$this->conexao->conectar();
			$this->conexao->stmt = $this->conexao->conexao->prepare($sql);
			$this->conexao->stmt->bindValue(1, addslashes($id));		
			$run = $this->conexao->stmt->execute();
			$resultado = $this->conexao->stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->conexao->desconectar();
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
	}		
		
}