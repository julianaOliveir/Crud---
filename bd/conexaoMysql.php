<?php
/*
    Data: 15.09.2021
    Objetivo : Arquivo para configurar a conexão com o Bando de Dados MySQL
    Autor: Juliana Oliveira 
*/
    // Abre a conexao com a base de dados MySQL 
    function conexaoMysql(){

        // require_once('../functions/config.php');

        // Declaração de variaveis para conexão com o Banco de Dados
        $server = (string) BD_SERVER;
        $user = (string) BD_USER;
        $password = (string) BD_PASSWORD;
        $database = (string) BD_DATABASE;

        if($conexao = mysqli_connect($server, $user, $password, $database))
            return $conexao; 
        else{
            echo(ERRO_CONEXAO_BD);
            return false;
        }
    }

    
    /*
        Formas de criar a conexão com o Banco de Dados 
            mysql_connect();
            mysqli_connect();
            PDO();
    */
?>

