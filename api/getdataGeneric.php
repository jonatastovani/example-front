<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once ( "../env.php" );
require_once ( "../dao/dataBase.php" ) ;

require_once ( "../models/Juridicos.php" );
require_once ( "../models/PessoasFisicas.php" );
require_once ( "../models/Email.php" );

$data = new DataBase( $host, $user, $password, $dbname );

$Juridicos = new Juridicos();
$PessoasFisicas = new PessoasFisicas();
$Email = new Email();

if ($_GET['action'] === "get_all") {
	$res = $data->getJuridicos();
}

if ($_GET['action'] === "insert") {
	
	$cnpj = $Juridicos->setCnpj(preg_replace('/\D/', '', $_POST['cnpj']));
	$cpf_resp = $Juridicos->setCpfresp(preg_replace('/\D/', '', $_POST['cpf_resp']));
	$data_nasc = $Juridicos->setDatanasc(new DateTime($_POST['data_nasc']));
	$email = $Juridicos->setEmail($_POST['email']);
	$senha = $Juridicos->setSenha($_POST['senha']);
	$checks = $Juridicos->setChecks($_POST['checks']);

	$res = $data->insertJuridicos( $Juridicos );
}

if ($_GET['action'] === "juridico_one") {	
	
	$id_juridico = $Juridicos->setId($_GET["id"]);	
	$res = $data->juridico_one( $Juridicos );

}

if ($_GET['action'] === "update") {	

	$cnpj = $Juridicos->setCnpj(preg_replace('/\D/', '', $_POST['cnpj']));
	$cpf_resp = $Juridicos->setCpfresp(preg_replace('/\D/', '', $_POST['cpf_resp']));
	$data_nasc = $Juridicos->setDatanasc(new DateTime($_POST['data_nasc']));
	$email = $Juridicos->setEmail($_POST['email']);
	$senha = $Juridicos->setSenha($_POST['senha']);
	$checks = $Juridicos->setChecks($_POST['checks']);

	$id = $Juridicos->setId($_POST['id']);

	$res = $data->alterjuridico( $Juridicos );
}

if ($_GET['action'] === "delete") {
	
	$id_juridico = $Juridicos->setId($_GET["id"]);

	$res = $data->deleteJuridico( $Juridicos );
}

if ($_GET['action'] === "cnpjJuridico_one") {	
	
	$cnpj = $Juridicos->setCnpj(preg_replace('/\D/', '', $_GET['cnpj']));	
	$res = $data->cnpjJuridico_one( $Juridicos );

}

if ($_GET['action'] === "cpfJuridico_one") {	
	
	$cpf_resp = $Juridicos->setCpfresp(preg_replace('/\D/', '', $_GET['cpf_resp']));	
	$res = $data->cpfJuridico_one( $Juridicos );

}

if ($_GET['action'] === "emailJuridico_one") {	
	
	$email = $Juridicos->setEmail($_GET["email"]);	
	$res = $data->emailJuridico_one( $Juridicos );

}

/************************************* Pessoa Física */

if ($_GET['action'] === "get_all_pessoaFisica") {
	$res = $data->getPessoasFisicas();
}

if ($_GET['action'] === "insert_pessoaFisica") {

	$cpf = $PessoasFisicas->setCpf(preg_replace('/\D/', '', $_POST['cpf']));
	$data_nasc = $PessoasFisicas->setDatanasc(new DateTime($_POST['data_nasc']));
	$logradouro = $PessoasFisicas->setLogradouro($_POST['logradouro']);
	$numero = $PessoasFisicas->setNumero($_POST['numero']);
	$complemento = $PessoasFisicas->setComplemento($_POST['complemento']);
	$bairro = $PessoasFisicas->setBairro($_POST['bairro']);
	$cep = $PessoasFisicas->setCep(preg_replace('/\D/', '', $_POST['cep']));
	$cidade = $PessoasFisicas->setCidade($_POST['cidade']);
	$uf = $PessoasFisicas->setUf($_POST['uf']);
	$email = $PessoasFisicas->setEmail($_POST['email']);
	$senha = $PessoasFisicas->setSenha($_POST['senha']);
	$checks = $PessoasFisicas->setChecks($_POST['checks']);

	$res = $data->insertPessoasFisicas( $PessoasFisicas );
}

if ($_GET['action'] === "pessoaFisica_one") {	
	
	$id_juridico = $PessoasFisicas->setId($_GET["id"]);	
	$res = $data->PessoaFisica_one( $PessoasFisicas );

}

if ($_GET['action'] === "update_pessoaFisica") {	

	$cpf = $PessoasFisicas->setCpf(preg_replace('/\D/', '', $_POST['cpf']));
	$data_nasc = $PessoasFisicas->setDatanasc(new DateTime($_POST['data_nasc']));
	$logradouro = $PessoasFisicas->setLogradouro($_POST['logradouro']);
	$numero = $PessoasFisicas->setNumero($_POST['numero']);
	$complemento = $PessoasFisicas->setComplemento($_POST['complemento']);
	$bairro = $PessoasFisicas->setBairro($_POST['bairro']);
	$cep = $PessoasFisicas->setCep(preg_replace('/\D/', '', $_POST['cep']));
	$cidade = $PessoasFisicas->setCidade($_POST['cidade']);
	$uf = $PessoasFisicas->setUf($_POST['uf']);
	$email = $PessoasFisicas->setEmail($_POST['email']);
	$senha = $PessoasFisicas->setSenha($_POST['senha']);
	$checks = $PessoasFisicas->setChecks($_POST['checks']);

	$id = $PessoasFisicas->setId($_POST['id']);

	$res = $data->alterPessoaFisica( $PessoasFisicas );
}

if ($_GET['action'] === "delete_pessoaFisica") {
	
	$id_pessoaFisica = $PessoasFisicas->setId($_GET["id"]);

	$res = $data->deletePessoaFisica( $PessoasFisicas );
}

if ($_GET['action'] === "cpfPessoaFisica_one") {	
	
	$cpf_resp = $PessoasFisicas->setCpf(preg_replace('/\D/', '', $_GET['cpf']));	
	$res = $data->cpfPessoaFisica_one( $PessoasFisicas );

}

if ($_GET['action'] === "emailPessoaFisica_one") {	
	
	$email = $PessoasFisicas->setEmail($_GET["email"]);	
	$res = $data->emailPessoaFisica_one( $PessoasFisicas );

}

if ($_GET['action'] === "sendEMail") {

	$email = $Email->setEmail($_POST['email']);
	$date = $Email->setDate($_POST['date']);
	$total = $Email->setTotal($_POST['total']);	
	$subject = $Email->setSubject("Daily Sales - Test Tray");	
	$res = $data->sendEmail( $Email );
}

echo json_encode($res);

