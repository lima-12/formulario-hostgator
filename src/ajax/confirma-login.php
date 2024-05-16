<?php

session_start();

require_once '../Model/Usuario.php';

$sql = new Usuario();

// echo"<pre>"; print_r($_POST); exit;

# se existir a variável ´submit´ e a variavel ´email´ e ´senha´ forem diferentes de vazio
if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])){

	$result = $sql->verifica($_POST['email'], $_POST['senha']);
	// echo"<pre>"; print_r($result); exit;

	if(!empty($result)){		
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['nome'] = $result[0]['nome'];
		$_SESSION['logado'] = true;
		header('Location: ../views/lista-usuario.php');
	} else {
        header("Location: ../../index.php?acesso=negado");
        exit();
	}
}