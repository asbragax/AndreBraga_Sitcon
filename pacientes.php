
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Listagem de pacientes - Teste André Braga para Sitcon</title>

        <!-- CSS only -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <!-- <link href="assets/css/custom.css" rel="stylesheet"> -->

    </head>
    <body>
        <?php 
            include_once('db/Conexao.class.php');
            include_once('DAO/PacienteDAO.php');
            $dao = new PacienteDAO();
            $pacientes = $dao->listarAtivos();
        ?>
        <nav class="navbar navbar-expand-lg bg-primary">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav flex-row flex-wrap ms-md-auto me-md-5 my-md-2">
                        <li class="nav-item">
                            <a class="btn btn-outline-light me-4" href="nova_solicitacao.php">Solicitações Clínicas</a>
                        </li>
                        <li class="nav-item float-end">
                            <a class="btn btn-outline-light" href="solicitacoes.php">Listagem de Solicitações</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            <div class="container mt-5">
                <div class="row">
                    <div class="table-responsive">
                        <table id="tablePacientes" class="display w-100 table-striped lh-lg">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-center">Paciente</th>
                                    <th class="text-center">CPF</th>
                                    <th class="text-center">Data Nascimento</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php for ($i=0; $i < count($pacientes); $i++) { ?>
                                <tr>
                                    <td><?php echo $pacientes[$i]['nome']; ?></td>
                                    <td><?php echo $pacientes[$i]['CPF']; ?></td>
                                    <td><?php echo $pacientes[$i]['dataNascF']; ?></td>
                                    <td>
                                        <a class="btn btn-warning btn-sm" href="nova_solicitacao.php?id=<?php echo $pacientes[$i]['id']; ?>">Prosseguir</a>
                                    </td>
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
        $(document).ready(function () {
            
            $('#tablePacientes').DataTable({
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
        });
    </script>
</html>