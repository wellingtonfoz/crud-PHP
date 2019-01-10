<?php
class ConexaoMySql {
    // Coloque aqui as Informações do Banco de Dados
   private $servidor = "localhost";
   private $usuario = "root"; # Usuário no Host/Servidor
   private $senha = ""; # Senha no Host/Servidor
   private $bd = "crud"; # Nome do seu Banco de Dados
   
   var $conexao;
   var $stmt;
    // Cria a função para query no Banco de Dados
    function conectar(){
		
		try {
			$this->conexao = new PDO("mysql:host=".$this->servidor.";dbname=".$this->bd, $this->usuario, $this->senha);
			$this->conexao->exec("set names utf8");			
		  } 
		  catch(PDOException $e){
			throw new Exception('Não foi possível conectar: ' . $e->getMessage());
		  }
    }
	
    function desconectar(){
		
		$this->conexao = NULL;
    }	
}