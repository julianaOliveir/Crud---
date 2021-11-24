<?php
    /*
        Data:27.10.21
        Objetivo: Listar todos os dados de Estados do Banco de Dados
        Autor: Juliana Oliveira
    */

    //Import do arquivo de conexao com o Banco
    require_once(SRC . 'bd/conexaoMysql.php');

    //Lista todos os regristros existentes no banco
    function listarEstados(){
        $sql = "select * from tblEstado order by nome";

        //Abre a conexao com BD
        $conexao = conexaoMysql();

        //Solicita ao BD a execução do script SQL
        $select = mysqli_query($conexao, $sql);
    
        return $select;
    }
?>    