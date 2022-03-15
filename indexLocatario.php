<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $title = "Consulta de Locatarios";
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
                    <h3>Procurar Usuário</h3>
                    <input type="text" name="procurar" id="procurar" size="50" class="form-control" placeholder="Insira o que deseja consultar"
                value="<?php echo $procurar;?>"> <br>
                <button name="acao" id="acao" type="submit"  class="btn btn-info">Procurar</button>

<br><br>

        <fieldset>Ordernar e pesquisar por:<br>
            <form method="post" action="">
                    <input type="radio" name="busca" value="1" class="form-check-input" <?php if ($busca == "1") echo "checked" ?>> Id<br>
                    <input type="radio" name="busca" value="2" class="form-check-input" <?php if ($busca == "2") echo "checked" ?>> Nome<br>
                    <input type="radio" name="busca" value="3" class="form-check-input" <?php if ($busca == "3") echo "checked" ?>> Email<br>
        </fieldset>

        </div>
                <br><br>
    </form>

    <table class="table table-hover">
            <tr><td><b>ID</b></td>
                <td><b>Nome</b></td>
                <td><b>Data de Nascimento</b></td>
                <td><b>Idade</b></td>
                <td><b>Email</b></td>
                <td><b>Senha</td></b>
                <td><b>Estado</b></td>
                <td><b>Editar</b></td>
                <td><b>Excluir</b></td>
            </tr> 


    <?php
        $pdo = Conexao::getInstance(); 

        if($busca == 1){
        $consulta = $pdo->query("SELECT * FROM endereco, locatario
                                WHERE locatario.id LIKE '$procurar%' 
                                AND locatario.endereco_id = endereco.id
                                ORDER BY locatario.id");}


        else if($busca == 2){
        $consulta = $pdo->query("SELECT * FROM endereco, locatario
                                WHERE locatario.nome LIKE '$procurar%' 
                                AND locatario.endereco_id = endereco.id
                                ORDER BY locatario.nome");}

        else if($busca == 3){
        $consulta = $pdo->query("SELECT * FROM endereco, locatario
                                WHERE locatario.email LIKE '$procurar%' 
                                AND locatario.endereco_id = endereco.id
                                ORDER BY locatario.email");}


    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   

        $hoje = date("Y"); 
        $uso = date("Y", strtotime($linha['dataNasc']));

        $idade = $hoje - $uso;

        

        ?>
        <tr><td><?php echo $linha['id'];?></td>
            <td><?php echo $linha['nome'];?></td>
            <td><?php echo date("d/m/Y",strtotime($linha['dataNasc']));?></td>
            <td><?php echo $idade;?></td>
            <td><?php echo $linha['email'];?></td>
            <td><?php echo $linha['senha'];?></td>
            <td><?php echo $linha['estado'];?></td>
            <td><a href='cadastroLocatario.php?acao=editar&id=<?php echo $linha['id'];?>'> <img class="center" src="img/edit.png" alt=""></a></td>
            <td><?php echo " <a href=javascript:excluirRegistro('acaoLocatario.php?acao=excluir&id={$linha['id']}')>Excluir Usuário</a><br>"; ?></td>
        
        </tr>
    <?php } ?>       
    </table>
    </fieldset>
    </form>
            </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>