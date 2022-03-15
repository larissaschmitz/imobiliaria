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
        $stmt = $pdo->prepare('INSERT INTO imovel_has_locador (imovel_id, locador_id) VALUES(:imovel_id, :locador_id)');
        
        $stmt->bindParam(':imovel_id', $imovel_id, PDO::PARAM_STR);
        $imovel_id = $_POST['imovel_id'];

        $stmt->bindParam(':locador_id', $locador_id, PDO::PARAM_STR);
        $locador_id = $_POST['locador_id'];


        $stmt->execute();
        header("location:indexImovel_locador.php");
    }


    // Aqui ocorre a alteração dos dados
    function editar($id){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE imovel_has_locador SET locador_id = :locador_id, imovel_id = :imovel_id WHERE id = :id');
                
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $id = $_POST['id'];

        $stmt->bindParam(':locador_id', $locador_id, PDO::PARAM_STR);
        $locador_id = $_POST['locador_id'];
        
        $stmt->bindParam(':imovel_id', $imovel_id, PDO::PARAM_STR);
        $imovel_id = $_POST['imovel_id'];

        $stmt->execute();
        header("location:indexImovel_locador.php");
    }


    //Aqui ocorre a exclusão dos dados
    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo ->prepare('DELETE FROM imovel_has_locador WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("location:indexImovel_locador.php");
    }


    // Aqui ocorre a busca de algum item no banco de dados
    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM imovel_has_locador WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id'] = $linha['id'];
            $dados['locador_id'] = $linha['locador_id'];
            $dados['imovel_id'] = $linha['imovel_id'];
           
        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no formulario
    function dadosForm(){
        $dados = array();
        $dados['id'] = $linha['id'];
        $dados['locador_id'] = $linha['locador_id'];
        $dados['imovel_id'] = $linha['imovel_id'];
        return $dados;

        
    } 

?>