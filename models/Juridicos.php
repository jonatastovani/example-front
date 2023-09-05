<?php

class Juridicos {
	
	private $id;
	private $cnpj;
	private $cpf_resp;
	private $data_nasc;
	private $email;
	private $senha;
	private $checks;
	private $data_cadastro;	
	private $data_atualizado;	
	
	public function __contruct() 
	{
		
	}
	
	public function setId($id):void {		
		$this->id = $id;		
	}
	
	public function getId():int {		
		return $this->id;
	}
	
	public function setCnpj($cnpj):void {
		$this->cnpj = $cnpj;		
	}
	
	public function getCnpj():string {
		return $this->cnpj;		
	}	
	
	public function setCpfresp($cpf_resp):void {
		$this->cpf_resp = $cpf_resp;
	}
	
	public function getCpfresp():string {
		return $this->cpf_resp;		
	}
	
	public function setDatanasc($data_nasc):void {
		$this->data_nasc = $data_nasc;
	}
	
	public function getDatanasc():DateTimeInterface {
		return $this->data_nasc;
	}
	public function setEmail($email):void {
		$this->email = $email;
	}
	
	public function getEmail():string {
		return $this->email;		
	}
	
	public function setSenha($senha):void {
		$this->senha = $senha;
	}
	
	public function getSenha():string {
		return $this->senha;		
	}
	
	public function setChecks($checks):void {
		$this->checks = $checks;
	}
	
	public function getChecks():string {
		return $this->checks;		
	}
	
	public function setDatacadastro($data_cadastro):void {
		$this->data_cadastro = $data_cadastro;
	}
	
	public function getDatacadastro():DateTimeInterface {
		return $this->data_cadastro;		
	}
	
	public function setDataatualizado($data_atualizado):void {
		$this->data_atualizado = $data_atualizado;
	}
	
	public function getDataatualizado():DateTimeInterface {
		return $this->data_atualizado;		
	}

}