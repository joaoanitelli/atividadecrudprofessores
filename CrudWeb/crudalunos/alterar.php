<?php

  require_once("config.php");

  function alterarAluno($id, $nome, $curso){
    global $pdo;
    $sql = "
        UPDATE aluno set nome = :nome, curso = :curso
        WHERE id = :id
    ";
    $stm = $pdo->prepare($sql);
    $stm->bindParam(":nome", $nome);
    $stm->bindParam(":curso", $curso);
    $stm->bindParam(":id", $id);
    $stm->execute();
    header("Location: index.php?alterar=ok");
    exit();
  }

  function consultarPorId($id){
    global $pdo;
    $sql = "SELECT * FROM aluno where id = :id";
    $stm = $pdo->prepare($sql);
    $stm->bindParam(":id", $id);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
  }

  if($_POST){
    if(isset($_POST['nome']) && isset($_POST['curso'])){
      alterarAluno($_POST['id'],
                $_POST['nome'], $_POST['curso']);
    }
  } elseif (isset($_GET['id'])){
    $aluno = consultarPorId($_GET['id']);
  } else {
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
      <input type="hidden" name="id" value="<?=$_GET['id']?>"/>
      <div class="row">
        <div class="col-7">
          <label for="nome" class="form-label">Informe o nome:</label>
          <input value="<?=$aluno['nome']?>" type="text" id="nome" name="nome" class="form-control" required/>
        </div>
        <div class="col-5">
          <label for="curso" class="form-label">Informe o curso:</label>
          <input value="<?=$aluno['curso']?>" type="text" id="curso" name="curso" class="form-control" required/>
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