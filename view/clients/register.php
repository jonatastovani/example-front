<!DOCTYPE html>
	<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Test</title>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js"></script>

	</head>
	
	<body>

		<div class="container">

			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="#">Vidros</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item active">
							<a class="nav-link" href="..\index.php">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link disabled" href="#">Clientes</a>
						</li>
					</ul>
				</div>
			</nav>

			<div class="table-responsive">

				<table id="table-clients" class="table">
					<thead>
						<tr><th colspan=7 style="text-align:center;"><h4>Cadastro de Clientes</h4></th></tr>
						<tr style="text-align:center;">
							<th>Nome</th>
							<th>Telefone</th>
							<th>CEP</th>
							<th>Endereço</th>
							<th colspan=2>Ação</th>
						</tr>
					</thead>
					<tbody>		
					</tbody>
				</table>

			</div>

			<form name="form1" id="form1" method="post">
				<div class="row">
					<div class="col-lg-8">
						<label for="name" class="form-label">Nome:</label>
						<input type="text" class="form-control" id="name" required autofocus>
					</div>
					<div class="col-lg-2">
						<label for="tel" class="form-label">Telefone:</label>
						<input type="text" class="form-control clstelefone" id="tel">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2">
						<label for="zipcode" class="form-label">CEP:</label>
						<input type="text" class="form-control" id="zipcode">
					</div>
					<div class="col-lg-8">
						<label for="address" class="form-label">Logradouro:</label>
						<input type="text" class="form-control grupoCEP" id="address" maxlength="255">
					</div>
				</div>
				
				<div class="row mt-5">
					<div class="col-2">
						<input id="save" class="btn btn-primary" type="submit" value="Salvar Cadastro" title="Confirmar e enviar os dados do cadastro">
					</div>
					<div class="col-2">
						<input id="cancel" class="btn btn-primary" type="reset" value="Cancelar" title="Cancelar e limpar formulário de cadastro">
					</div>
				</div>
			</form>

		</div>

		<script src="../../js/commons/common_functions.js"></script>
		<script src="../../js/commons/buscaCEP.js"></script>
		<!-- <script type="module" src="../../js/commons/enumsAction.js"></script> -->
		<script src="../../js/clients/register.js"></script>

	</body>
</html>