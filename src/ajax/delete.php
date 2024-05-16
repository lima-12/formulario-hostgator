<?php
session_start();

// echo"<pre>"; print_r($_POST);exit;

require_once '../Model/Usuario.php';

$sql = new Usuario();

$r = $sql->delete($_POST['id']);
// $r = 1;

if($r) {
    header('Location: ../../index.php?msg=deletado');
} else {
    // echo json_encode(['status' => 'error']);
}