<?php
    /*
        Data:06.10.21
        Objetivo: Arquivo responsável por receber o id do Cliente e encaminhar para a função irá buscar o dado.   
        Autor: Juliana Oliveira
    */

    //Import do arquivo de configuração de variaveis e constantes 
    require_once('../functions/config.php');
    //Import do aquivo para excluir no banco
    require_once(SRC . 'bd/listarClientes.php');

    //O id está sendo encaminhado pela index, no link que foi realizado na imagem do excluir 
    $idCliente = $_GET['id'];

    //Chama a função para buscar de id do cliente
    $dadosCliente = buscar($idCliente);

    if($rsCliente = mysqli_fetch_assoc($dadosCliente)){
        //Ativa a utilização de variaveis de sessão (são variaveis) globais 
        session_start();

        //Criamos uma variavel e sessão para guardar o array com os dados do cliente que retornou do BD
        $_SESSION['cliente'] = $rsCliente;

        //Permite chamar um arquivo como se fosse um link, através do php
        header('location:../index.php');
         
    }else
        // echo('<script>alert('. BD_MSG_ERRO.');window.history.back();</script>');

?>