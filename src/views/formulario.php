<?php

session_start();

require_once '../Model/Usuario.php';
$sql = new Usuario();

// echo'<pre>'; print_r($_POST); echo'</pre>'; exit;

if((!empty($_REQUEST['erro'])) && ($_REQUEST['erro'] == 1)){
    echo "<script>alert('Usuário já cadastrado!');</script>";
}

$editar = 0;

if (isset($_POST['id']) && !empty($_POST['id'])) {
    // editar o formulario

    $user = $sql->find(id: $_POST['id']);
    if (!empty($user)) {
        $user = $user[0];
        $editar = 1;
        
    } else {
        $user = null;
        
    }
}

?>

    <?php include_once "components/header.php" ?>

    <body>

        <!-- <button id="voltar"> <a href="home.php">Voltar</a> </button> -->

        <?php include_once "components/message.php" ?>
        
        <div class="container"> <!-- container principal -->
            <div class="row container-fluid d-flex align-items-center justify-content-center" style="height: 70vh;">
                <div class="col-12 col-md-12 col-lg-8 card p-2 border-0">    

                    <div class="card-body">
                        <?php if(!empty( $user )): ?>
                            <h3 class="h3"> Editar Cadastro </h3>
                        <?php else: ?>
                            <h3 class="h3"> Cadastro </h3>
                        <?php endif; ?>
                    </div>

                    <div class="card-body">
                        <form action="../controllers/valida-formulario.php" method="POST">        
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                    <input class="form-control" type="text" name="nome" id="nome" placeholder="Nome Completo" value="<?= $user['nome'] ?? '' ?>" required>
                                    <label for="nome">Nome Completo</label>
                                </div>

                                <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                    <input class="form-control" type="password" name="senha" id="senha" placeholder="Senha" value="<?= $user['senha'] ?? '' ?>" required>
                                    <label for="senha">Senha</label>
                                </div>

                                <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                    <input class="form-control" type="text" name="email" id="email" placeholder="Email" value="<?= $user['email'] ?? '' ?>" required>
                                    <label for="nome">Email</label>    
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                    <input class="form-control" type="tel" name="telefone" id="telefone" placeholder="telefone" value="<?= $user['telefone'] ?? '' ?>" required>
                                    <label for="telefone">Telefone</label>
                                </div>

                                <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                    <label for="data_nascimento"></label>
                                    <input class="form-control" type="date" name="data_nascimento" id="data_nascimento" placeholder="Data" value="<?= $user['data_nasc'] ?? '' ?>" required>
                                </div>

                                <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                    <input class="form-control" type="text" name="cidade" id="cidade" placeholder="Cidade" value="<?= $user['cidade'] ?? '' ?>" required>
                                    <label for="cidade">Cidade</label>    
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                    <input class="form-control" type="text" name="estado" id="estado" placeholder="Estado" value="<?= $user['estado'] ?? '' ?>" required>
                                    <label for="estado">Estado</label>    
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                    <input class="form-control" type="text" name="endereco" id="endereco" placeholder="Endereço" value="<?= $user['endereco'] ?? '' ?>" required>
                                    <label for="endereco">Endereço</label>    
                                </div>

                                <input type="hidden" name="editar" value=<?=$editar?>>
                                <?php if(!empty( $user )): ?>
                                    <input type="hidden" name="id" value=<?=$_POST['id']?>>
                                <?php endif; ?>

                            </div>        

                            <div class="my-4 mb-2 mx-auto">
                                <button class="btn btn-primary btn-sm px-3" type="submit" name="submit" id="submit" value="enviar"> 
                                    <?php if(!empty( $user )): ?>
                                        Editar Cadastro 
                                    <?php else: ?>
                                        Fazer Cadastro
                                    <?php endif; ?>
                                </button>
                            </div>
                        </form>
                        <!-- <button class="btn btn-primary btn-sm w-25" id="preencher">Preencher Formulário</button> -->
                    </div>
                </div>
            </div>
        </div> <!-- fim do container principal -->

    </body>


<?php include_once "components/footer.php" ?>

<script>

    $("#preencher").click(function(){
        document.getElementById('nome').value = 'Fulano de Tal';
        document.getElementById('senha').value = 'senha123';
        document.getElementById('email').value = 'matheus@exemplo.com';
        document.getElementById('telefone').value = '123456789';
        document.getElementById('masculino').checked = true; // ou 'masculino' ou 'outros'
        document.getElementById('data_nascimento').value = '2000-01-01';
        document.getElementById('cidade').value = 'Cidade';
        document.getElementById('estado').value = 'Estado';
        document.getElementById('endereco').value = 'Endereço Completo';
    });

</script>