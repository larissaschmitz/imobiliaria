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
        $stmt = $pdo->prepare('INSERT INTO locatario (nome, dataNasc, email, senha, endereco_id) VALUES(:nome, :dataNasc, :email, :senha, :endereco_id)');
        
         $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
         $nome = $_POST['nome'];
 
         $stmt->bindParam(':dataNasc', $dataNasc, PDO::PARAM_STR);
         $dataNasc = $_POST['dataNasc'];
 
         $stmt->bindParam(':email', $email, PDO::PARAM_STR);
         $email = $_POST['email'];

         $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
         $senha = $_POST['senha'];
        
         $stmt->bindParam(':endereco_id', $endereco_id, PDO::PARAM_STR);
         $endereco_id = $_POST['endereco_id'];

        $stmt->execute();
        header("location:indexLocatario.php");

    }

    // Aqui ocorre a alteração dos dados
    function editar($id){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE locatario SET nome = :nome, dataNasc = :dataNasc, email = :email, senha = :senha, endereco_id = :endereco_id WHERE id = :id');
                
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $id = $_POST['id'];
        
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $nome = $_POST['nome'];

        $stmt->bindParam(':dataNasc', $dataNasc, PDO::PARAM_STR);
        $dataNasc = $_POST['dataNasc'];

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $email = $_POST['email'];

        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $senha = $_POST['senha'];
        
        $stmt->bindParam(':endereco_id', $endereco_id, PDO::PARAM_STR);
        $endereco_id = $_POST['endereco_id'];
        

        $stmt->execute(); 
        header("location:indexLocatario.php");
    }


    //Aqui ocorre a exclusão dos dados
    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo ->prepare('DELETE FROM locatario WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('location:indexLocatario.php');
    }


    // Aqui ocorre a busca de algum item no banco de dados
    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM locatario WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id'] = $linha['id'];
            $dados['nome'] = $linha['nome'];
            $dados['dataNasc'] = $linha['dataNasc'];
            $dados['email'] = $linha['email'];
            $dados['senha'] = $linha['senha'];
            $dados['endereco_id'] = $linha['endereco_id'];

        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no formulario
    function dadosForm(){
        $dados = array();
        $dados['id'] = $linha['id'];
        $dados['nome'] = $linha['nome'];
        $dados['dataNasc'] = $linha['dataNasc'];
        $dados['email'] = $linha['email'];
        $dados['senha'] = $linha['senha'];
        $dados['endereco_id'] = $linha['endereco_id'];
        return $dados;

        
    }

?>