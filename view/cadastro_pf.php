<!DOCTYPE html>
	<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Test</title>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

	</head>
	
	<body>

		<div class="container">

			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="#">CertSimples</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item active">
							<a class="nav-link" href="..\index.php">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link disabled" href="#">Pessoa Física</a>
						</li>
					</ul>
				</div>
			</nav>

			<div class="table-responsive">

				<table class="table">
					<thead>
						<tr><th colspan=7 style="text-align:center;"><h4>Cadastro de Pessoa Física</h4></th></tr>
						<tr style="text-align:center;">
							<th>CPF</th>
							<th>Data Nasc.</th>
							<th>Email</th>
							<th colspan=2>Ação</th>
						</tr>
					</thead>
					<tbody>		
					</tbody>
				</table>

			</div>

			<form class="row g-3" name="form1" id="form1" method="post">
				<div class="col-md-2">
					<label for="cpf" class="form-label">CPF:</label>
					<input type="text" class="form-control" name="cpf" id="cpf" required autofocus>
				</div>
				<div class="col-md-4">
					<label for="data_nasc" class="form-label">Data de Nascimento:</label>
					<input type="date" class="form-control" name="data_nasc" id="data_nasc" required>
				</div>
				<div class="col-md-2">
					<label for="cep" class="form-label">CEP:</label>
					<input type="text" class="form-control" name="cep" id="cep" required>
				</div>
				<div class="col-md-4">
				</div>
				<div class="col-md-7">
					<label for="logradouro" class="form-label">Logradouro:</label>
					<input type="text" class="form-control grupoCEP" name="logradouro" id="logradouro" maxlength="255" required>
				</div>
				<div class="col-md-2">
					<label for="numero" class="form-label">Número:</label>
					<input type="text" class="form-control" name="numero" id="numero" maxlength="6" required>
				</div>
				<div class="col-md-3">
					<label for="complemento" class="form-label">Complemento:</label>
					<input type="text" class="form-control" name="complemento" id="complemento" maxlength="20">
				</div>
				<div class="col-md-4">
					<label for="bairro" class="form-label">Bairro:</label>
					<input type="text" class="form-control grupoCEP" name="bairro" id="bairro" maxlength="100" required>
				</div>
				<div class="col-6">
					<label for="cidade" class="form-label">Cidade:</label>
					<input type="text" class="form-control grupoCEP" name="cidade" id="cidade" maxlength="100" required>
				</div>
				<div class="col-md-2">
					<label for="uf" class="form-label">UF:</label>
					<input type="text" class="form-control grupoCEP" name="uf" id="uf" required>
				</div>
				<div class="col-md-4">
					<label for="email" class="form-label">Email:</label>
					<input type="email" class="form-control" name="email" maxlength="100" id="email" required>
				</div>
				<div class="col-md-4">
					<label for="senha" class="form-label">Senha:</label>
					<input type="password" class="form-control grupo-senha" name="senha" maxlength="255" id="senha" required>
				</div>
				<div class="col-md-4">
				</div>
				<div class="col-4">
				</div>
				<div class="col-2">
					<div class="form-check">
						<input class="form-check-input grupo-senha" type="checkbox" name="ckb_mostrar" id="ckb_mostrar">
						<label class="form-check-label" for="ckb_mostrar">
							Mostrar senha
						</label>
					</div>
				</div>
				<div class="col-2" id="div-ckbsenha" hidden="false">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="ckb_alt_senha" id="ckb_alt_senha">
						<label class="form-check-label" for="ckb_alt_senha">
							Alterar senha
						</label>
					</div>
				</div>

				<input type="hidden" name="id_pessoaFisica" id="id_pessoaFisica">
				<input type="hidden" name="action" id="action" value="insert">
				<div class="col-12">
					<hr>
				</div>

				<div class="col-12">
					<h5>Informe com quais finalidades você usará a Certsimples?</h5>
				</div>
			
				<div class="col-12">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="ckb_prev_fra" id="ckb_prev_fra">
						<label class="form-check-label" for="ckb_prev_fra">
							Prevenção de fraudes.
						</label>
					</div>
				</div>
				<div class="col-12">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="ckb_val_dados" id="ckb_val_dados">
						<label class="form-check-label" for="ckb_val_dados">
							Validação de dados de documentos apresentados.
						</label>
					</div>
				</div>
				<div class="col-12">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="ckb_cump_obri" id="ckb_cump_obri">
						<label class="form-check-label" for="ckb_cump_obri">
							Cumprimento de obrigações legais ou regulatórias.
						</label>
					</div>
				</div>
				<div class="col-12">
					<p>Para outras finalidades, contate-nos em contato@certsimples.com.br.</p>
				</div>
				<div class="col-12">
					<hr>
				</div>

				<div class="col-12">
					<h5>Você aceita os termos da Certsimples?</h5>
				</div>
				<div class="col-12">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="ckb_termo" id="ckb_termo">
						<label class="form-check-label" for="ckb_termo">
							Li e aceito os Termos Gerais da Certsimples.
						</label>
					</div>
				</div>
				<div class="col-12">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="ckb_lgpd" id="ckb_lgpd">
						<label class="form-check-label" for="ckb_lgpd">
							Li e aceito as Políticas de Privacidade e de Proteção de Dados Pessoais da Certsimples.
						</label>
					</div>
				</div>
				<div class="col-12">
					<hr>
				</div>
				<div class="col-2">
					<input id="save" class="btn btn-primary" type="submit" value="Nova Pessoa Física" title="Confirmar e enviar os dados do cadastro">
				</div>
				<div class="col-2">
					<input id="cancel" class="btn btn-primary" type="reset" value="Cancelar" title="Cancelar e limpar formulário de cadastro">
				</div>
			</form>

		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js"></script>

		<script src="../js/cadastro_pf.js"></script>
		<script src="../js/buscaCEP.js"></script>
		<script src="../js/common_functions.js"></script>

	</body>
</html>