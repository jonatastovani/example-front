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
		array_push($checks,isset($_POST['ckb_ana_cred'])?1:0);
		array_push($checks,isset($_POST['ckb_cump_obri'])?1:0);
		
		$checks = implode(";",$checks);
		
		$form_data = array(
			'cnpj' => $_POST['cnpj'],
			'cpf_resp' => $_POST['cpf_resp'],
			'data_nasc' => $_POST['data_nasc'],
			'email' => $_POST['email'],
			'senha' => md5(trim($_POST['senha'])),	
			'checks' => $checks	
		);

		// var_dump($form_data);

		$param = "?action=insert";

		echo saveController::add( $form_data, $param, $url_api );
	}
	
	
	if ($_POST["action"] === 'juridico_one')		
	{		
		
		$id = $_POST["id"];	
		$param = "?action=juridico_one&id=".$id."";		

		echo saveController::getOne( $id, $param, $url_api );		
		
	}
	
	if ($_POST["action"] === 'update') 
	{

		$checks = [];

		array_push($checks,isset($_POST['ckb_prev_fra'])?1:0);
		array_push($checks,isset($_POST['ckb_val_dados'])?1:0);
		array_push($checks,isset($_POST['ckb_ana_cred'])?1:0);
		array_push($checks,isset($_POST['ckb_cump_obri'])?1:0);
		
		$checks = implode(";",$checks);

		$form_data = array(
			'cnpj' => $_POST['cnpj'],
			'cpf_resp' => $_POST['cpf_resp'],
			'data_nasc' => $_POST['data_nasc'],
			'email' => $_POST['email'],	
			'senha' => isset($_POST['senha'])?md5(trim($_POST['senha'])):'null',	
			'checks' => $checks,

			'id' => $_POST['id_juridico']	
		);

		$param = "?action=update";				

		echo saveController::update( $form_data, $param, $url_api );
		
	}

	if ($_POST["action"] === 'delete')		
	{
		$id = $_POST["id"];
		$param = "?action=delete&id=".$id."";		
		
		echo saveController::delete( $id, $param, $url_api );

		// $client = curl_init($url);
		// curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		// $response = curl_exec($client);		
		// echo $response;	
		
	}		
	
	if ($_POST["action"] === 'cnpjJuridico_one')		
	{		
		
		$cnpj = $_POST["cnpj"];	
		$param = "?action=cnpjJuridico_one&cnpj=".$cnpj."";		

		echo saveController::getForValidation( $cnpj, $param, $url_api );		
		
	}
	
	if ($_POST["action"] === 'cpfJuridico_one')		
	{		
		
		$cpf_resp = $_POST["cpf_resp"];	
		$param = "?action=cpfJuridico_one&cpf_resp=".$cpf_resp."";		

		echo saveController::getForValidation( $cpf_resp, $param, $url_api );		
		
	}
	
	if ($_POST["action"] === 'emailJuridico_one')		
	{		
		
		$email = $_POST["email"];	
		$param = "?action=emailJuridico_one&email=".$email."";		

		echo saveController::getForValidation( $email, $param, $url_api );		
		
	}
	
}

?>