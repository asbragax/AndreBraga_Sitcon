<?php

ini_set('display_errors', 0);
error_reporting(0);

class SolicitacaoDAO
{

    private $dao;

    public function __Construct()
    {
        $this->dao = new Conexao();
    }


    public function cadastrar($paciente_id, $profissional_id, $tipo_id, $data, $hora)
    {

        $sql = "insert into solicitacoes (paciente_id, profissional_id, tipo_id, data, hora)
        values ( :paciente_id, :profissional_id, :tipo_id, :data, :hora)";
        $this->dao->beginTransaction();
        $stmt = $this->dao->prepare($sql);
        
        $stmt->bindParam(":paciente_id", $paciente_id);
        $stmt->bindParam(":profissional_id", $profissional_id);
        $stmt->bindParam(":tipo_id", $tipo_id);
        $stmt->bindParam(":data", $data);
        $stmt->bindParam(":hora", $hora);
        
        echo $paciente_id." ".$profissional_id." ".$tipo_id." ".$data." ".$hora;
        $result = $stmt->execute();
        if ($result) {
            $this->dao->commit();
            return "true";
        } else {
            $this->dao->rollback();
            return "";
        }

    }

    public function cadastrarProcedimentos($solicitacao_id, $procedimento_id)
    {

        $sql = "insert into solicitacao_procedimento (solicitacao_id, procedimento_id)
        values ( :solicitacao_id, :procedimento_id)";

        $this->dao->beginTransaction();
        $stmt = $this->dao->prepare($sql);
        
        $stmt->bindParam(":solicitacao_id", $solicitacao_id);
        $stmt->bindParam(":procedimento_id", $procedimento_id);

        $result = $stmt->execute();
        if ($result) {
            $this->dao->commit();
            return "true";
        } else {
            $this->dao->rollback();
            return "";
        }

    }

    public function listarTipos()
    {

        $sql = "select *
					from tiposolicitacao
                    where status = 'ativo'";

        $stmt = $this->dao->query($sql);

        $tipos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $tipos;
    }

    public function listar()
    {

        $sql = "select sol.id, 
        DATE_FORMAT(sol.data,'%d/%m/%Y') as dataf, hora,
        pac.nome, pac.CPF,
        tiposol.descricao as tipo
					from solicitacoes sol
                    inner join pacientes pac on pac.id = sol.paciente_id
                    inner join tiposolicitacao tiposol on tiposol.id = sol.tipo_id
					order by id desc";

        $stmt = $this->dao->query($sql);

        $solicitacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $solicitacoes;
    }

    public function listarProcedimentosPorSolicitacao($id)
    {

        $sql = "select proc.id, proc.descricao
            from solicitacao_procedimento solproc 
            inner join procedimentos proc on solproc.procedimento_id = proc.id
            where solproc.solicitacao_id = :id";

        $stmt = $this->dao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $procedimentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $procedimentos;
    }

    public function showStatus()
    {

        $sql = "show table status like 'solicitacoes'";

        $stmt = $this->dao->query($sql);

        $solicitacoes = $stmt->fetch(PDO::FETCH_ASSOC);

        return $solicitacoes;
    }


}