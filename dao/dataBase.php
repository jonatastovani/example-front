<?php

require_once ( "../models/Juridicos.php" );
require_once ( "../models/PessoasFisicas.php" );
require_once ( "../models/Email.php" );

class dataBase {
	
	private $host;
	private $user;
	private $pass;
	private $bd;
	private $con;	

	private $table;

	public function __construct( 	string $host, 
									string $user, 
									string $password, 
									string $dbname ) {
	
		$this->host = $host;
		$this->user = $user;
		$this->pass = $password;
		$this->bd = $dbname;		
		
	}	
	
	public function getConn() {
		return $this->con = mysqli_connect($this->host, $this->user, $this->pass, $this->bd);
	}
	
	public function getUnicoCadastroByJuridico(int $id=null, string $cnpj, string $cpf, string $email):int{
		$con = $this->getConn();

		$and_id = null;
		
		if ($id!=null) {
			$id = preg_replace('/\D/', '', $id);

			if ($id) {
				$escapeId = mysqli_real_escape_string($con, $id);
				$and_id = " and id != $escapeId ";
			}
		}
		
		$escapeCnpj = mysqli_real_escape_string($con, $cnpj);
		$escapeCpf = mysqli_real_escape_string($con, $cpf);
		$escapeEmail = mysqli_real_escape_string($con, $email);

		$query = "select id from juridicos where (cnpj='$escapeCnpj' or cpf_resp='$escapeCpf' or email='$escapeEmail') $and_id ";

		$res = mysqli_query($con,$query);
		$rows = mysqli_num_rows($res);
		return $rows;
	}

