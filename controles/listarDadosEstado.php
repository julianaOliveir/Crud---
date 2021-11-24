<?php
    /*
        Data:27.10.21
        Objetivo: Listar todos os dados Estados, solicitando ao Banco de Dados
        Autor: Juliana Oliveira
    */

    //Import do arquivo para inserir no Banco
    require_once(SRC . '/bd/listarEstados.php');

    function exibirEstados(){
        //Chama a função que busca os dados no BD e recebe os registros de estaods
        
        $dados = listarEstados();
        return $dados;
    }
?>