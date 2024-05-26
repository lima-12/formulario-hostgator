<?php

session_start();

require_once '../Model/Usuario.php';
$sql = new Usuario();

// echo'<pre>'; print_r($_POST); echo'</pre>'; exit;

if ( (isset($_POST['editar'])) && ($_POST['editar'] == 1) ) {

    $result = $sql->update(
        $_POST['nome'], 
        $_POST['email'], 
        $_POST['telefone'], 
        $_POST['genero'], 
        $_POST['data_nascimento'], 
        $_POST['cidade'], 
        $_POST['estado'], 
        $_POST['endereco'], 
        $_POST['senha'], 
        $_POST['id']
    );

    header('Location: ../views/lista-usuario.php?editado');
    exit;
}

if(isset($_POST['submit'])){

    // echo'<pre>'; print_r($_POST); echo'</pre>'; exit;

    $result = $sql->find($_POST['email']); 

    // echo'<pre>'; print_r($result); echo'</pre>'; exit;
    
    if(!empty($result)){
        # se for diferente de vazio significa que já existe um usuário com esse email 
        $_SESSION['message'] = 'Email já cadastrado!';
        header('Location: ../views/formulario.php');
        exit;
    }

    $insert = $sql->insert(
        $_POST['nome'], 
        $_POST['email'], 
        $_POST['telefone'], 
        $_POST['data_nascimento'], 
        $_POST['cidade'], 
        $_POST['estado'], 
        $_POST['endereco'], 
        $_POST['senha'], 
    );

    // echo'<pre>'; print_r($insert); echo'</pre>'; exit;

    if(!$insert){
        $_SESSION['message'] = 'usuario não inserido!';
        header("Location: ../views/formulario.php");
        exit;
    }

    header("Location: ../../index.php");
    exit;

} else {
    $_SESSION['message'] = 'usuario não inserido!';
    header("Location: ../views/formulario.php");
    exit;
}

?>