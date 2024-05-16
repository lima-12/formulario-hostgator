<?php

session_start();

// Verifica se a sessão não está ativa
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: index.php');
    exit(); 
}

require_once "class/class.SQL.php";

$sql = new SQL();

if($_REQUEST['id'] != ''){

    $user = $sql->find(id: $_REQUEST['id']);
    $user = $user[0];

}

// echo'<pre>'; print_r($user); echo'</pre>'; exit;

?>


<?php include_once "views/header.php" ?>
        <link rel="stylesheet" href="style/style.css">  <!-- cada arquivo tem seu style especifico-->
    </head>

    <body>

        <!-- <button id="voltar"> <a href="home.php">Voltar</a> </button> -->
        
        <div class="container"> <!-- container principal -->

            <div class="row">
                <div class="col-8 mx-auto my-5"> <!-- centralizando -->
                    <div class="container">
                        <div class="row">
                            <div class="card">
                                <div class="card-header my-3">
                                    <h3 class="h3"> Cadastro </h3>
                                </div>

                                <div class="card-body">
                                    <form action="saveEdit.php" method="POST">        
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                                <input class="form-control" type="text" name="nome" id="nome" placeholder="Nome Completo" value="<?= $user['nome'] ?>" required>
                                                <label for="nome">Nome Completo</label>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                                <input class="form-control" type="password" name="senha" id="senha" placeholder="Senha" value="<?= $user['senha'] ?>" required>
                                                <label for="senha">Senha</label>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                                <input class="form-control" type="text" name="email" id="email" placeholder="Email" value="<?= $user['email'] ?>" required>
                                                <label for="nome">Email</label>    
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                                <input class="form-control" type="tel" name="telefone" id="telefone" placeholder="telefone" value="<?= $user['senha'] ?>" required>
                                                <label for="telefone">Telefone</label>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                                <label for="data_nascimento"></label>
                                                <input class="form-control" type="date" name="data_nascimento" id="data_nascimento" placeholder="Data" value="<?= $user['data_nasc'] ?>" required>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                                <input class="form-control" type="text" name="cidade" id="cidade" placeholder="Cidade" value="<?= $user['cidade'] ?>" required>
                                                <label for="cidade">Cidade</label>    
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                                <input class="form-control" type="text" name="estado" id="estado" placeholder="Estado" value="<?= $user['estado'] ?>" required>
                                                <label for="estado">Estado</label>    
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                                <input class="form-control" type="text" name="endereco" id="endereco" placeholder="Endereço" value="<?= $user['endereco'] ?>" required>
                                                <label for="endereco">Endereço</label>    
                                            </div>
                                        </div>        

                                        <div class="my-4 mb-2 mx-auto">
                                            <button class="btn btn-primary btn-sm w-25" type="submit" name="submit" id="submit" value="enviar"> Fazer Cadastro </button>
                                        </div>
                                    </form>
                                    <!-- <button class="btn btn-primary btn-sm w-25" id="preencher">Preencher Formulário</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- fim do container principal -->

    </body>


<?php include_once "views/footer.php" ?>
