<?php

  require_once("config.php");

  function alterarProfessor($id,$nome, $formacao, $telefone, $email, $aluno){
    global $pdo;
    $sql = "
    UPDATE professores 
      SET 
        nome = :nome,
        formacao = :formacao,
        telefone = :telefone,
        email = :email,
        aluno_id = :aluno
        WHERE id = :id
    ";
    $stm = $pdo->prepare($sql);
    $stm->bindParam(":id", $id);
    $stm->bindParam(":nome", $nome);
    $stm->bindParam(":formacao", $formacao);
    $stm->bindParam(":telefone", $telefone);
    $stm->bindParam(":email", $email);
    $stm->bindParam(":aluno", $aluno);
    $stm->execute();
    header("Location: index.php?alterar=ok");
    exit();
  }

  function consultarPorId($id){
    global $pdo;
    $sql = "SELECT * FROM professores.professores where id = :id";
    $stm = $pdo->prepare($sql);
    $stm->bindParam(":id", $id);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
  }

  if($_POST){
    if(isset($_POST['nome']) && isset($_POST['formacao']) && isset($_POST['telefone'])  && isset($_POST['email'])  && isset($_POST['aluno'])){
      alterarProfessor($_POST['id'], $_POST['nome'], $_POST['formacao'], $_POST['telefone'], $_POST['email'], $_POST['aluno']);
    }
  } elseif (isset($_GET['id'])){
    $professor = consultarPorId($_GET['id']);
  }else {
    header("Location: index.php");
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
    <h3>Alterar Aluno</h3>
    <form action="alterar.php" method="POST">
      <div class="row">
        <div class="col-7">
          <label for="id" class="form-label">Id: </label>
          <input type="text" value="<?=$professor['id']?> " id="id" name="id" class="form-control" required/>
        </div>
        <div class="col-7">
          <label for="nome" class="form-label">Informe o nome:</label>
          <input type="text" value="<?=$professor['nome']?> " id="nome" name="nome" class="form-control" required/>
        </div>
        <div class="col-5">
          <label for="formacao" class="form-label">Informe a Formação:</label>
          <input type="text" value="<?=$professor['formacao']?>" id="formacao" name="formacao" class="form-control" required/>
        </div>
        <div class="col-5">
          <label for="telefone" class="form-label">Informe o telefone:</label>
          <input type="text" value="<?=$professor['telefone']?>" id="telefone" name="telefone" class="form-control" required/>
        </div>
        <div class="col-5">
          <label for="email" class="form-label">Informe o email:</label>
          <input type="text" value="<?=$professor['email']?>" id="email" name="email" class="form-control" required/>
        </div>
        <div class="col-5">
    <label for="aluno" class="form-label">Selecione o aluno:</label>
    <select id="aluno" name="aluno" class="form-select" required>
        <option value="" disabled selected>Escolha um aluno</option>
        <?php
            $queryAlunos = "SELECT id, nome FROM aluno";
            $resultAlunos = $pdo->query($queryAlunos);

            while ($aluno = $resultAlunos->fetch(PDO::FETCH_ASSOC)) {
                $selected = ($aluno['id'] == $professor['aluno_id']) ? 'selected' : '';
                echo '<option value="' . $aluno['id'] . '" ' . $selected . '>' . $aluno['nome'] . '</option>';
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