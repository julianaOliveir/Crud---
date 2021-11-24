<?php
    /*
        Data:29.09.21
        Objetivo: Excluir dados de Cliente do Banco de Dados
        Autor: Juliana Oliveira
    */

    require_once('../bd/conexaoMysql.php');

    function excluir($idCliente){
        $sql = "delete from tblcliente where idcliente =" . $idCliente;
    
        //Chamando a função que estabelece a conexão com o banco    
        $conexao = conexaoMysql();
        
        if(mysqli_query($conexao, $sql)){
            return true;
        }else{
            return false;
        }
    }
?>