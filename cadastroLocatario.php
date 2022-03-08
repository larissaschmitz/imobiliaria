<!DOCTYPE html>

<?php
    include_once "acaoLocatario.php";
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

        <center><h2>Imobiliária Ujj-Schmitz</h2></center><hr>

        <form method="post" action="acaoLocatario.php">
            <div class="form-group col-lg-3">
            <h3> Insira seu user</h3><hr>
                <label> ID </label>
                    <input readonly  type="text" name="id" id="id" class="form-control" value="<?php if ($acao == "editar") echo $dados['id']; else echo 0; ?>"><br>
                <label>Nome Completo </label>
                    <input name="nome" id="nome" type="text" required="true" class="form-control" value="<?php if ($acao == "editar") echo $dados['nome']; ?>" placeholder="Digite seu nome"><br>
                <label>Data de Nascimento </label>
                    <input name="dataNasc" id="dataNasc" type="date" required="true" class="form-control" value="<?php if ($acao == "editar") echo $dados['dataNasc']; ?>" placeholder="Digite a data de nascimento"><br>
                <label>Email </label>
                    <input name="email" id="email" type="email" required="true" class="form-control" value="<?php if ($acao == "editar") echo $dados['email']; ?>" placeholder="Digite seu email"><br>
                <label>Senha </label>
                    <input name="senha" id="senha" type="password" required="true" class="form-control" value="<?php if ($acao == "editar") echo $dados['senha']; ?>" placeholder="Digite a senha"><br>
                
                
                
                <label> Insira o endereço </label>
                <select name="endereco_id" id="endereco_id">
           

                <?php
                $pdo = Conexao::getInstance(); 
                
                $consulta = $pdo->query("SELECT id, estado FROM endereco");

                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   ?>

                <option value="<?php echo $linha['id'];?>"> <?php echo $linha['estado'];?></option> 
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