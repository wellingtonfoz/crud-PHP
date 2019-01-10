<?php

class Cadastro{
	private $id;
	private $titulo;
	private $valor;
	private $descricao;
	private $complementar;
	private $ano;
	private $cor;
	private $combustivel;
	private $km;
	private $transmissao;
	private $placa;
	private $itens;
	private $desativar;
	
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getTitulo(){
		return $this->titulo;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}

	public function getValor(){
		return $this->valor;
	}

	public function setValor($valor){
		$this->valor = $valor;
	}

	public function getDescricao(){
		return $this->descricao;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}

	public function getComplementar(){
		return $this->complementar;
	}

	public function setComplementar($complementar){
		$this->complementar = $complementar;
	}

	public function getAno(){
		return $this->ano;
	}

	public function setAno($ano){
		$this->ano = $ano;
	}

	public function getCor(){
		return $this->cor;
	}

	public function setCor($cor){
		$this->cor = $cor;
	}

	public function getCombustivel(){
		return $this->combustivel;
	}

	public function setCombustivel($combustivel){
		$this->combustivel = $combustivel;
	}

	public function getKm(){
		return $this->km;
	}

	public function setKm($km){
		$this->km = $km;
	}

	public function getTransmissao(){
		return $this->transmissao;
	}

	public function setTransmissao($transmissao){
		$this->transmissao = $transmissao;
	}

	public function getPlaca(){
		return $this->placa;
	}

	public function setPlaca($placa){
		$this->placa = $placa;
	}

	public function getItens(){
		return $this->itens;
	}

	public function setItens($itens){
		$this->itens = $itens;
	}

	public function getDesativar(){
		return $this->desativar;
	}

	public function setDesativar($desativar){
		$this->desativar = $desativar;
	}	

}