<?php

// echo'<pre>'; print_r($_POST); echo'</pre>'; exit;

if(isset($_POST['submit'])){
    
    include_once('class/class.SQL.php');
    $sql = new SQL();
    
    $result = $sql->find($_POST['email']); 
    // echo'<pre>'; print_r($verificaUser); echo'</pre>'; exit;
    
    if(!empty($result)){
        # se for diferente de vazio significa que já existe um usuário com esse email 
        header('Location: formulario.php?erro=1');
    } else {
        $result = $sql->insert(
            $_POST['nome'], 
            $_POST['email'], 
            $_POST['telefone'], 
            $_POST['genero'], 
            $_POST['data_nascimento'], 
            $_POST['cidade'], 
            $_POST['estado'], 
            $_POST['endereco'], 
            $_POST['senha'], 
        );

        if($result){
            header('Location: sistema.php'); 
            exit;
        } else {
            echo "Location: formulario.php?erro=2";
        }
    }

}

?>