
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nova Solicitação Clínica - Teste André Braga para Sitcon</title>

        <!-- CSS only -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    </head>
    <body>
        <?php 

                //VERIFICA SE EXISTE UM PARÂMETRO PASSADO VIA GET, CASO NÃO EXISTA EXIBE UMA MENSAGEM DE ERRO
                if(isset($_GET['id']) && strlen($_GET['id']) > 0){
    
                    $id = $_GET['id'];
                    include_once('db/Conexao.class.php');
                    include_once('DAO/PacienteDAO.php');
                    include_once('DAO/ProfissionalDAO.php');
                    include_once('DAO/SolicitacaoDAO.php');
                    include_once('action/cadastraSolicitacao.php');
                    
                    //BUSCA O PACIENTE PELO ID
                    $dao = new PacienteDAO();
                    $paciente = $dao->buscaPorId($id);


                    //LISTA OS PROFISSIONAIS ATIVOS
                    $dao = new ProfissionalDAO();
                    $profissionais = $dao->listarAtivos($id);

                    //LISTA OS TIPOS DE SOLICITAÇÃO
                    $dao = new SolicitacaoDAO();
                    $tipos = $dao->listarTipos();
                }else{

                    $paciente = null;
                }

        ?>
        <nav class="navbar navbar-expand-lg bg-primary">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav flex-row flex-wrap ms-md-auto me-md-5 my-md-2">
                        <li class="nav-item">
                            <a class="btn btn-outline-light me-4" href="pacientes.php">Pacientes</a>
                        </li>
                        <li class="nav-item float-end">
                            <a class="btn btn-outline-light" href="nova_solicitacao.php">Listagem de Solicitações</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-sm-1 mb-3">
                        <a href="pacientes.php" class="btn btn-outline-primary">Voltar</a>
                    </div>
                    <div class="col-sm-12">
                        <?php if($paciente != null){ ?>
                        <form class="form-horizontal" method="post" role="form" id="formCadastraSolicitacao">
                            <div class="row">

                                <div class="mb-3 col-sm-4">
                                    <label for="nome" class="form-label fw-bold">Nome do paciente</label>
                                    <input type="text" class="form-control border-primary" id="nome" name="nome" value="<?php echo $paciente['nome']; ?>" readonly>
                                    <input type="hidden" name="paciente_id" id="paciente_id" value="<?php echo $id; ?>">
                                </div>

                                <div class="mb-3 col-sm-4">
                                    <label for="dataNasc" class="form-label fw-bold">Data de Nascimento</label>
                                    <input type="text" class="form-control border-primary" id="dataNasc" name="dataNasc" value="<?php echo $paciente['dataNascF']; ?>" readonly>
                                </div>

                                <div class="mb-3 col-sm-4">
                                    <label for="cpf" class="form-label fw-bold">CPF</label>
                                    <input type="text" class="form-control border-primary" id="cpf" name="cpf" value="<?php echo $paciente['CPF']; ?>" readonly>
                                </div>

                                <div class="col-sm-12">
                                    <div class="alert alert-danger text-center" role="alert">
                                        <strong>Atenção!</strong> Os Campos com * devem ser preenchidos obrigatóriamente.
                                        <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>

                                <div class="mb-3 col-sm-12">
                                    <label for="profissional" class="form-label fw-bold">Profissional*</label>
                                    <select class="form-control select2 lh-lg" id="profissional" name="profissional" required>
                                        <?php for ($i=0; $i < count($profissionais); $i++) { ?>
                                            <option value="<?php echo $profissionais[$i]['id']; ?>"><?php echo $profissionais[$i]['nome']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="mb-3 col-sm-6">
                                    <label for="tipo" class="form-label fw-bold">Tipo de solicitação*</label>
                                    <select class="form-control select2 lh-lg" id="tipo" name="tipo" required>
                                        <?php for ($i=0; $i < count($tipos); $i++) { ?>
                                            <option value="<?php echo $tipos[$i]['id']; ?>"><?php echo $tipos[$i]['descricao']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="mb-3 col-sm-6">
                                    <label for="procedimentos" class="form-label fw-bold">Procedimentos*</label>
                                    <select class="form-control select2 lh-lg" id="procedimentos" name="procedimentos[]" required>
                                    </select>
                                </div>

                                <div class="mb-3 col-sm-6">
                                    <label for="data" class="form-label fw-bold">Data*</label>
                                    <input type="date" class="form-control border-primary" id="data" name="data" required value="<?php echo date("Y-m-d"); ?>">
                                </div>

                                <div class="mb-3 col-sm-6">
                                    <label for="hora" class="form-label fw-bold">Hora*</label>
                                    <input type="time" class="form-control border-primary" id="hora" name="hora" required>
                                </div>
                                <div class="mb-3 col-sm-12 text-end">
                                    <button type="submit" class="btn btn-primary px-5" name="btnSalvarSolicitacao">Salvar</button>
                                </div>
                                    
                            </div>
                        </form>
                        <?php }else{
                            echo "<h1 class='text-center'>Nenhum paciente selecionado, por favor selecione um paciente antes de tentar marcar uma nova solicitação.</h1>";
                        } ?>
                    </div>
                </div>
            </div>
        </main>

    </body>
    <!-- JavaScript Bundle with Popper -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
         $(document).ready(function () {
            
            $('.select2').select2({
                containerCssClass: "border-primary",
                theme: "bootstrap-5"
            });

            $("#tipo").change();

        });

        $("#tipo, #profissional").change(function (e) { 
            e.preventDefault();
            const tipo = $("#tipo").val();  
            const profissional = $("#profissional").val();  
            try {
                $.post("action/buscaProcedimentos.php", "tipo="+tipo+"&profissional="+profissional,
                function(procedimentos) {
                    if(procedimentos && procedimentos != null){
                            $('#procedimentos').empty();
                            procedimentos = JSON.parse(procedimentos);
                            if(tipo === '2'){
                                $('#procedimentos').select2({
                                    containerCssClass: "border-primary",
                                    theme: "bootstrap-5",
                                    data: procedimentos,
                                    multiple: true,

                                });
                            }else{
                                $('#procedimentos').select2({
                                    containerCssClass: "border-primary",
                                    theme: "bootstrap-5",
                                    data: procedimentos,
                                    multiple: true,
                                    maximumSelectionLength: 1
                                });
                                
                            }
                        }
                    }, "html");
            } catch (error) {
                console.log("erro na busca de procedimentos");
            }
        });
    </script>
</html>