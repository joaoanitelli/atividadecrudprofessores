<?php

    require_once("config.php");

    function consultarAlunos(){
        global $pdo;
        $sql = "SELECT * FROM aluno";
        $stm = $pdo->query($sql);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body class="container">
    <h3>Hello, world!</h3>

    <?php
        if(isset($_GET['inserir'])) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Registro inserido com sucesso!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php } ?>

    <?php
        if(isset($_GET['alterar'])) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Registro alterado com sucesso!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php } ?>

    <?php
        if(isset($_GET['excluir'])) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Registro excluído com sucesso!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php } ?>

    <a href="inserir.php" class="btn btn-info">Inserir novo Aluno</a>
    
    <table class="table table-info table-striped table-hover">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Curso</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
           <?php
                $dados = consultarAlunos();
                if($dados != null){
                    foreach ($dados as $d){
                        echo "<tr>
                                <td>{$d['nome']}</td>
                                <td>{$d['curso']}</td>
                                <td><a href='alterar.php?id={$d['id']}'>Alterar</a>
                                    <a href='excluir.php?id={$d['id']}'>Excluir</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Tabela vazia!</td></tr>";
                }
           ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>