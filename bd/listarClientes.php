<?php
    /*
        Data:23.09.21
        Objetivo: Listar todos os dados de Clientes do Banco de Dados
        Autor: Juliana Oliveira
    */

    //Import do arquivo de conexao com o Banco
    require_once(SRC . 'bd/conexaoMysql.php');

    //Lista todos os regristros existentes no banco
    function listar(){
        $sql = "select tblcliente.*, tblEstado.sigla from tblcliente
            inner join tblEstado on tblEstado.idEstado = tblcliente.idEstado order by idcliente desc";

        //Abre a conexao com BD
        $conexao = conexaoMysql();

        //Solicita ao BD a execução do script SQL
        $select = mysqli_query($conexao, $sql);
    
        return $select;
    }

    //Retorna apenas um registro, com base no id
    function buscar($idCliente){
        $sql = "select tblcliente.*, tblEstado.sigla from tblcliente
            inner join tblEstado on tblEstado.idEstado = tblcliente.idEstado where tblcliente.idcliente = " . $idCliente;

        //Abre a conexao com BD
        $conexao = conexaoMysql();

        //Solicita ao BD a execução do script SQL
        $select = mysqli_query($conexao, $sql);
    
        return $select;
    }

?>