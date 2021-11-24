<?php
    /*
        Data:29.09.21
        Objetivo: Arquivo responsável por receber o id do Cliente e encaminhar para a função que irá excluir o dado.   
        Autor: Juliana Oliveira
    */

    //Import do arquivo de configuração de variaveis e constantes 
    require_once('../functions/config.php');
    //Import do aquivo para inserir no banco
    require_once(SRC . 'bd/excluirCliente.php');

    //O id está sendo encaminhado pela index, no link que foi realizado na imagem do excluir 
    $idCliente = $_GET['id'];
    // O noime da foto foi enviado pela indexn link do excluir
    $nomeFoto = $_GET['foto'];


    //Chama a função excluir e encaminha o id que será removido do BD
    if(excluir($idCliente)){
        // Apaga a foto que está na pasta dos arquivos no upload
        unlink(SRC.NOME_DIRETORIO_FILE.$nomeFoto);
        echo(BD_MSG_EXCLUIR);
    }
        
    else
        echo('<script>alert('. BD_MSG_ERRO.');window.history.back();</script>');

?>