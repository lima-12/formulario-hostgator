<?php

    if(isset($_REQUEST['acesso']) && $_REQUEST['acesso'] == "negado") {
        // echo "<script>alert('email ou senha inválidos!');</script>";
        $message = 'email ou senha inválidos!';
    }

    if(isset($_REQUEST['msg']) && $_REQUEST['msg'] == "deletado") {
        // echo "<script>alert('email ou senha inválidos!');</script>";
        $message = 'Conta Deletada!';
    }

    // $message = 'Conta Deletada!';

?>



<?php include_once "src/views/header.php" ?>

    <body>

    <section>

        <div class="container mt-5 text-center">
            <div class="row">
                <div class="col-8 col-md-6 col-lg-4 mx-auto">
                    <?php if(isset($message)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?=$message?>
                        </div>
                    <?php  endif; ?>
                </div>
            </div>
        </div>

        <div class="row d-flex align-items-center justify-content-center" style="height: 70vh;">
            <div class="col-12 col-md-6 col-lg-4 card p-2 border-0">
                <div class="card-body text-center">
                    <h2 class="mb-3 fw-bold">DevLima</h2>
                    <!-- <img src="img/php.png" alt="" class="mb-3" height="50" width="50"> -->
                    <h4 class="mb-3 fw-bold">Sistema de Cadastro</h4>
                </div>
                <div class="card-body text-center">  
                    <form action="src/ajax/confirma-login.php" method="POST">

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
                            <label for="senha">Senha</label>
                        </div>

                        <div class="d-flex justify-content-between m-1">
                            <!-- <a href="src/views/formulario.php">Esqueci a Senha</a> -->
                            <button type="submit" name="submit" value="enviar" class="btn btn-success mb-2"> Entrar </button>
                        </div>
                        
                    </form>
                </div>

                <hr>

                <div class="d-flex justify-content-between m-2">
                    Ainda não tem Conta?
                    <a href="src/views/formulario.php" class="btn btn-primary">Cadastre-se</a>
                </div>

            </div>
        </div>

    </section>

    </body>

<?php include_once "src/views/footer.php" ?>
