<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $title = "Consulta de Locações";
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

    <?php include 'navbarImobiliaria.php'?>
    
        <div class="container-fluid">   

        <center><h2>Imobiliária Ujj-Schmitz</h2></center><hr>
        
            <form method="post">
                <fieldset>
                    <div class="form-group col-lg-3">
                    <h3>Procurar Locação</h3>
                    <input type="text" name="procurar" id="procurar" size="50" class="form-control" placeholder="Insira o que deseja consultar"
                value="<?php echo $procurar;?>"> <br>
                <button name="acao" id="acao" type="submit"  class="btn btn-info">Procurar</button>

<br><br>

        <fieldset>Ordernar e pesquisar por:<br>
            <form method="post" action="">
                    <input type="radio" name="busca" value="1" class="form-check-input" <?php if ($busca == "1") echo "checked" ?>> Id<br>
        </fieldset>

        </div>
                <br><br>
    </form>

    <table class="table table-hover">
            <tr><td><b>ID</b></td>
                <td><b>Data de entrada</b></td>
                <td><b>Data de Saída</b></td>
                <td><b>Valor</b></td>
                <td><b>Nome do Locatario</td></b>
                <td><b>Tipo de imóvel</b></td>
                <td><b>Editar</b></td>
                <td><b>Excluir</b></td>
            </tr> 


    <?php
        $pdo = Conexao::getInstance(); 

        if($busca == 1){
        $consulta = $pdo->query("SELECT * FROM imovel, locatario, locacao
                                WHERE locacao.id LIKE '$procurar%' 
                                AND locacao.locatario_id = locatario.id
                                AND locacao.imovel_id = imovel.id
                                ORDER BY locacao.id");}

        

    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   


        ?>
        <tr><td><?php echo $linha['id'];?></td>
        <td><?php echo date("d/m/Y",strtotime($linha['dataEntrada']));?></td>
        <td><?php echo date("d/m/Y",strtotime($linha['dataSaida']));?></td>
            <td><?php echo $linha['valor'];?></td>
            <td><?php echo $linha['nome'];?></td>
            <td><?php echo $linha['tipo'];?></td>
            <td><a href='cadastroLocacao.php?acao=editar&id=<?php echo $linha['id'];?>'> <img class="center" src="img/edit.png" alt=""></a></td>
            <td><?php echo " <a href=javascript:excluirRegistro('acaoLocacao.php?acao=excluir&id={$linha['id']}')>Excluir locação</a><br>"; ?></td>
         
        </tr>   
    <?php } ?>       
    </table>
    </fieldset>
    </form>
            </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
