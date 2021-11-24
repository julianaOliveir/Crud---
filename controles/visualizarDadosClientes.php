<?php
    /*
        Data: 21.10.21
        Objetivo: Arquivo responsável por buscar um registro para exibir na Modal do visualizar.   
        Autor: Juliana Oliveira
    */

    function visualizarCliente($id){
        //Import do arquivo de configuração de variaveis e constantes 
        require_once('functions/config.php');
        //Import do aquivo para excluir no banco
        require_once(SRC . 'bd/listarClientes.php');

        //Recebe o id enviado como argumento na função
        $idCliente = $id;

        //Chama a função para buscar de id do cliente
        $dadosCliente = buscar($idCliente);

        //Converte o resultado do BD em um array através mysli_fetch_assoc
        if($rsCliente = mysqli_fetch_assoc($dadosCliente)){
            return $rsCliente;
        }else{
            return false;
        }
    }
?>