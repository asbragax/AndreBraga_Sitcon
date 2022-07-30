<?php

ini_set('display_errors', 0);
error_reporting(0);

class PacienteDAO
{

    private $dao;

    public function __Construct()
    {
        $this->dao = new Conexao();
    }

    //LISTA TODOS OS PACIENTES
    public function listar()
    {

        $sql = "select *, DATE_FORMAT(dataNasc,'%d/%m/%Y') as dataNascF
					from pacientes
					order by nome";

        $stmt = $this->dao->query($sql);

        $pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $pacientes;
    }

    //LISTA OS PACIENTES ATIVOS
    public function listarAtivos()
    {

        $sql = "select *, DATE_FORMAT(dataNasc,'%d/%m/%Y') as dataNascF
					from pacientes
                    where status = 'ativo'
					order by nome";

        $stmt = $this->dao->query($sql);

        $pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $pacientes;
    }

      //LISTA PROFISSIONAIS POR PROCEDIMENTO
      public function buscaPorId($id)
      {
  
          $sql = "select *, DATE_FORMAT(dataNasc,'%d/%m/%Y') as dataNascF
          from pacientes
          where id = :id";
  
          $stmt = $this->dao->prepare($sql);      
          $stmt->bindParam(":id", $id);
          $stmt->execute();
  
          $profissionais = $stmt->fetch(PDO::FETCH_ASSOC);
  
          return $profissionais;
      }

}