<?php

session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: index.php');
    exit(); 
}

require_once '../Model/Usuario.php';

$sql = new Usuario();

$aUsuarios = $sql->getAll();

$userAtual = $sql->find($_SESSION['email']);
// echo'<pre>'; print_r($userAtual); echo'</pre>'; exit;

?>

<?php include_once "header.php" ?>
    <!-- todo o header foi incluido, com as importações do projeto -->

    <link rel="stylesheet" href="">  <!-- cada arquivo tem seu style especifico -->
</head> <!-- fechando a tag header que foi iniciada no arquivo views/header -->

	<body>

		<nav class="navbar bg-body-tertiary">
			<div class="container-fluid">
				<!-- <form class="d-flex" role="search">
					<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success" type="submit">Search</button>
				</form> -->
				
				<a href="sair.php" class="btn btn-outline-danger">sair</a>
			</div>
		</nav>

		<br>

		<h1 class="text-center"> Bem Vindo <?=$userAtual[0]['nome']?> </h1>

		<div class="m-5">
			<table class="table table-hover" id="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Name</th>
						<th scope="col">Email</th>
						<th scope="col">Telephone</th>
						<th scope="col" style="width: 10%;">Date of birth</th>
						<th scope="col">City</th>
						<th scope="col">State</th>
						<th scope="col">Adress</th>
						<th scope="col" style="width: 10%;">Action</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach($aUsuarios as $user){ 

						$valida = ($user['id'] === $userAtual[0]['id']) ? "" : "disabled";
					?>
							<tr>
								<td> <?=$user['id']?> </td>
								<td> <?=$user['nome']?> </td>
								<td> <?=$user['email']?> </td>
								<td> <?=$user['telefone']?> </td>
								<td style="width: 10%;"> <?=$user['data_nasc']?> </td>
								<td> <?=$user['cidade']?> </td>
								<td> <?=$user['estado']?> </td>
								<td> <?=$user['endereco']?> </td>

								<td style="width: 10%;">   
									<form onsubmit="return false" style="display: inline;">
										<button  class='btn btn-sm btn-primary btn-edit' data-id="<?=$dados['id']?>" <?=$valida?>>
											<i style="color: white;" class="bi bi-pencil"></i>
										</button>
									</form>

									<form action="../ajax/delete.php" method="post" style="display: inline;">
										<input type="hidden" name="id" value="<?=$user['id']?>">
										<button class='btn btn-sm btn-danger btn-delete' data-id="<?=$dados['id']?>" <?=$valida?>>
											<i style="color: white;" class="bi bi-trash"></i>
										</button>
									</form>

								</td>

							</tr>
					<?php } ?>
				</tbody>

			</table>

			<!-- <button disabled class="btn btn-danger" onclick="imprimir()">imprimir pdf</button>
			<button disabled class="btn btn-success" onclick="window.location.href = 'sistema_excel.php'">gerar excel</button> -->
		</div>
	</body>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php include_once "footer.php" ?>

<script>

	new DataTable('#table');

    $(document).ready(function() {

		$('.btn-edit').click(function () {

			var id = $(this).data('id');

			$.ajax({
				type: 'POST',
				url: 'ajax/ajax-lista-alunos-nivel-modalidade.php',
				data:{
					ano: ano,
					ure: ure,
					use: use,
					municipio: municipio,
					escola: escola,
					nivel: nivel,
					modalidade: modalidade,
					composicao: composicao,
					turno: turno
				},
				dataType:"html",
				beforeSend:function(){
					$('#aguardePagina').modal('show');
				},
				success: function (html) {
					$('#aguardePagina').modal('hide');
					$('#pagina').html(html);
					$('#pagina').show();
				}
			});

		});


        $('.btn-delete').click(function(event) {
            // Evita o comportamento padrão do formulario
            event.preventDefault();

            // Encontra o formulário associado ao botão clicado
            var form = $(this).closest('form');
            var id = $(this).data('id');

            // Utilizando SweetAlert para a confirmação
            Swal.fire({
                title: 'Tem certeza?',
                text: 'Deseja excluir este registro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Se confirmado, envia o formulário
                    form.submit();
                }
            });
        });



    });
</script>
