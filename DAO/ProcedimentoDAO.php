<?php

ini_set('display_errors', 0);
error_reporting(0);

class ProcedimentoDAO
{

    private $dao;

    public function __Construct()
    {
        $this->dao = new Conexao();
    }

    //LISTA TODOS OS PROCEDIMENTOS
    public function listar()
    {

        $sql = "select id, descricao
					from procedimento
					order by descricao";

        $stmt = $this->dao->query($sql);

        $procedimentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $procedimentos;
    }

    //LISTA PROCEDIMENTOS ATIVOS
    public function listarAtivos()
    {

        $sql = "select id, descricao
					from procedimentos
                    where status = 'ativo'
					order by descricao";

        $stmt = $this->dao->query($sql);

        $procedimentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $procedimentos;
    }

    //LISTA PROCEDIMENTOS ATIVOS POR TIPO
    public function listarAtivosPorTipo($id)
    {

        $sql = "select id, descricao as text
					from procedimentos
                    where status = 'ativo' && tipo_id = :id
					order by descricao";

        $stmt = $this->dao->prepare($sql);      
        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $procedimentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $procedimentos;
    }

    //LISTA PROCEDIMENTOS ATIVOS POR TIPO E PROFISSIONAL
    public function listarAtivosPorTipoEProfissional($tipo, $profissional)
    {

        $sql = "select proc.id, proc.descricao as text
					from procedimentos proc
                    inner join profissionalatende profate on profate.procedimento_id = proc.id
                    where proc.status = 'ativo' 
                    && proc.tipo_id = :tipo 
                    && profate.profissional_id = :profissional
                    && profate.status = 'ativo'
					order by proc.descricao";

        $stmt = $this->dao->prepare($sql);      
        $stmt->bindParam(":tipo", $tipo);
        $stmt->bindParam(":profissional", $profissional);

        $stmt->execute();

        $procedimentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $procedimentos;
    }

    //LISTA PROCEDIMENTOS POR PROFISSIONAL
    public function listarPorProfissional($id)
    {

        $sql = "select proc.id, proc.descricao
            from procedimentos proc
            inner join profissionalatende proate on proate.procedimento_id = proc.id
            where proate.profissional_id = :id
            order by proc.descricao";

        $stmt = $this->dao->prepare($sql);      
        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $procedimentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $procedimentos;
    }

}