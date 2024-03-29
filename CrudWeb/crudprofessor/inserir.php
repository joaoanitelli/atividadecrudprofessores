<?php

  require_once("config.php");

  function inserirProfessores($nome, $formacao, $telefone, $email, $aluno){
    global $pdo;
    $sql = "INSERT INTO professores (nome, formacao, telefone, email, aluno_id) VALUES (:nome, :formacao, :telefone, :email, :aluno_id)";
    $stm = $pdo->prepare($sql);
    $stm->bindParam(":aluno_id", $aluno_id, PDO::PARAM_INT);
    $stm->bindParam(":nome", $nome);
    $stm->bindParam(":formacao", $formacao);
    $stm->bindParam(":telefone", $telefone);
    $stm->bindParam(":email", $email);
    $stm->bindParam(":aluno_id", $aluno, PDO::PARAM_INT);
    $stm->execute();
    header("Location: index.php?inserir=ok");
    exit();
}

if($_POST){
  if(isset($_POST['nome']) && isset($_POST['formacao']) && isset($_POST['telefone']) && isset($_POST['email']) && isset($_POST['aluno'])){
      $idAlunoSelecionado = $_POST['aluno'];
      inserirProfessores($_POST['nome'], $_POST['formacao'], $_POST['telefone'], $_POST['email'], $idAlunoSelecionado);
  }
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body class="container">
    <h3>Inserir Aluno</h3>
    <form action="inserir.php" method="POST">
      <div class="row">
        <div class="col-7">
          <label for="nome" class="form-label">Informe o nome:</label>
          <input type="text" id="nome" name="nome" class="form-control" required/>
        </div>
        <div class="col-5">
          <label for="formacao" class="form-label">Informe a Formação:</label>
          <input type="text" id="formacao" name="formacao" class="form-control" required/>
        </div>
        <div class="col-5">
          <label for="telefone" class="form-label">Informe o telefone:</label>
          <input type="text" id="telefone" name="telefone" class="form-control" required/>
        </div>
        <div class="col-5">
          <label for="email" class="form-label">Informe o email:</label>
          <input type="text" id="email" name="email" class="form-control" required/>
        </div>
        <div class="col-5">
          <label for="aluno" class="form-label">Selecione o aluno:</label>
          <select id="aluno" name="aluno" class="form-select" required>
              <option value="" disabled selected>Escolha um aluno</option>
              <?php
                  $queryAlunos = "SELECT id, nome FROM aluno";
                  $resultAlunos = $pdo->query($queryAlunos);

                  while ($aluno = $resultAlunos->fetch(PDO::FETCH_ASSOC)) {
                      echo '<option value="' . $aluno['id'] . '">' . $aluno['nome'] . '</option>';
                  }
              ?>
          </select>
      </div>
      </div>
      <div class="row">
        <div class="col">
          <button class="btn btn-primary" type="submit">Salvar Dados</button>
        </div>
      </div>
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>