<?php
     /*
        Data: 13.10.2021
        Objetivo: Atualizar dados de um cliente existente no Banco de Dados  
        Autor: Juliana Oliveira 
    */

    //Import do arquivo de conexão com o banco
    require_once('../bd/conexaoMysql.php');

    function editar($arrayClientes){
        $sql = "update tblcliente set 
            nome = '" . $arrayClientes['nome'] . "',
            rg = '" . $arrayClientes['rg'] . "',
            cpf = '" . $arrayClientes['cpf'] . "',
            telefone = '" . $arrayClientes['telefone'] . "',
            celular = '" . $arrayClientes['celular'] . "',
            email = '" . $arrayClientes['email'] . "',
            obs = '" . $arrayClientes['obs'] . "',
            foto = '". $arrayClientes['foto'] ."',
            idEstado = ".$arrayClientes['idEstado'] ."

            where idcliente = " . $arrayClientes['id'];

        //Chamando a função que estabelece a conexão com o banco    
        $conexao = conexaoMysql(); 
        //Envia o script SQL para o banco
        if(mysqli_query($conexao, $sql))
            return true; //Retorna verdadeiro se o registro for enserido no banco
        else
            return false; //Retorna false se houver algum problema o registro
            
    }
?>