<?php

    session_start();

?>



<?php include_once "src/views/components/header.php" ?>

    <body>

        <?php include_once "src/views/components/message.php" ?>

        <section class="container">
            
            <div class="row d-flex align-items-center justify-content-center" style="height: 70vh;">
                <div class="col-12 col-md-6 col-lg-4 card p-2 border-0">
                    <div class="card-body text-center">
                    <h2 class="mb-3 fw-bold">DevLima</h2>
                    <!-- <img src="img/php.png" alt="" class="mb-3" height="50" width="50"> -->
                    <h4 class="mb-3 fw-bold">Sistema de Cadastro</h4>
                </div>
                <div class="card-body text-center">  
                    <form action="src/controllers/login.php" method="POST">

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
                            <label for="senha">Senha</label>
                        </div>

                        <div>
                            <button type="submit" name="submit" value="enviar" class="w-100 btn btn-sm btn-success mb-4"> Entrar </button>
                        </div>
                        
                    </form>

                    <div class="d-flex justify-content-between m-1">
                        <a href="src/views/recupera-senha.php" style="text-decoration: none">Esqueci a Senha</a>
                        <form action="src/controllers/login.php" method="POST">
                            <button type="submit" name="submit" value="visitante" class="btn btn-sm btn-primary mb-2"> Visitante </button>
                        </form>
                    </div>

                </div>

                <hr>

                <div class="d-flex justify-content-between m-2">
                    Ainda não tem Conta?
                    <a href="src/views/formulario.php" class="btn btn-sm btn-primary">Cadastre-se</a>
                </div>

            </div>

        </section>

    </body>

<?php include_once "src/views/components/footer.php" ?>
