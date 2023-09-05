<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once ( "../env.php" );

require_once ( "../controllers/saveController.php" ); 

if (isset($_POST["action"]))
{
	if($_POST["action"] === 'insert')
	{
		$checks = [];

		array_push($checks,isset($_POST['ckb_prev_fra'])?1:0);
		array_push($checks,isset($_POST['ckb_val_dados'])?1:0);
		array_push($checks,isset($_POST['ckb_cump_obri'])?1:0);
		
		$checks = implode(";",$checks);
		
		$form_data = array(
			'cpf' => $_POST['cpf'],
			'data_nasc' => $_POST['data_nasc'],
			'logradouro' => $_POST['logradouro'],
			'numero' => $_POST['numero'],
			'complemento' => $_POST['complemento'],
			'bairro' => $_POST['bairro'],
			'cep' => $_POST['cep'],
			'cidade' => $_POST['cidade'],
			'uf' => $_POST['uf'],
			'email' => $_POST['email'],
			'senha' => md5(trim($_POST['senha'])),	
			'checks' => $checks	
		);

		$param = "?action=insert_pessoaFisica";

		echo saveController::add( $form_data, $param, $url_api );
	}
	
	
	if ($_POST["action"] === 'pessoaFisica_one')		
	{		
		
		$id = $_POST["id"];	
		$param = "?action=pessoaFisica_one&id=".$id."";		

		echo saveController::getOne( $id, $param, $url_api );		
		
	}
	
	if ($_POST["action"] === 'update') 
	{

		$checks = [];

		array_push($checks,isset($_POST['ckb_prev_fra'])?1:0);
		array_push($checks,isset($_POST['ckb_val_dados'])?1:0);
		array_push($checks,isset($_POST['ckb_cump_obri'])?1:0);
		
		$checks = implode(";",$checks);

		$form_data = array(
			'cpf' => $_POST['cpf'],
			'data_nasc' => $_POST['data_nasc'],
			'logradouro' => $_POST['logradouro'],
			'numero' => $_POST['numero'],
			'complemento' => $_POST['complemento'],
			'bairro' => $_POST['bairro'],
			'cep' => $_POST['cep'],
			'cep' => $_POST['cep'],
			'cidade' => $_POST['cidade'],
			'uf' => $_POST['uf'],
			'email' => $_POST['email'],	
			'senha' => isset($_POST['senha'])?md5(trim($_POST['senha'])):'null',	
			'checks' => $checks,

			'id' => $_POST['id_pessoaFisica']	
		);

		$param = "?action=update_pessoaFisica";				

		echo saveController::update( $form_data, $param, $url_api );
		
	}

	if ($_POST["action"] === 'delete')		
	{
		$id = $_POST["id"];
		$param = "?action=delete_pessoaFisica&id=".$id."";		
		
		echo saveController::delete( $id, $param, $url_api );

		// $client = curl_init($url);
		// curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		// $response = curl_exec($client);		
		// echo $response;	
		
	}		
	
	if ($_POST["action"] === 'cpfPessoaFisica_one')		
	{		
		
		$cpf = $_POST["cpf"];	
		$param = "?action=cpfPessoaFisica_one&cpf=".$cpf."";		

		echo saveController::getForValidation( $cpf, $param, $url_api );		
		
	}
	
	if ($_POST["action"] === 'emailPessoaFisica_one')		
	{		
		
		$email = $_POST["email"];	
		$param = "?action=emailPessoaFisica_one&email=".$email."";		

		echo saveController::getForValidation( $email, $param, $url_api );		
		
	}
	
}

?>