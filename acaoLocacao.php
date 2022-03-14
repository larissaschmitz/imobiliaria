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
        $stmt = $pdo->prepare('INSERT INTO locacao (dataEntrada, dataSaida, valor, locatario_id, imovel_id) VALUES(:dataEntrada, :dataSaida, :valor, :locatario_id, :imovel_id)');
        
        $stmt->bindParam(':dataEntrada', $dataEntrada, PDO::PARAM_STR);
        $dataEntrada = $_POST['dataEntrada'];

        $stmt->bindParam(':dataSaida', $dataSaida, PDO::PARAM_STR);
        $dataSaida = $_POST['dataSaida'];

        $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);
        $valor = $_POST['valor'];

        $stmt->bindParam(':locatario_id', $locatario_id, PDO::PARAM_STR);
        $locatario_id = $_POST['locatario_id'];
        
        $stmt->bindParam(':imovel_id', $imovel_id, PDO::PARAM_STR);
        $imovel_id = $_POST['imovel_id'];

        $stmt->execute();
        header("location:indexLocacao.php");
    }


    // Aqui ocorre a alteração dos dados
    function editar($id){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE locacao SET dataEntrada = :dataEntrada, dataSaida = :dataSaida, valor = :valor, locatario_id = :locatario_id, imovel_id = :imovel_id WHERE id = :id');
                
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $id = $_POST['id'];
        
        $stmt->bindParam(':dataEntrada', $dataEntrada, PDO::PARAM_STR);
        $dataEntrada = $_POST['dataEntrada'];

        $stmt->bindParam(':dataSaida', $dataSaida, PDO::PARAM_STR);
        $dataSaida = $_POST['dataSaida'];

        $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);
        $valor = $_POST['valor'];

        $stmt->bindParam(':locatario_id', $locatario_id, PDO::PARAM_STR);
        $locatario_id = $_POST['locatario_id'];
        
        $stmt->bindParam(':imovel_id', $imovel_id, PDO::PARAM_STR);
        $imovel_id = $_POST['imovel_id'];

        $stmt->execute();
        header("location:indexLocacao.php");
    }


    //Aqui ocorre a exclusão dos dados
    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo ->prepare('DELETE FROM locacao WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('location:indexLocacao.php');
    }


    // Aqui ocorre a busca de algum item no banco de dados
    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM locacao WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id'] = $linha['id'];
            $dados['dataEntrada'] = $linha['dataEntrada'];
            $dados['dataSaida'] = $linha['dataSaida'];
            $dados['valor'] = $linha['valor'];
            $dados['locatario_id'] = $linha['locatario_id'];
            $dados['imovel_id'] = $linha['imovel_id'];
           
        }
        var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no formulario
    function dadosForm(){
        $dados = array();
        $dados['id'] = $linha['id'];
        $dados['dataEntrada'] = $linha['dataEntrada'];
        $dados['dataSaida'] = $linha['dataSaida'];
        $dados['valor'] = $linha['valor'];
        $dados['locatario_id'] = $linha['locatario_id'];
        $dados['imovel_id'] = $linha['imovel_id'];
        return $dados;

        
    } 

?>