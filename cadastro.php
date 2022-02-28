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
    <title><?php echo   $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/favicon.ico">
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
        <h2> Insira seu endereço</h2>
        <form method="post" action="acao.php">
            <div class="form-group col-lg-3">
                <label> ID </label>
                    <input readonly  type="text" name="id" id="id" value="<?php if ($acao == "editar") echo $dados['id']; else echo 0; ?>"><br>
                <label>Estado </label>
                    <input name="estado" id="estado" type="text" class="form-control" value="<?php if ($acao == "editar") echo $dados['estado']; ?>" placeholder="Digite o estado"><br>
                <label>Cidade </label>
                    <input name="cidade" id="cidade" type="text" class="form-control" value="<?php if ($acao == "editar") echo $dados['cidade']; ?>" placeholder="Digite seu nome"><br>
                <label>Bairro </label>
                    <input name="bairro" id="bairro" type="text" class="form-control" value="<?php if ($acao == "editar") echo $dados['bairro']; ?>" placeholder="Digite seu nome"><br>
                <label>Rua </label>
                    <input name="rua" id="rua" type="text" class="form-control" value="<?php if ($acao == "editar") echo $dados['rua']; ?>" placeholder="Digite seu nome"><br>
                <label>Número </label>
                    <input name="numero" id="numero" type="number" class="form-control" value="<?php if ($acao == "editar") echo $dados['numero']; ?>" placeholder="Digite seu nome"><br>      
    </div>
                <button name="acao" value="salvar" id="acao" type="submit" class="btn btn-outline-success">
                     Adicionar endereço
                </button>
                
    </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>