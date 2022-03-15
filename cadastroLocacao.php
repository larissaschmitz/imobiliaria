<!DOCTYPE html>

<?php
    include_once "acaoLocacao.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id);
}
    $title = "Cadastro de locações";
//var_dump($dados);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/favicon.ico">
</head>


<body>

<?php include 'navbarImobiliaria.php'?>


<div class="container-fluid">

        <center><h2>Imobiliária Ujj-Schmitz</h2></center><hr>

        <form method="post" action="acaoLocacao.php">
            <div class="form-group col-lg-3">
            <h3> Insira a locação</h3><hr>
                <label> ID </label>
                    <input readonly  type="text" name="id" id="id" class="form-control" value="<?php if ($acao == "editar") echo $dados['id']; else echo 0; ?>"><br>
                <label>Data de Entrada </label>
                    <input name="dataEntrada" id="dataEntrada" type="date" required="true" class="form-control" value="<?php if ($acao == "editar") echo $dados['dataEntrada']; ?>" placeholder="Digite a data de entrada"><br>
                <label>Data de Saída </label>
                    <input name="dataSaida" id="dataSaida" type="date" required="true" class="form-control" value="<?php if ($acao == "editar") echo $dados['dataSaida']; ?>" placeholder="Digite a data de saída"><br>
                    

                    <label>Valor </label>
                    <input name="valor" id="valor" type="text" required="true" class="form-control" value="<?php if ($acao == "editar") echo $dados['valor']; ?>" placeholder="Digite o tipo de imóvel"><br>
                
                
                    <label> Insira o locatario </label>
                <select name="locatario_id" id="locatario_id">
                <?php
                $pdo = Conexao::getInstance(); 
                
                $consulta = $pdo->query("SELECT id, nome FROM locatario");

                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   ?>

                <option value="<?php echo $linha['id'];?>"> <?php if ($acao == "editar") $dados['locatario_id']; ?> <?php echo $linha['nome'];?></option> 
            <?php } ?>
    </select> 

    <label> Insira o imóvel </label>
                <select name="imovel_id" id="imovel_id">
                <?php
                $pdo = Conexao::getInstance(); 
                
                $consulta = $pdo->query("SELECT id, tipo FROM imovel");

                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   ?>

                <option value="<?php echo $linha['id'];?>"> <?php if ($acao == "editar") echo $dados['imovel_id']; ?>  <?php echo $linha['tipo'];?></option> 
            <?php } ?>
    </select>

<br><br>
    <button name="acao" value="salvar" id="acao" type="submit" class="btn btn-info">
                     Adicionar endereço
                </button>
<br><br>

                </div>
           
    </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>