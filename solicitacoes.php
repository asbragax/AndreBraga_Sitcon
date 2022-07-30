
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Listagem de Solicitações Clínicas - Teste André Braga para Sitcon</title>

        <!-- Bootstrap -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    </head>
    <body>
        <?php 
            include_once('db/Conexao.class.php');
            include_once('DAO/SolicitacaoDAO.php');
            $dao = new SolicitacaoDAO();
            $solicitacoes = $dao->listar();
        ?>
        <nav class="navbar navbar-expand-lg bg-primary">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav flex-row flex-wrap ms-md-auto me-md-5 my-md-2">
                        <li class="nav-item">
                            <a class="btn btn-outline-light me-4" href="pacientes.php">Pacientes</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            <div class="container mt-5">
                <div class="row">
                    <div class="table-responsive">
                        <table id="tableSolicitacoes" class="display w-100 table-striped lh-lg">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-center">Nome Paciente</th>
                                    <th class="text-center">CPF</th>
                                    <th class="text-center">Tipo Solicitação</th>
                                    <th class="text-center">Procedimento(s)</th>
                                    <th class="text-center">Data</th>
                                    <th class="text-center">Hora</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php 
                                    for ($i=0; $i < count($solicitacoes); $i++) { 
                                    $procedimentos = $dao->listarProcedimentosPorSolicitacao($solicitacoes[$i]['id']);
                                ?>
                                <tr>
                                    <td><?php echo $solicitacoes[$i]['nome']; ?></td>
                                    <td><?php echo $solicitacoes[$i]['CPF']; ?></td>
                                    <td><?php echo $solicitacoes[$i]['tipo']; ?></td>
                                    <td>
                                        <?php 
                                            for ($x=0; $x < count($procedimentos); $x++) { 
                                                echo $procedimentos[$x]['descricao']."<br>"; 
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $solicitacoes[$i]['dataf']; ?></td>
                                    <td><?php echo $solicitacoes[$i]['hora']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </body>
    <!-- JavaScript Bundle with Popper -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $('#tableSolicitacoes').DataTable({
            responsive: true,
            ordering: false,
            bLengthChange: false,
            info: false,
            oLanguage: {
                sSearch: ""
            },
            pagingType: 'numbers',
        });

        $('[type=search]').each(function () {
            $(this).attr("placeholder", "Pesquisar...");
            $(this).addClass("form-control-lg");
        });
    </script>
</html>