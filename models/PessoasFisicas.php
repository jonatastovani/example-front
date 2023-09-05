<?php

class PessoasFisicas {
	
	private $id;
	private $cpf;
	private $data_nasc;
	private $logradouro;
	private $numero;
	private $complemento;
	private $bairro;
	private $cep;
	private $cidade;
	private $uf;
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
	
	public function setCpf($cpf):void {
		$this->cpf = $cpf;
	}
	
	public function getCpf():string {
		return $this->cpf;		
	}
	
	public function setDatanasc($data_nasc):void {
		$this->data_nasc = $data_nasc;
	}
	
	public function getDatanasc():DateTimeInterface {
		return $this->data_nasc;
	}
	
	public function setLogradouro($logradouro):void {
		$this->logradouro = $logradouro;		
	}
	
	public function getLogradouro():string {
		return $this->logradouro;		
	}	
	
	public function setNumero($numero):void {
		$this->numero = $numero;		
	}
	
	public function getNumero():string {
		return $this->numero;		
	}	
	
	public function setComplemento($complemento):void {
		$this->complemento = $complemento;		
	}
	
	public function getComplemento():string {
		return $this->complemento;		
	}	
	
	public function setBairro($bairro):void {
		$this->bairro = $bairro;		
	}
	
	public function getBairro():string {
		return $this->bairro;		
	}	
	
	public function setCep($cep):void {
		$this->cep = $cep;		
	}
	
	public function getCep():string {
		return $this->cep;		
	}	
	
	public function setCidade($cidade):void {
		$this->cidade = $cidade;		
	}
	
	public function getCidade():string {
		return $this->cidade;		
	}	
	
	public function setUf($uf):void {
		$this->uf = $uf;		
	}
	
	public function getUf():string {
		return $this->uf;		
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