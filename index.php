<?php

    if(isset($_REQUEST['acesso']) && $_REQUEST['acesso'] == "negado") {
        // echo "<script>alert('email ou senha inválidos!');</script>";
        $message = 'email ou senha inválidos!';
    }

    if(isset($_REQUEST['msg']) && $_REQUEST['msg'] == "deletado") {
        // echo "<script>alert('email ou senha inválidos!');</script>";
        $message = 'Conta Deletada!';
    }

?>



<?php include_once "src/views/header.php" ?>

    <body>

    <?php if(isset($message)) : ?>
        <div class="my-5 alert alert-danger fixed-top w-25 mx-auto text-center" role="alert" >
            <div class="container">
                <div class="row">
                    <div class="col">
                        <?=$message?>
                    </div>
                </div>
            </div>
        </div>
    <?php  endif; ?>

    <div class="row container-fluid d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="col-4 card p-2 border-0" id="card-esquerda">
            <div class="card-header text-center">
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
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
                        <label for="senha">Senha</label>
                    </div>
                    
                    <button type="submit" name="submit" value="enviar" class="btn btn-primary w-100 mb-2"> Entrar </button>
                    <a href="formulario.php" class="btn btn-primary w-100">Cadastre-se</a>
                </form>
            </div>
        </div>
    </div>

    </body>

<?php include_once "src/views/footer.php" ?>
