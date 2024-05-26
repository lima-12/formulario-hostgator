<?php

require_once __DIR__ . "/Config.php";

use PDO;
use PDOException;

class Conexao {

    private $host = DB_HOST;
    private $port = DB_PORT;
    private $dbname = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASSWORD;
    public $pdo;

    function __construct()
    {
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname}";

            $this->pdo = new PDO($dsn, $this->username, $this->password);

            // Configurando o PDO para lançar exceções em caso de erro
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
            exit();
        }
    }

}
?>
