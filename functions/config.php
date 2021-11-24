<?php
    /*
        Data: 15.09.2021
        Objetivo: Arquivo de configuração de variaveis e constantes que serão utilizadas no sistema
        Autor: Juliana Olievira 
    */

    // Variaveis e constantes para conexão com o Banco de Dados MySQL
    const BD_SERVER = 'localhost';
    const BD_USER = 'root';
    const BD_PASSWORD = 'bcd127';
    const BD_DATABASE = 'db_contatos20212t';

    //Erros do sistema 
    const ERRO_CONEXAO_BD = "Não foi possível realizar a conexão com o Banco de Dados, entre em contato com o Administrador do Sistema";
    const ERRO_CAIXA_VAZIA = "Não foi possível realizar a operação pois existem campos obrigatórios a serem preenchidos";
    const ERRO_MAXLENGHT = "Não foi possível realizar a operação pois a quantidade de caracteres ultrapassa o permitido";
    
    //Mensagens de aceitação e validação de dados no BD 
    const BD_MSG_INSERIR = "Registro salvo com sucesso no banco de dados!";
    const BD_MSG_ERRO = "erro: não foi possível manipular os dados no banco de dados";
    const BD_MSG_EXCLUIR = "<script> alert('Registro deletado com sucesso do Banco de Dados'); window.location.href='../index.php';</script>";
    const BD_MSG_EDITAR = "Registro atualizado com sucesso no banco de dados!";

    // Para Upload de arquivos
    const TAMANHO_FILE = "5120";
    define ('NOME_DIRETORIO_FILE',  'arquivos/');
    $extensoesPermitidasFile = array ("image/png", "image/jpg", "image/jpeg");
    define('EXTENSOES_PERMITIDAS', $extensoesPermitidasFile);

    //Constante para indicar a pasta raiz do servidor. Estrutura de diretório até meu projeto
    define('SRC' , $_SERVER ['DOCUMENT_ROOT'] . '/ds2t20212/juliana/Aulas/crud/');
?>