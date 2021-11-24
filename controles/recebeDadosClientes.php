<?php
    /*
        Data: 15.09.2021
        Objetivo: Arquivo responsável por receber dados, tratar os dados e validar os dados de clientes
        Autor: Juliana Oliveira 
    */

    //Import do arquivo de configuração de variaveis e constantes 
    require_once('../functions/config.php');
    //Import do aquivo para inserir no banco
    require_once(SRC . 'bd/inserirCliente.php');

    require_once(SRC . 'bd/atualizarCliente.php');

    require_once(SRC. 'functions/ulpload.php');
    
    //Declaração de variáveis
    $nome = (string) null;
    $rg = (string) null;
    $cpf = (string) null;
    $telefone = (string) null;
    $celular = (string) null;
    $email = (string) null;
    $obs = (string) null;
    $idEstado = (string) null;

    // Variavel criada para guardar o nome da foto
    $foto = (string) null;

    //Validação para saber se o id do registro está chegando pela URL (modo para "Atualizar" um registro)
    if(isset($_GET['id']))
        //Será utilizado somente para o editar
        $id = (int) $_GET['id'];
    else
        $id = (int) 0;

    //($_SERVER['REQUEST_METHOD'] - Verifica qual o tipo de requisição é encaminhada pelo form(GET / POST)
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        //Recebe os dados encaminhados pelo formulário atráves do método post
        $nome = $_POST ['txtNome'];
        $rg = $_POST ['txtRg'];
        $cpf = $_POST ['txtCpf']; 
        $telefone = $_POST ['txtTelefone'];
        $celular = $_POST ['txtCelular'];
        $email = $_POST ['txtEmail'];
        $obs = $_POST ['txtObs'];
        $idEstado = $_POST ['sltEstado'];
        // Esse nome está chegando através do action do form da index, o motivo dessa variavel é para concluir o editar com o upload de foto
        $nomeFoto = $_GET ['nomefoto'];

        if(strtoupper($_GET['modo']) == 'ATUALIZAR'){
            
            if($_FILES['fleFoto'] ['name'] != ""){
                // Chama a função que faz o upload de um arquivo
                $foto = uploadFile($_FILES['fleFoto']);
                // Apaga a imagem antiga
                unlink(SRC.NOME_DIRETORIO_FILE.$nomeFoto);
            }else{
                $foto = $nomeFoto;
            }
        // Caso a variavel modo seja SALVAR, então será obrigatório o upload da foto
        }else{
            $foto = uploadFile($_FILES['fleFoto']);
        }
            
        //Validação de campos obrigatório
        if($nome == null || $rg == null || $cpf == null){
            echo("<script> alert ('". ERRO_CAIXA_VAZIA ."'); window.history.back(); </script>");
            //strlen() retorna a quantidade de caracteres de uma variavel
        }elseif (strlen ($nome) > 100 || strlen($rg) > 15 || strlen($cpf) > 20){
            echo("<script> alert ('". ERRO_MAXLENGHT ."'); window.history.back(); </script>");
        }else{

            //Local para enviar os dados para o Banco
            //Criação de um array para encaminhar a função de inserir 
            $cliente = array (
                "nome" => $nome,
                "rg" => $rg,
                "cpf" => $cpf,
                "telefone" => $telefone,
                "celular" => $celular,
                "email" => $email,
                "obs" => $obs,
                "id" => $id,
                "idEstado" => $idEstado,
                "foto" => $foto
            );

            //Validação para saber se é para inserir no registro ou se é para atualizar um registro existente no banco de dados 
            if(strtoupper($_GET['modo']) == 'SALVAR'){

                //Chamada da função inserir do arquivo inserirCliente.php. Encaminha o array com os dados do cliente para o banco.
                if(inserir($cliente))
                    echo("<script> alert ('". BD_MSG_INSERIR ."'); window.location.href = '../index.php' </script>");
                else
                    echo("<script> alert ('". BD_MSG_ERRO ."'); window.history.back(); </script>");

            }elseif(strtoupper($_GET['modo']) == 'ATUALIZAR'){
                if(editar($cliente))
                    echo("<script> alert ('". BD_MSG_EDITAR ."'); window.location.href = '../index.php' </script>");
                else
                    echo("<script> alert ('". BD_MSG_ERRO ."'); window.history.back(); </script>");
            }
        }
    } 
?>