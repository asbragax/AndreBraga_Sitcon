<?php

class Conexao extends PDO
{

    private $dataBase = "mysql";
    private $hostName = "localhost";
    private $dbName = "andrebraga_sitcon";
    private $userName = "root";
    private $password = "";
    private $dao = null;

    public function __construct()
    {
        try {
            if ($this->dao == null) {

                $stringConexao = $this->dataBase . ":host=" . $this->hostName . ";dbname=" . $this->dbName;
                $conexao = parent::__construct($stringConexao, $this->userName, $this->password);
                $this->dao = $conexao;

                return $this->dao;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}