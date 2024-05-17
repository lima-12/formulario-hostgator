<?php

require_once 'Conexao.php';

use PDO;
use PDOException;

class Usuario {

    private $pdo;

    public function __construct()
    {
        // echo "debug";
        $conexao = new Conexao();
        $this->pdo = $conexao->pdo;
    }


    function getAll(){

        try {
            $stmt = $this->pdo->query('SELECT * FROM usuarios');
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro na consulta: " . $e->getMessage();
            return false;
        }
    }

    function find($email=null, $id=null){

        // echo'<pre>'; print_r($email); echo'</pre>'; exit;

        if ($email) {
            $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE email = ?;');
            $stmt->bindValue(1, $email, PDO::PARAM_STR);
            $stmt->execute();
        } elseif ($id) {
            $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE id = ?;');
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->execute();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } 

    function insert($nome, $email, $telefone, $data_nasc, $cidade, $estado, $endereco, $senha){

        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO usuarios 
                    (
                        nome, 
                        email, 
                        telefone, 
                        data_nasc, 
                        cidade, 
                        estado, 
                        endereco, 
                        senha
                    ) 
                VALUES 
                    (
                        :nome, 
                        :email, 
                        :telefone,
                        :data_nasc, 
                        :cidade, 
                        :estado, 
                        :endereco, 
                        :senha
                    )
            ");
    
            // Vincula os parâmetros
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':data_nasc', $data_nasc);
            $stmt->bindParam(':cidade', $cidade);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':endereco', $endereco);
            $stmt->bindParam(':senha', $senha);
    
            // Executa a declaração
            $stmt->execute();
    
            // Retorna o ID do último registro inserido, se necessário
            return $this->pdo->lastInsertId();
        } catch(PDOException $e) {
            // Se houver uma exceção, imprime o erro
            return "Erro: " . $e->getMessage();
        }

    }

    function update($nome, $email, $telefone, $sexo, $data_nasc, $cidade, $estado, $endereco, $senha, $id){
        try {
            $stmt = $this->pdo->prepare("
                UPDATE usuarios 
                SET
                    nome        = :nome,
                    email       = :email, 
                    telefone    = :telefone, 
                    data_nasc   = :data_nasc, 
                    cidade      = :cidade, 
                    estado      = :estado, 
                    endereco    = :endereco, 
                    senha       = :senha
                WHERE id = :id
            ");
            
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':data_nasc', $data_nasc);
            $stmt->bindParam(':cidade', $cidade);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':endereco', $endereco);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':id', $id);
            
            $stmt->execute();
            
            return true;

        } catch(PDOException $e) {
            
            return "Erro: " . $e->getMessage();

        }
    }    

    function delete($id){

        try {
            $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return true;

        } catch(PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;

        }
    }

    function verifica($email, $id) {
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE email = ? AND senha = ?');
        $stmt->bindValue(1, $email, PDO::PARAM_STR);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}