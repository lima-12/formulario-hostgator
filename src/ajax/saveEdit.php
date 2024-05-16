<?php

include_once "class/class.SQL.php";
$sql = new SQL();

// echo"<pre>"; print_r($_POST); exit;

if(isset($_POST['submit'])){
    $sql->update(
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

    header('Location: sistema.php');

}