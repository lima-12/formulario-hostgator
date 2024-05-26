<?php
session_start();

// echo"<pre>"; print_r($_POST);exit;

require_once '../Model/Usuario.php';
$sql = new Usuario();

$r = $sql->delete($_POST['id']);

if($r) {
    $_SESSION['message'] = 'Conta Deletada!';
    header('Location: ../../index.php');
} else {
    // echo json_encode(['status' => 'error']);
}