<?php

ini_set('display_errors', 0);
error_reporting(0);

class ProfissionalDAO
{

    private $dao;

    public function __Construct()
    {
        $this->dao = new Conexao();
    }

    //LISTA TODOS OS PROFISSIONAIS
    public function listar()
    {

        $sql = "select id, nome
					from profissional
					order by nome";

        $stmt = $this->dao->query($sql);

        $profissionais = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $profissionais;
    }

    //LISTA PROFISSIONAIS ATIVOS
    public function listarAtivos()
    {

        $sql = "select id, nome
					from profissional
                    where status = 'ativo'
					order by nome";

        $stmt = $this->dao->query($sql);

        $profissionais = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $profissionais;
    }

    //LISTA PROFISSIONAIS POR PROCEDIMENTO
    public function listarPorProcedimento($id)
    {

        $sql = "select prof.id, prof.nome
                from profissional prof
                inner join profissionalatende proate on proate.profissional_id = prof.id
                where proate.procedimento_id = :id
                order by prof.nome";

        $stmt = $this->dao->prepare($sql);      
        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $profissionais = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $profissionais;
    }

}