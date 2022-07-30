<?php

    include_once('../db/Conexao.class.php');
    include_once('../functions/json_encode.php');
    include_once('../DAO/ProcedimentoDAO.php');

    $dao = new ProcedimentoDAO();
    $procedimentos = $dao->listarAtivosPorTipoEProfissional($_POST['tipo'], $_POST['profissional']);

    echo safe_json_encode($procedimentos);

?>