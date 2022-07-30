<?php
    if(isset($_POST['btnSalvarSolicitacao'])){
        //INICIALIZA O DAO
        $dao = new SolicitacaoDAO();

        //BUSCA O VALOR DO AUTO_INCREMENT DO ID
        echo 1;
        $autoIncrement = $dao->showStatus();
        //CADASTRA A SOLICITAÇÃO
        $resultado = $dao->cadastrar($_POST['paciente_id'], $_POST['profissional'], $_POST['tipo'], $_POST['data'], $_POST['hora']);

        //PERCORRE O ARRAY DE PROCEDIMENTOS E SALVA NO BANCO
        for ($i=0; $i < count($_POST['procedimentos']); $i++) { 
            //CADASTRA NA TABELA SOLICITACAO_PROCEDIMENTO USANDO O ID DA SOLICITACAO E O ID DO PROCEDIMENTO
            $dao->cadastrarProcedimentos($autoIncrement['Auto_increment'], $_POST['procedimentos'][$i]);
        }


        //SE GRAVOU, REDIRECIONA PARA A TELA DE SOLICITAÇÕES
        if($resultado){ ?>
            <meta http-equiv="refresh" content="0; url=solicitacoes.php">
        <?php }
    }
?>