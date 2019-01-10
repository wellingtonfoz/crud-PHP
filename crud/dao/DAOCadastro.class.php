<?php
require_once("ConexaoMySql.class.php");
set_include_path(dirname(__FILE__)."/../");

require_once("dados/Cadastro.class.php");


if(isset($_GET['getCadastros'])){
	$obj = new DAOCadastro(); 
	$obj->getCadastros($_GET['soAtivos']);
}


class DAOCadastro{
	protected $conexao;

	public function getCadastro($id){

		$sql = "SELECT id,titulo,valor,descricao,complementar,ano,cor,combustivel,km,transmissao,placa,itens,
		desativar from cadastro WHERE id = ?";
		try {
			$this->conexao = new ConexaoMySql();
			$this->conexao->conectar();
			$this->conexao->stmt = $this->conexao->conexao->prepare($sql);
			$this->conexao->stmt->bindValue(1, $id);			
			$run = $this->conexao->stmt->execute();
			$resultado = $this->conexao->stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->conexao->desconectar();
			
			$cadastro = NULL;
			
			foreach ($resultado as $row) {	
				$cadastro = new Cadastro();					
				$cadastro->setId($row['id']);
				$cadastro->setTitulo($row['titulo']);
				$cadastro->setValor($row['valor']);
				$cadastro->setDescricao($row['descricao']);				
				$cadastro->setComplementar($row['complementar']);				
				$cadastro->setCombustivel($row['combustivel']);				
				$cadastro->setAno($row['ano']);				
				$cadastro->setCor($row['cor']);				
				$cadastro->setKm($row['km']);				
				$cadastro->setTransmissao($row['transmissao']);				
				$cadastro->setPlaca($row['placa']);				
				$cadastro->setItens($row['itens']);				
				$cadastro->setDesativar($row['desativar']);		
			}

			return $cadastro;
									
		} catch (Exception $e) {
			echo $e->getMessage();
		}		
	}
	
public function getCadastros($soAtivos){

		$sql = "SELECT id,titulo,valor,descricao,complementar,ano,cor,combustivel,km,transmissao,placa,itens,
		desativar from cadastro WHERE desativar < ? ORDER BY id desc";
		try {
			$this->conexao = new ConexaoMySql();
			$this->conexao->conectar();
			$this->conexao->stmt = $this->conexao->conexao->prepare($sql);
			if($soAtivos){
				$this->conexao->stmt->bindValue(1, 1);		
			}else
				$this->conexao->stmt->bindValue(1, 2);	
			$run = $this->conexao->stmt->execute();
			$resultado = $this->conexao->stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->conexao->desconectar();

			$listaCadastros = NULL;
			foreach ($resultado as $row) {
				$cadastro = new Cadastro();
				$cadastro->setId($row['id']);
				$cadastro->setTitulo($row['titulo']);
				$cadastro->setValor($row['valor']);
				$cadastro->setDescricao($row['descricao']);				
				$cadastro->setComplementar($row['complementar']);				
				$cadastro->setCombustivel($row['combustivel']);				
				$cadastro->setAno($row['ano']);				
				$cadastro->setCor($row['cor']);				
				$cadastro->setKm($row['km']);				
				$cadastro->setTransmissao($row['transmissao']);				
				$cadastro->setPlaca($row['placa']);				
				$cadastro->setItens($row['itens']);				
				$cadastro->setDesativar($row['desativar']);				
 			   	$listaCadastros[] = $cadastro;  				
			}			
			return $listaCadastros;						
		} catch (Exception $e) {
			echo $e->getMessage();
		}		
	}	
	
	public function inserir($cadastro){
		include($_SERVER['DOCUMENT_ROOT']."/crud/controller/ControllerAcesso.class.php");
		
		$sql = "INSERT INTO cadastro VALUES (0, '','R$ ','','','','','','','','A**-****','',0)";

		try {
			$this->conexao = new ConexaoMySql();
			$this->conexao->conectar();
			$this->conexao->stmt = $this->conexao->conexao->prepare($sql);
			$run = $this->conexao->stmt->execute();
			$aux = $this->conexao->conexao->lastInsertId();
			$this->conexao->desconectar();
			return $aux;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
	}
	
	public function alterar($cadastro){
		include($_SERVER['DOCUMENT_ROOT']."/crud/controller/ControllerAcesso.class.php");
		
		$sql = "UPDATE cadastro SET titulo = :titulo,valor = :valor,descricao = :descricao,
		complementar = :complementar,ano = :ano,cor = :cor,combustivel = :combustivel,km = :km,
		transmissao = :transmissao,placa = :placa,itens = :itens,desativar = :desativar
		 WHERE id = :id";
		
		try {
			$this->conexao = new ConexaoMySql();
			$this->conexao->conectar();
			$this->conexao->stmt = $this->conexao->conexao->prepare($sql);
			
			$this->conexao->stmt->bindValue(':titulo', addslashes($cadastro->getTitulo()));
			$this->conexao->stmt->bindValue(':valor', addslashes($cadastro->getValor()));
			$this->conexao->stmt->bindValue(':descricao', addslashes($cadastro->getDescricao()));
			$this->conexao->stmt->bindValue(':complementar', addslashes($cadastro->getComplementar()));
			$this->conexao->stmt->bindValue(':ano', addslashes($cadastro->getAno()));
			$this->conexao->stmt->bindValue(':cor', addslashes($cadastro->getCor()));
			$this->conexao->stmt->bindValue(':combustivel', addslashes($cadastro->getCombustivel()));
			$this->conexao->stmt->bindValue(':km', addslashes($cadastro->getKm()));
			$this->conexao->stmt->bindValue(':transmissao', addslashes($cadastro->getTransmissao()));
			$this->conexao->stmt->bindValue(':placa', addslashes($cadastro->getPlaca()));
			$this->conexao->stmt->bindValue(':itens', addslashes($cadastro->getItens()));
			$this->conexao->stmt->bindValue(':desativar', addslashes($cadastro->getDesativar()));
			$this->conexao->stmt->bindValue(':id', addslashes($cadastro->getId()));
		
			$run = $this->conexao->stmt->execute();
			$resultado = $this->conexao->stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->conexao->desconectar();
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}			
	
	public function deletar($id){
		include($_SERVER['DOCUMENT_ROOT']."/crud/controller/ControllerAcesso.class.php");
		
		require_once($_SERVER['DOCUMENT_ROOT']."/crud/dao/DAOFoto.class.php");

		$daoFoto = new DAOFoto();
		$listaFotos = $daoFoto->getFotosCadastro($id);
		
		if(count($listaFotos) > 0) {
			foreach($listaFotos as $foto) {
				$daoFoto->deletar($foto->getId());
			}
		}		

		$sql = "DELETE FROM cadastro WHERE id = ?";
		
		$this->conexao = new ConexaoMySql();
		try {
			$this->conexao = new ConexaoMySql();
			$this->conexao->conectar();
			$this->conexao->stmt = $this->conexao->conexao->prepare($sql);
			$this->conexao->stmt->bindValue(1, addslashes($id));		
			$run = $this->conexao->stmt->execute();
			$resultado = $this->conexao->stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->conexao->desconectar();
					return true;
		} catch (Exception $e) {
				return false;
		}
		
	}			
}