	public function insertJuridicos( Juridicos $Juridicos ):array{
		
		$con = $this->getConn();		
		
		if ($this->getUnicoCadastroByJuridico(null,$Juridicos->getCnpj(),$Juridicos->getCpfresp(),$Juridicos->getEmail())==0) {
			
			$Juridicos->setDatacadastro(new DateTime());				

			$escapeCnpj = mysqli_real_escape_string($con, $Juridicos->getCnpj());
			$escapeCpfresp = mysqli_real_escape_string($con, $Juridicos->getCpfresp());
			$escapeDataNasc = $Juridicos->getDatanasc()->format("Y-m-d");
			$escapeEmail = mysqli_real_escape_string($con, $Juridicos->getEmail());
			$escapeSenha = mysqli_real_escape_string($con, $Juridicos->getSenha());
			$escapeChecks = mysqli_real_escape_string($con, $Juridicos->getChecks());
			$escapeDataCadastro = $Juridicos->getDatacadastro()->format( "Y-m-d H:i:s" );

			$query = "insert into juridicos (cnpj,cpf_resp,data_nasc,email,senha,checks,data_cadastro) values (
				'$escapeCnpj',
				'$escapeCpfresp',
				'$escapeDataNasc',
				'$escapeEmail',
				'$escapeSenha',
				'$escapeChecks',
				'$escapeDataCadastro')";

			if (mysqli_query($con,$query)) {
				$data[] = array(
					'success' => '1'
				);
			}
			else {
				$data[] = array(
					'success' => '0'
				);
			}
		}else{
			$data[] = array(
				'success' => '2'
			);		
		}		
		
		
		return $data;
	}	

	public function alterJuridico( Juridicos $Juridicos ):array{		

		$con = $this->getConn();		

		if ($this->getUnicoCadastroByJuridico($Juridicos->getId(),$Juridicos->getCnpj(),$Juridicos->getCpfresp(),$Juridicos->getEmail())==0) {

			$strSenha = "";
			if ($Juridicos->getSenha()!=='null') {
				$escapeSenha = mysqli_real_escape_string($con, $Juridicos->getSenha());
				$strSenha = "senha='$escapeSenha', ";
			}

			$DT = new DateTime();				
			
			$escapeCnpj = mysqli_real_escape_string($con, $Juridicos->getCnpj());
			$escapeCpfresp = mysqli_real_escape_string($con, $Juridicos->getCpfresp());
			$escapeDataNasc = $Juridicos->getDatanasc()->format("Y-m-d");
			$escapeEmail = mysqli_real_escape_string($con, $Juridicos->getEmail());
			$escapeChecks = mysqli_real_escape_string($con, $Juridicos->getChecks());
			$escapeDataAtualizado = $DT->format( "Y-m-d H:i:s" );
			$escapeId = mysqli_real_escape_string($con, $Juridicos->getId());

			$query = "update juridicos set 
			cnpj='$escapeCnpj',
			cpf_resp='$escapeCpfresp',
			data_nasc='$escapeDataNasc',
			email='$escapeEmail',
			$strSenha
			checks='$escapeChecks',
			data_atualizado='$escapeDataAtualizado'
			
			where id=$escapeId";

			if (mysqli_query($con,$query)) {
				$data[] = array(
					'success' => '1'
				);
			}
			else {
				$data[] = array(
					'success' => '0'
				);
			}
		}else{
			$data[] = array(
				'success' => '2'
			);		
		}		
	
		
		return $data;
		
	}

	public function deleteJuridico( Juridicos $Juridicos ):array{
		
		$con = $this->getConn();			
		$escapeId = mysqli_real_escape_string($con, $Juridicos->getId());

		$query = "delete from juridicos where id=$escapeId";

		if (mysqli_query($con,$query)) {
			$data[] = array(
				'success' => '1'
			);
		}
		else {
			$data[] = array(
				'success' => '0'
			);
		}
		return $data;

	}

	public function getJuridicos():array{
		
		$con = $this->getConn();	
		
		$Juridicos = array();		
		$query = "select * from juridicos";
		$res = mysqli_query($con,$query);		
		
		while($row=mysqli_fetch_assoc($res)) 
		{
			$Juridicos[] = $row;
		}		
		
		return $Juridicos;		
	}

	public function Juridico_one( Juridicos $Juridicos ):array {

		$con = $this->getConn();
		
		$escapeId = mysqli_real_escape_string($con, $Juridicos->getId());
		
		$query = "select * from juridicos where id=$escapeId";

		$res = mysqli_query($con,$query);
		
		$juridicos = array();
		
		if (mysqli_query($con,$query)) {
			while($row=mysqli_fetch_assoc($res)) 
			{
				$juridicos['cnpj'] = $row['cnpj'];
				$juridicos['cpf_resp'] = $row['cpf_resp'];
				$juridicos['data_nasc'] = $row['data_nasc'];
				$juridicos['email'] = $row['email'];				
				$juridicos['checks'] = $row['checks'];				
			}		
			
			return $juridicos;		
		}
	}

	public function cnpjJuridico_one( Juridicos $Juridicos ):array {

		$con = $this->getConn();
		
		$escapeCnpj = mysqli_real_escape_string($con, $Juridicos->getCnpj());
		
		$query = "select * from juridicos where cnpj='$escapeCnpj'";

		$res = mysqli_query($con,$query);
		
		$juridicos = array();
		
		if (mysqli_query($con,$query)) {
			while($row=mysqli_fetch_assoc($res)) 
			{
				$juridicos['id'] = $row['id'];
				$juridicos['cnpj'] = $row['cnpj'];
				$juridicos['cpf_resp'] = $row['cpf_resp'];
				$juridicos['data_nasc'] = $row['data_nasc'];
				$juridicos['email'] = $row['email'];				
				$juridicos['checks'] = $row['checks'];				
			}		
			
			return $juridicos;		
		}
	}

	public function cpfJuridico_one( Juridicos $Juridicos ):array {

		$con = $this->getConn();
		
		$escapeCpfresp = mysqli_real_escape_string($con, $Juridicos->getCpfresp());
		
		$query = "select * from juridicos where cpf_resp='$escapeCpfresp'";

		$res = mysqli_query($con,$query);
		
		$juridicos = array();
		
		if (mysqli_query($con,$query)) {
			while($row=mysqli_fetch_assoc($res)) 
			{
				$juridicos['id'] = $row['id'];
				$juridicos['cnpj'] = $row['cnpj'];
				$juridicos['cpf_resp'] = $row['cpf_resp'];
				$juridicos['data_nasc'] = $row['data_nasc'];
				$juridicos['email'] = $row['email'];				
				$juridicos['checks'] = $row['checks'];				
			}		
			
			return $juridicos;		
		}
	}

	public function emailJuridico_one( Juridicos $Juridicos ):array {

		$con = $this->getConn();
		
		$escapeEmail = mysqli_real_escape_string($con, $Juridicos->getEmail());
		
		$query = "select * from juridicos where email='$escapeEmail'";

		$res = mysqli_query($con,$query);
		
		$juridicos = array();
		
		if (mysqli_query($con,$query)) {
			while($row=mysqli_fetch_assoc($res)) 
			{
				$juridicos['id'] = $row['id'];
				$juridicos['cnpj'] = $row['cnpj'];
				$juridicos['cpf_resp'] = $row['cpf_resp'];
				$juridicos['data_nasc'] = $row['data_nasc'];
				$juridicos['email'] = $row['email'];				
				$juridicos['checks'] = $row['checks'];				
			}		
			
			return $juridicos;		
		}
	}

	/********************************************************* */

	public function getUnicoCadastroByPessoaFisica(int $id=null, string $cpf, string $email):int{
		$con = $this->getConn();

		$and_id = null;
		
		if ($id!=null) {
			$id = preg_replace('/\D/', '', $id);

			if ($id){
				$escapeId = mysqli_real_escape_string($con, $id);
				$and_id = " and id != $escapeId ";
			}
		}
		
		$escapeCpf = mysqli_real_escape_string($con, $cpf);
		$escapeEmail = mysqli_real_escape_string($con, $email);
		
		$query = "select id from pessoas_fisicas where (cpf='$escapeCpf' or email='$escapeEmail') $and_id ";
		
		$res = mysqli_query($con,$query);
		$rows = mysqli_num_rows($res);
		return $rows;
	}

	public function insertPessoasFisicas( PessoasFisicas $PessoasFisicas ):array{
		
		$con = $this->getConn();		
		
		if ($this->getUnicoCadastroByPessoaFisica(null,$PessoasFisicas->getCpf(),$PessoasFisicas->getEmail())==0) {
			
			$PessoasFisicas->setDatacadastro(new DateTime());				

			$escapeCpf = mysqli_real_escape_string($con, $PessoasFisicas->getCpf());
			$escapeDataNasc = $PessoasFisicas->getDatanasc()->format("Y-m-d");
			$escapeLogradouro = mysqli_real_escape_string($con, $PessoasFisicas->getLogradouro());
			$escapeNumero = mysqli_real_escape_string($con, $PessoasFisicas->getNumero());
			$escapeComplemento = mysqli_real_escape_string($con, $PessoasFisicas->getComplemento());
			$escapeBairro = mysqli_real_escape_string($con, $PessoasFisicas->getBairro());
			$escapeCep = mysqli_real_escape_string($con, $PessoasFisicas->getCep());
			$escapeCidade = mysqli_real_escape_string($con, $PessoasFisicas->getCidade());
			$escapeUf = mysqli_real_escape_string($con, $PessoasFisicas->getUf());
			$escapeEmail = mysqli_real_escape_string($con, $PessoasFisicas->getEmail());
			$escapeSenha = mysqli_real_escape_string($con, $PessoasFisicas->getSenha());
			$escapeChecks = mysqli_real_escape_string($con, $PessoasFisicas->getChecks());
			$escapeDataCadastro = $PessoasFisicas->getDatacadastro()->format("Y-m-d H:i:s");

			$query = "INSERT INTO pessoas_fisicas (cpf,data_nasc,logradouro,numero,complemento,bairro,cep,cidade,uf,email,senha,checks,data_cadastro) VALUES (
				'$escapeCpf',
				'$escapeDataNasc',
				'$escapeLogradouro',
				'$escapeNumero',
				'$escapeComplemento',
				'$escapeBairro',
				'$escapeCep',
				'$escapeCidade',
				'$escapeUf',
				'$escapeEmail',
				'$escapeSenha',
				'$escapeChecks',
				'$escapeDataCadastro')";

			if (mysqli_query($con,$query)) {
				$data[] = array(
					'success' => '1'
				);
			}
			else {
				$data[] = array(
					'success' => '0'
				);
			}
		}else{
			$data[] = array(
				'success' => '2'
			);		
		}		
		
		
		return $data;
	}	

	public function alterPessoaFisica( PessoasFisicas $PessoasFisicas ):array{		

		$con = $this->getConn();		

		if ($this->getUnicoCadastroByPessoaFisica($PessoasFisicas->getId(),$PessoasFisicas->getCpf(),$PessoasFisicas->getEmail())==0) {

			$strSenha = "";
			if ($PessoasFisicas->getSenha()!=='null') {
				$strSenha = "senha='".$PessoasFisicas->getSenha()."', ";
			}

			$DT = new DateTime();				

			$escapeId = mysqli_real_escape_string($con, $PessoasFisicas->getId());
			$escapeCpf = mysqli_real_escape_string($con, $PessoasFisicas->getCpf());
			$escapeDataNasc = $PessoasFisicas->getDatanasc()->format("Y-m-d");
			$escapeLogradouro = mysqli_real_escape_string($con, $PessoasFisicas->getLogradouro());
			$escapeNumero = mysqli_real_escape_string($con, $PessoasFisicas->getNumero());
			$escapeComplemento = mysqli_real_escape_string($con, $PessoasFisicas->getComplemento());
			$escapeBairro = mysqli_real_escape_string($con, $PessoasFisicas->getBairro());
			$escapeCep = mysqli_real_escape_string($con, $PessoasFisicas->getCep());
			$escapeCidade = mysqli_real_escape_string($con, $PessoasFisicas->getCidade());
			$escapeUf = mysqli_real_escape_string($con, $PessoasFisicas->getUf());
			$escapeEmail = mysqli_real_escape_string($con, $PessoasFisicas->getEmail());
			$escapeChecks = mysqli_real_escape_string($con, $PessoasFisicas->getChecks());
			$escapeDataAtualizado = $DT->format("Y-m-d H:i:s");

			$query = "UPDATE pessoas_fisicas SET 
				cpf='$escapeCpf',
				data_nasc='$escapeDataNasc',
				logradouro='$escapeLogradouro',
				numero='$escapeNumero',
				complemento='$escapeComplemento',
				bairro='$escapeBairro',
				cep='$escapeCep',
				cidade='$escapeCidade',
				uf='$escapeUf',
				email='$escapeEmail',
				$strSenha
				checks='$escapeChecks',
				data_atualizado='$escapeDataAtualizado'
				WHERE id=$escapeId";

			if (mysqli_query($con,$query)) {
				$data[] = array(
					'success' => '1'
				);
			}
			else {
				$data[] = array(
					'success' => '0'
				);
			}
		}else{
			$data[] = array(
				'success' => '2'
			);		
		}		
	
		
		return $data;
		
	}

	public function deletePessoaFisica( PessoasFisicas $PessoasFisicas ):array{
		
		$con = $this->getConn();			
		$escapeId = mysqli_real_escape_string($con, $PessoasFisicas->getId());

		$query = "delete from pessoas_fisicas where id=$escapeId";

		if (mysqli_query($con,$query)) {
			$data[] = array(
				'success' => '1'
			);
		}
		else {
			$data[] = array(
				'success' => '0'
			);
		}
		return $data;

	}

	public function getPessoasFisicas():array{
		
		$con = $this->getConn();	
		
		$PessoasFisicas = array();		
		$query = "select * from pessoas_fisicas";
		$res = mysqli_query($con,$query);		
		
		while($row=mysqli_fetch_assoc($res)) 
		{
			$PessoasFisicas[] = $row;
		}		
		
		return $PessoasFisicas;		
	}

	public function PessoaFisica_one( PessoasFisicas $PessoasFisicas ):array {

		$con = $this->getConn();
		
		$escapeId = mysqli_real_escape_string($con, $PessoasFisicas->getId());

		$query = "select * from pessoas_fisicas where id=$escapeId";

		$res = mysqli_query($con,$query);
		
		$pessoasFisicas = array();
		
		if (mysqli_query($con,$query)) {
			while($row=mysqli_fetch_assoc($res)) 
			{
				$pessoasFisicas['id'] = $row['id'];
				$pessoasFisicas['cpf'] = $row['cpf'];
				$pessoasFisicas['data_nasc'] = $row['data_nasc'];
				$pessoasFisicas['logradouro'] = $row['logradouro'];
				$pessoasFisicas['numero'] = $row['numero'];
				$pessoasFisicas['complemento'] = $row['complemento'];
				$pessoasFisicas['bairro'] = $row['bairro'];
				$pessoasFisicas['cep'] = $row['cep'];
				$pessoasFisicas['cidade'] = $row['cidade'];
				$pessoasFisicas['uf'] = $row['uf'];
				$pessoasFisicas['email'] = $row['email'];				
				$pessoasFisicas['checks'] = $row['checks'];				
			}		
			
			return $pessoasFisicas;		
		}
	}

	public function cpfPessoaFisica_one( PessoasFisicas $PessoasFisicas ):array {

		$con = $this->getConn();
		
		$escapeCpf = mysqli_real_escape_string($con, $PessoasFisicas->getCpf());
		
		$query = "select * from pessoas_fisicas where cpf='$escapeCpf'";

		$res = mysqli_query($con,$query);
		
		$pessoasFisicas = array();
		
		if (mysqli_query($con,$query)) {
			while($row=mysqli_fetch_assoc($res)) 
			{
				$pessoasFisicas['id'] = $row['id'];
				$pessoasFisicas['cpf'] = $row['cpf'];
				$pessoasFisicas['data_nasc'] = $row['data_nasc'];
				$pessoasFisicas['logradouro'] = $row['logradouro'];
				$pessoasFisicas['numero'] = $row['numero'];
				$pessoasFisicas['complemento'] = $row['complemento'];
				$pessoasFisicas['bairro'] = $row['bairro'];
				$pessoasFisicas['cep'] = $row['cep'];
				$pessoasFisicas['cidade'] = $row['cidade'];
				$pessoasFisicas['uf'] = $row['uf'];
				$pessoasFisicas['email'] = $row['email'];				
				$pessoasFisicas['checks'] = $row['checks'];				
			}		
			
			return $pessoasFisicas;		
		}
	}

	public function emailPessoaFisica_one( PessoasFisicas $PessoasFisicas ):array {

		$con = $this->getConn();
		
		$escapeEmail = mysqli_real_escape_string($con, $PessoasFisicas->getEmail());

		$query = "select * from pessoas_fisicas where email='$escapeEmail'";

		$res = mysqli_query($con,$query);
		
		$pessoasFisicas = array();
		
		if (mysqli_query($con,$query)) {
			while($row=mysqli_fetch_assoc($res)) 
			{
				$pessoasFisicas['id'] = $row['id'];
				$pessoasFisicas['cpf'] = $row['cpf'];
				$pessoasFisicas['data_nasc'] = $row['data_nasc'];
				$pessoasFisicas['logradouro'] = $row['logradouro'];
				$pessoasFisicas['numero'] = $row['numero'];
				$pessoasFisicas['complemento'] = $row['complemento'];
				$pessoasFisicas['bairro'] = $row['bairro'];
				$pessoasFisicas['cep'] = $row['cep'];
				$pessoasFisicas['cidade'] = $row['cidade'];
				$pessoasFisicas['uf'] = $row['uf'];
				$pessoasFisicas['email'] = $row['email'];				
				$pessoasFisicas['checks'] = $row['checks'];				
			}		
			
			return $pessoasFisicas;		
		}
	}


	public function sendEmail( Email $Email ):array{

		$email = $Email->getemail();
		$date = $Email->getDate();
		$subject = $Email->getSubject();
		$total = $Email->getTotal();
		$body = " Day: $date - Total Sales: $total ";
		
		if ($Email->send( $email, $subject, $body )) {
			$data[] = array(
				'success' => '1'
			);
		}
		else {
			$data[] = array(
				'success' => '0'
			);
		}
				
		return $data;
	}	
	
}