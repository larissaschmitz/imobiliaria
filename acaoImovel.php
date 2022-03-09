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
        $stmt = $pdo->prepare('INSERT INTO imovel (tipo, quartos, banheiros, endereco) VALUES(:tipo, :quartos, :banheiros, :endereco)');
        
         $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
         $tipo = $_POST['tipo'];
 
         $stmt->bindParam(':quartos', $quartos, PDO::PARAM_STR);
         $quartos = $_POST['quartos'];
 
         $stmt->bindParam(':banheiros', $banheiros, PDO::PARAM_STR);
         $banheiros = $_POST['banheiros'];

         $stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);
         $endereco = $_POST['endereco'];

        $stmt->execute();
        header("location:indexImovel.php");

    }

    // Aqui ocorre a alteração dos dados
    function editar($id){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE imovel SET tipo = :tipo, quartos = :quartos, banheiros = :banheiros, endereco = :endereco WHERE id = :id');
                
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $id = $_POST['id'];
        
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $tipo = $_POST['tipo'];

        $stmt->bindParam(':quartos', $quartos, PDO::PARAM_STR);
        $quartos = $_POST['quartos'];

        $stmt->bindParam(':banheiros', $banheiros, PDO::PARAM_STR);
        $banheiros = $_POST['banheiros'];

        $stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);
        $endereco = $_POST['endereco'];

        $stmt->execute();
        header("location:indexImovel.php");
    }


    //Aqui ocorre a exclusão dos dados
    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo ->prepare('DELETE FROM imovel WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('location:indexImovel.php');
    }


    // Aqui ocorre a busca de algum item no banco de dados
    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM imovel WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id'] = $linha['id'];
            $dados['tipo'] = $linha['tipo'];
            $dados['quartos'] = $linha['quartos'];
            $dados['banheiros'] = $linha['banheiros'];
            $dados['endereco'] = $linha['endereco'];
        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no formulario
    function dadosForm(){
        $dados = array();
        $dados['id'] = $linha['id'];
        $dados['tipo'] = $linha['tipo'];
        $dados['quartos'] = $linha['quartos'];
        $dados['banheiros'] = $linha['banheiros'];
        $dados['endereco'] = $linha['endereco'];
        return $dados;

        
    }

?>