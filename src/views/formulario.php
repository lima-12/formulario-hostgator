<?php

session_start();

#$_SESSION['form_data']

if((!empty($_REQUEST['erro'])) && ($_REQUEST['erro'] == 1)){
    echo "<script>alert('Usuário já cadastrado!');</script>";
}

?>

    <?php include_once "header.php" ?>
        <link rel="stylesheet" href="style/style.css">  <!-- cada arquivo tem seu style especifico-->
    </head>

    <body>

        <!-- <button id="voltar"> <a href="home.php">Voltar</a> </button> -->
        
        <div class="container"> <!-- container principal -->

            <!-- <div class="row"> -->
                <!-- <div class="col-8 mx-auto my-5">  -->
                    <!-- <div class="container"> -->
                        <!-- <div class="row"> -->
                            <div class="row container-fluid d-flex align-items-center justify-content-center" style="height: 100vh;">
                                <div class="col-12 col-md-12 col-lg-8 card p-2 border-0">    
                                    <div class="card-header my-3">
                                            <h3 class="h3"> Cadastro </h3>
                                        </div>

                                    <div class="card-body">
                                        <form action="validaFormulario.php" method="POST">        
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                                    <input class="form-control" type="text" name="nome" id="nome" placeholder="Nome Completo" value="<?= isset($nome) ?>" required>
                                                    <label for="nome">Nome Completo</label>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                                    <input class="form-control" type="password" name="senha" id="senha" placeholder="Senha" value="<?php echo isset($form_data['senha']) ? $form_data['senha'] : '';?>" required>
                                                    <label for="senha">Senha</label>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                                    <input class="form-control" type="text" name="email" id="email" placeholder="Email" required>
                                                    <label for="nome">Email</label>    
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                                    <input class="form-control" type="tel" name="telefone" id="telefone" placeholder="telefone" required>
                                                    <label for="telefone">Telefone</label>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                                    <label for="data_nascimento"></label>
                                                    <input class="form-control" type="date" name="data_nascimento" id="data_nascimento" placeholder="Data" required>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                                    <input class="form-control" type="text" name="cidade" id="cidade" placeholder="Cidade" required>
                                                    <label for="cidade">Cidade</label>    
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                                    <input class="form-control" type="text" name="estado" id="estado" placeholder="Estado" required>
                                                    <label for="estado">Estado</label>    
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6 mb-2 form-floating">
                                                    <input class="form-control" type="text" name="endereco" id="endereco" placeholder="Endereço" required>
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
                        <!-- </div> -->
                    <!-- </div> -->
                <!-- </div> -->
            <!-- </div> -->

        </div> <!-- fim do container principal -->

    </body>


<?php include_once "footer.php" ?>

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