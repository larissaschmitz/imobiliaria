<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        excluir($id);
    }

   
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        if ($id == 0)
            inserir($id);
        else
            editar($id);
    }

    // Aqui ocorre a adição de dados novos
    function inserir($id){
        $dados = dadosForm();
        //var_dump($dados);
        
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO endereco (estado, cidade, bairro, rua, numero) VALUES(:estado, :cidade, :bairro, :rua, :numero)');
        
         $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
         $estado = $_POST['estado'];
 
         $stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);
         $cidade = $_POST['cidade'];
 
         $stmt->bindParam(':bairro', $bairro, PDO::PARAM_STR);
         $bairro = $_POST['bairro'];

         $stmt->bindParam(':rua', $rua, PDO::PARAM_STR);
         $rua = $_POST['rua'];
 
         $stmt->bindParam(':numero', $numero, PDO::PARAM_STR);
         $numero = $_POST['numero'];

        $stmt->execute();
        header("location:index.php");

    }

    // Aqui ocorre a alteração dos dados
    function editar($id){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE endereco SET estado = :estado, cidade = :cidade, bairro = :bairro, rua = :rua, numero = :numero WHERE id = :id');
                
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $id = $_POST['id'];
        
        $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
        $estado = $_POST['estado'];

        $stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);
        $cidade = $_POST['cidade'];

        $stmt->bindParam(':bairro', $bairro, PDO::PARAM_STR);
        $bairro = $_POST['bairro'];

        $stmt->bindParam(':rua', $rua, PDO::PARAM_STR);
        $rua = $_POST['rua'];

        $stmt->bindParam(':numero', $numero, PDO::PARAM_STR);
        $numero = $_POST['numero'];

        $stmt->execute();
        header("location:index.php");
    }


    //Aqui ocorre a exclusão dos dados
    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo ->prepare('DELETE FROM endereco WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('location:index.php');
    }


    // Aqui ocorre a busca de algum item no banco de dados
    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM endereco WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id'] = $linha['id'];
            $dados['estado'] = $linha['estado'];
            $dados['cidade'] = $linha['cidade'];
            $dados['bairro'] = $linha['bairro'];
            $dados['rua'] = $linha['rua'];
            $dados['numero'] = $linha['numero'];

        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no formulario
    function dadosForm(){
        $dados = array();
        $dados['id'] = $linha['id'];
        $dados['estado'] = $linha['estado'];
        $dados['cidade'] = $linha['cidade'];
        $dados['bairro'] = $linha['bairro'];
        $dados['rua'] = $linha['rua'];
        $dados['numero'] = $linha['numero'];
        return $dados;
    }

?>