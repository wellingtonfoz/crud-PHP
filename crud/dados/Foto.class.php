<?php

class Foto{
	
	private $id;
	private $fotoPath;
	private $principal;
	
	
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getFotoPath(){
		return $this->fotoPath;
	}

	public function setFotoPath($fotoPath){
		$this->fotoPath = $fotoPath;
	}

	public function getPrincipal(){
		return $this->principal;
	}

	public function setPrincipal($principal){
		$this->principal = $principal;
	}	

}