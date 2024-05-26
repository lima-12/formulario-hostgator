<?php
session_start();
// ob_start();

require_once '../Model/Usuario.php';
$sql = new Usuario();
?>

<?php include_once "components/header.php" ?>

<body>

    <?php
        $chave = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT);
        // echo'<pre>'; print_r($chave); echo'</pre>'; exit;

        if (!empty($chave)) {
                // echo'<pre>'; print_r($chave); echo'</pre>'; exit;

                $result_usuario = $sql->getRecuperaSenha($chave);
                
                if (!empty($result_usuario)) {
                    
                    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                    // echo'<pre>'; print_r($dados); echo'</pre>';
                    // echo'<pre>'; print_r($result_usuario); echo'</pre>'; 

                    if (!empty($dados['SendNovaSenha'])) {
                        #ainda nao estou salvando a senha em has
                        // $senha_usuario = password_hash($dados['senha'], PASSWORD_DEFAULT);
                        
                        #passando direto no update
                        // $recuperar_senha = 'NULL';

                        // echo'<pre> senha: '; print_r($dados['senha']); echo'</pre>';

                        $result_up_usuario = $sql->alterSenha($dados['senha'], $result_usuario[0]['id']);
                        // echo'<pre> update: '; print_r($result_up_usuario); echo'</pre>'; exit;
        
                        if ($result_up_usuario) {
                            $_SESSION['msg'] = "<p style='color: green'>Senha atualizada com sucesso!</p>";
                            header("Location: ../../index.php");
                        } else {
                            echo "<p style='color: #ff0000'>Erro: Tente novamente!</p>";
                        }
                    }

                    
                } else {
                    $_SESSION['msg_rec'] = "<p style='color: #ff0000'>Erro: Link inválido, solicite novo link para atualizar a senha!</p>";
                    header("Location: recuperar_senha.php");
                }
        } else {
            $_SESSION['msg_rec'] = "<p style='color: #ff0000'>Erro: Link inválido, solicite novo link para atualizar a senha!</p>";
            header("Location: recuperar_senha.php");
        }

    ?>

    <div class="row d-flex align-items-center justify-content-center" style="height: 70vh;">
        <div class="col-12 col-md-6 col-lg-4 card p-2 border-0">
            <div class="card-body text-center">
                <h2 class="mb-3 fw-bold">DevLima</h2>
                <h4 class="mb-3 fw-bold">Atualizar Senha</h4>
            </div>
            <div class="card-body text-center">  
                <form method="POST" action="">
                    <?php
                        $usuario = "";
                        if (isset($dados['senha_usuario'])) {
                            $usuario = $dados['senha_usuario'];
                        } 
                    ?>

                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
                            <label for="senha">Senha</label>
                        </div>

                    <div class="d-flex justify-content-between">
                        <a href="../../index.php">voltar</a>
                        <button class="btn btn-success" type="submit" value="Atualizar" value="<?=$usuario?>" name="SendNovaSenha"> 
                        Atualizar
                        </button>
                    </div>

                </form>
            </div>
            
        </div>
    </div>

</body>

<?php include_once "components/footer.php" ?>