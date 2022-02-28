<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $title = "Consulta de Endereços";
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
   $busca = isset($_POST['busca']) ? $_POST['busca'] : 1;
?>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="img\favicon.ico">
    
    <script>
        function excluirRegistro(url){
            if (confirm("Confirma Exclusão?"))
                location.href = url;
        }
    </script>

</head>
<body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <div class="navbar-nav">
                                <a class="navbar-brand" href="index.php">Consulta de Endereços</a>
                                <a class="navbar-brand" href="cadastro.php">Cadastro de Endereços</a>
                            </div>   
                    </nav>
        <br><br>

        
        <div class="container-fluid">    
            <form method="post">
                <fieldset>
                <legend>Procurar Endereço</legend>

                <input type="text"   name="procurar" id="procurar" size="37" value="<?php echo $procurar;?>">
                <input type="submit" name="acao"     id="acao">
                <br><br>
            
            <table class="table table-hover">
            <tr><td><b>ID</b></td>
                <td><b>Estado</b></td>
                <td><b>Cidade</b></td>
                <td><b>Bairro</b></td>
                <td><b>Rua</td></b>
                <td><b>Número</b></td>
                <td><b>Detalhes</b></td>
                <td><b>Editar</b></td>
                <td><b>Excluir</b></td>
            </tr> 

            
        <fieldset>Ordernar e pesquisar por:<br>
            <form method="post" action="">
                    <input type="radio" name="busca" value="1" <?php if ($busca == "1") echo "checked" ?>>Id<br>
                    <input type="radio" name="busca" value="2" <?php if ($busca == "2") echo "checked" ?>>Estado<br>
                    <input type="radio" name="busca" value="3" <?php if ($busca == "3") echo "checked" ?>>Cidade<br>
        </fieldset>
    </form>



    <?php
        $pdo = Conexao::getInstance(); 

        if($busca == 1){
        $consulta = $pdo->query("SELECT * FROM endereco 
                                WHERE id LIKE '$procurar%' 
                                ORDER BY id");}

        else if($busca == 2){
        $consulta = $pdo->query("SELECT * FROM endereco 
                            WHERE estado LIKE '$procurar%' 
                            ORDER BY estado");}

        else if($busca == 3){
        $consulta = $pdo->query("SELECT * FROM endereco 
                                WHERE cidade LIKE '$procurar%' 
                                ORDER BY cidade");}


    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   


        ?>
        <tr><td><?php echo $linha['id'];?></td>
            <td><?php echo $linha['estado'];?></td>
            <td><?php echo $linha['cidade'];?></td>
            <td><?php echo $linha['bairro'];?></td>
            <td><?php echo $linha['rua'];?></td>
            <td><?php echo $linha['numero'];?></td>
            <td><a href='show.php?id=<?php echo $linha['id'];?>'> <img class="icon" src="img/show.png" alt=""> </a></td>
            <td><a href='cadastro.php?acao=editar&id=<?php echo $linha['id'];?>'><img class="icon" src="img/edit.png" alt=""></a></td>
            <td><?php echo " <a href=javascript:excluirRegistro('acao.php?acao=excluir&id={$linha['id']}')>Excluir endereço</a><br>"; ?></td>
        
        </tr>
    <?php } ?>       
    </table>
    </fieldset>
    </form>
            </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
