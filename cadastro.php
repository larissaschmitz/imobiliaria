<!DOCTYPE html>

<?php
    include_once "acao.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id);
}
    $title = "Cadastro de endereços";
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

<center><h2>Imobiliária Ujj-Schmitz</h2></center>
        <hr>
        
        <form method="post" action="acao.php">
            <div class="form-group col-lg-3">
            <h3> Insira seu endereço</h3><hr>
                <label> ID </label>
                    <input readonly  type="text" name="id" id="id" class="form-control" value="<?php if ($acao == "editar") echo $dados['id']; else echo 0; ?>"><br>
                <label>Estado </label>
                    <input name="estado" id="estado" type="text" required="true" class="form-control" value="<?php if ($acao == "editar") echo $dados['estado']; ?>" placeholder="Digite a sigla do estado"><br>
                <label>Cidade </label>
                    <input name="cidade" id="cidade" type="text" required="true" class="form-control" value="<?php if ($acao == "editar") echo $dados['cidade']; ?>" placeholder="Digite a cidade"><br>
                <label>Bairro </label>
                    <input name="bairro" id="bairro" type="text" required="true" class="form-control" value="<?php if ($acao == "editar") echo $dados['bairro']; ?>" placeholder="Digite o bairro"><br>
                <label>Rua </label>
                    <input name="rua" id="rua" type="text" required="true" class="form-control" value="<?php if ($acao == "editar") echo $dados['rua']; ?>" placeholder="Digite a rua"><br>
                <label>Número </label>
                    <input name="numero" id="numero" type="number" required="true" class="form-control" value="<?php if ($acao == "editar") echo $dados['numero']; ?>" placeholder="Digite o número"><br>      
                    <button name="acao" value="salvar" id="acao" type="submit" class="btn btn-info">
                     Adicionar endereço
                </button>
<br><br>
                <a href="https://www.todamateria.com.br/siglas-estados-brasileiros/" target="_blank">Caso não saiba a sigla do estado, clique aqui</a>
                </div>
           
    </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>