<?php
include("ControllerAcesso.class.php");
require_once("../dados/Cadastro.class.php");
require_once("../dao/DAOCadastro.class.php");

if(isset($_POST['acao']))
{
	$controllerCadastro = new ControllerCadastro();

		if( $_POST['acao'] == "alterar" ){
			$cadastro = $controllerCadastro->obterCadastro($_POST) ;
			$controllerCadastro->alterar($cadastro) ;
		}

}
	if(isset($_GET['acao'])){
			$controllerCadastro = new ControllerCadastro();
			if( $_GET['acao'] == "novo" ){
				$controllerCadastro->inserir() ;
			}else
			if( $_GET['acao'] == "deletar" ){
				$controllerCadastro->deletar($_GET['id']) ;
			}			
	}


class ControllerCadastro{
	
		public function obterCadastro($POST){
			$cadastro = new Cadastro();
			$cadastro->setId($POST['id']);
			$cadastro->setTitulo($POST['titulo']);
			$cadastro->setValor($POST['valor']);
			$cadastro->setDescricao($POST['descricao']);				
			$cadastro->setComplementar($POST['complementar']);				
			$cadastro->setCombustivel($POST['combustivel']);				
			$cadastro->setAno($POST['ano']);				
			$cadastro->setCor($POST['cor']);				
			$cadastro->setKm($POST['km']);				
			$cadastro->setTransmissao($POST['transmissao']);				
			$cadastro->setPlaca($POST['placa']);				
			$cadastro->setDesativar($POST['desativar']);
			
			$itens = "";
			//se mexer aqui, tem que mexer no mesmo atributo em edit
			$possibilidades = "Tração 4x4;Ar Condicionado;CD Player;Controle de Tração;Freios ABS;Retrovisores Elétricos;AirBag;AirBag Duplo;Banco com Ajuste;IPVA Pago;Porta-Copos;Entrada USB;Controle de Estabilidade;Alarme;Ar Quente;Computador de Bordo;Direção Hidráulica;MP3 Player;Rodas de Liga Leve;Travas Elétricas;Volante com Regulagem;Encosto de Cabeça Traseiro;Farol de Neblina;Controle de Velocidade;Retrovisor Fotocrômico;Revisões em Concessionária;Aceita Troca";
			//se mexer aqui, tem que mexer no mesmo atributo em edit
			$itensA = explode(";", $possibilidades);
						
			if(isset($POST['itenss'])){
				foreach($POST['itenss'] as $chave=>$valor){
					
					if($itens == ""){
						$itens = $itensA[$chave];
					}else{
						$itens=$itens.";".$itensA[$chave];
					}
				}	
			}
			
			$cadastro->setItens($itens);				
			
						
			return $cadastro;
		}
		
		public function inserir(){
			$daoCadastro = new DAOCadastro();
			$retorno = $daoCadastro->inserir();
			header("Location: /crud/edit.php?id=".$retorno);
		}
		
		public function alterar($cadastro){
			$daoCadastro = new DAOCadastro();
			$daoCadastro->alterar($cadastro);
			header("Location: /crud/index.php");
		}			
		
		public function deletar($id){
			$daoCadastro = new DAOCadastro();
			$daoCadastro->deletar($id);
			header("Location: /crud/index.php");
		}	
					
}