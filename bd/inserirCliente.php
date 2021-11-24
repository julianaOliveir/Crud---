<?php
     /*
        Data: 16.09.2021
        Objetivo: Inserir dados do Cliente no Banco 
        Autor: Juliana Oliveira 
    */

    //Import do arquivo de conexão com o banco
    require_once('../bd/conexaoMysql.php');
    
    function inserir($arrayClientes){
        $sql = "insert into tblcliente(
                nome,
                rg,
                cpf,
                telefone,
                celular,
                email,
                obs,
                idEstado,
                foto
            )
            values(
                '". $arrayClientes['nome']."',
                '". $arrayClientes['rg']."',
                '". $arrayClientes['cpf']."',
                '". $arrayClientes['telefone']."',
                '". $arrayClientes['celular']."',
                '". $arrayClientes['email']."',
                '". $arrayClientes['obs']."',
                ". $arrayClientes['idEstado'].",
                '".$arrayClientes['foto']."'
        )";
        
        // echo($sql);
        //Chamando a função que estabelece a conexão com o banco    
        $conexao = conexaoMysql(); 
        //Envia o script SQL para o banco
        if(mysqli_query($conexao, $sql))
            return true; //Retorna verdadeiro se o registro for enserido no banco
        else
            return false; //Retorna false se houver algum problema o registro
    }
?>