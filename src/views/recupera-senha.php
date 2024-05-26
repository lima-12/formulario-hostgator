<?php
session_start();
// ob_start();

require_once __DIR__ . "/../config/Config.php";
require_once __DIR__ . '/../Model/Usuario.php';

$sql = new Usuario();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../lib/vendor/autoload.php';
$mail = new PHPMailer(true);

?>

<?php include_once "components/header.php" ?>

<body>

    <?php
    
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($dados['SendRecupSenha'])) {
        // echo'<pre>'; print_r($_POST); echo'</pre>'; exit;

        $result_usuario = $sql->find($_POST['email']);
        // echo'<pre>'; print_r($result_usuario); echo'</pre>'; exit;

        if (($result_usuario)) {

            $chave_recuperar_senha = password_hash($result_usuario[0]['id'], PASSWORD_DEFAULT);
            // echo "Chave $chave_recuperar_senha <br>"; exit;

            $result_up_usuario = $sql->updateRecuperaSenha(
                $chave_recuperar_senha, 
                $result_usuario[0]['id']
            );

            // echo'<pre> aqui'; print_r($result_up_usuario); echo'</pre>'; exit;

            if ($result_up_usuario) {
                $link = "http://localhost/formulario-hostgator/src/views/atualiza-senha.php?chave=$chave_recuperar_senha";

                // echo $link; exit;

                try {
                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                    // $mail->SMTPDebug = 2; // Ativar a depuração
                    $mail->CharSet = 'UTF-8';
                    $mail->isSMTP();

                    /* variaveis padrao do envio de email */ 

                    # usando o emailtrap
                    // $mail->Host       = 'sandbox.smtp.mailtrap.io';
                    // $mail->SMTPAuth   = true;
                    // $mail->Username   = '0b5e8f7c6b21bf';
                    // $mail->Password   = 'd02a60cb2fce16';
                    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    // $mail->Port       = 2525;

                    # usando o g-mail
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = EMAIL_USER;
                    $mail->Password   = EMAIL_PASSWORD; 
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
                    $mail->Port       = 587; 

                    $mail->setFrom('limaufpa2022@gmail.com', 'DevLima');

                    $mail->addAddress($result_usuario[0]['email'], $result_usuario[0]['nome']);

                    $mail->isHTML(true);                                  
                    $mail->Subject = 'Recuperar senha';
                    $mail->Body    = 'Prezado(a) ' . $result_usuario[0]['nome'] .".<br><br>Você solicitou alteração de senha.<br><br>Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: <br><br><a href='" . $link . "'>" . $link . "</a><br><br>Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.<br><br>";
                    $mail->AltBody = 'Prezado(a) ' . $result_usuario[0]['nome'] ."\n\nVocê solicitou alteração de senha.\n\nPara continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: \n\n" . $link . "\n\nSe você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.\n\n";

                    $mail->send();

                    $_SESSION['message'] = "Enviado com sucesso! verifique sua caixa de e-mail";
                    
                    header("Location: ../../index.php");
                } catch (Exception $e) {
                    echo "Erro: E-mail não enviado. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo  "<p style='color: #ff0000'>Erro: Tente novamente!</p>";
            }
        } else {
            echo "<p style='color: #ff0000'>Erro: Usuário não encontrado!</p>";
        }
    }

    if (isset($_SESSION['msg_rec'])) {
        echo $_SESSION['msg_rec'];
        unset($_SESSION['msg_rec']);
    }

    ?>



    <div class="row d-flex align-items-center justify-content-center" style="height: 70vh;">
            <div class="col-12 col-md-6 col-lg-4 card p-2 border-0">
                <div class="card-body text-center">
                    <h2 class="mb-3 fw-bold">DevLima</h2>
                    <!-- <img src="img/php.png" alt="" class="mb-3" height="50" width="50"> -->
                    <h4 class="mb-3 fw-bold">Recuperar Senha</h4>
                </div>
                <div class="card-body text-center">  
                    <form method="POST" action="">
                        <?php
                            $usuario = "";
                            if (isset($dados['usuario'])) {
                                $usuario = $dados['usuario'];
                            } 
                        ?>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $usuario; ?>" required>
                            <label for="email">Email</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="../../index.php">voltar</a>
                            <button class="btn btn-success" type="submit" value="Recuperar" name="SendRecupSenha"> 
                            Recuperar Senha 
                            </button>
                        </div>

                    </form>
                </div>
                
            </div>
        </div>

<?php include_once "components/footer.php" ?>