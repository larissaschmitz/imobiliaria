<!DOCTYPE html>
<?php 
     include_once "conf/default.inc.php";
     require_once "conf/Conexao.php";
     $title = "Lista de Endereços";
     $id = isset($_GET['id']) ? $_GET['id'] : "1";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title   >
    <link rel="stylesheet" href="css\estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/favicon.ico">

</head>
<body>

        <nav class="navbar navbar-dark bg-dark">>
            <div class="navbar-nav">
                <a class="navbar-brand" href="index.php"><img class="icon" src="img/seta-direita.png" alt="" width="50" height="50"></a>
            </div>   
        </nav>
        <br>
        <div class="container-fluid">
<?php
   
    $sql = "SELECT * FROM endereco WHERE id = $id";
   
    $pdo = Conexao::getInstance(); 
    $consulta = $pdo->query($sql);
    while ($linha = $consulta->fetch(PDO::FETCH_BOTH)){
        echo "<div class='shadow-lg p-3 mb-5 bg-body rounded'>Seguindo o padrão dos correios, o endereço de número {$linha['id']} é: <br>
        {$linha['rua']}, {$linha['numero']} <br>
        {$linha['bairro']}, <br>
        {$linha['cidade']}, {$linha['estado']}</div>";
    }
?>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>