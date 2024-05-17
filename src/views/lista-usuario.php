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
	<body>

		<nav class="navbar bg-body-tertiary">
			<div class="container-fluid">
				<!-- <form class="d-flex" role="search">
					<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success" type="submit">Search</button>
				</form> -->
				
				<a href="../ajax/sair.php" class="btn btn-outline-danger">sair</a>
			</div>
		</nav>

		<br>

		<h1 class="text-center"> Bem Vindo <?=$userAtual[0]['nome']?> </h1>

		<div class="m-5">
			<table class="table table-hover" >
				<thead>
					<tr>
						<th scope="col">Name</th>
						<th scope="col">Action</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach($aUsuarios as $user){ 

						$valida = ($user['id'] === $userAtual[0]['id']) ? "" : "disabled";
					?>
						<tr>
							<td> <?=$user['nome']?> </td>
							<td>	
								<button class='btn btn-sm btn-success' data-id="esconde<?=$user['id']?>" <?=$valida?>>
									<i style="color: white;" class="bi bi-plus"></i>
								</button>

								<form action="formulario.php" method="post" style="display: inline;">
									<input type="hidden" name="id" value="<?=$user['id']?>">
									<button class='btn btn-sm btn-primary btn-edit' <?=$valida?>>
										<i style="color: white;" class="bi bi-pencil"></i>
									</button>
								</form>
								
								<form action="../ajax/delete.php" method="post" style="display: inline;">
									<input type="hidden" name="id" value="<?=$user['id']?>">
									<button class='btn btn-sm btn-danger btn-delete' data-id="<?=$user['id']?>" <?=$valida?>>
										<i style="color: white;" class="bi bi-trash"></i>
									</button>
								</form>
							</td>
						</tr>
						<tr>
							<td colspan="2" id="esconde<?=$user['id']?>" style="display: none;">
								<table>
									<tr>
										<td> Email: <?=$user['email']?> </td>
									</tr>
									<tr>
										<td> Telefone: <?=$user['telefone']?></td>
									</tr>
									<tr>
										<td> Data de Nascimento: <?=$user['data_nasc']?> </td>
									</tr>
									<tr>
										<td> <?=$user['cidade']?> - <?=$user['estado']?> </td>
									</tr>
									<tr>
										<td> Endereço: <?=$user['endereco']?>  </td>
									</tr>
								</table>
							</td>
						</tr>
					<?php } ?>
				</tbody>

			</table>

		</div>

	</body>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php include_once "footer.php" ?>

<script>

	// new DataTable('#tabela');

    $(document).ready(function() {

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

		$(".btn-success").click(function(){
			var id = $(this).data("id");
			$("#" + id).toggle(500);
			$(this).find('i').toggleClass('bi-plus bi-dash');
		});



		// $('.btn-expand').on('click', function() {
		// 	const userId = $(this).data('id');
		// 	const extraInfoRow = $('#extra-info-' + userId);

		// 	extraInfoRow.slideToggle();
		// 	$(this).find('i').toggleClass('bi-plus bi-dash');
		// });

    });
</script>
