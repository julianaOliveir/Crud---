<?php

    // Import para o start do slim php
    require_once('vendor/autoload.php');

    // Instancia da classe Slim\App, é realizada para termos acesso aos metódos da classe
    $app = new \Slim\App();

    // EndPoint : get, retorna todos os dados de clientes
    $app -> get('/clientes', function($request, $response, $args){

        // Import do arquivo que solicita das requisições de busca no banco de dados
        require_once('../controles/exibeDadosClientes.php');

        // Chama a função (na pasta controles) que vai requisitar os dados no banco de dados  
        if($listDados = exibirClientes())
            if($listDadosArray = criarArray($listDados))
                $listDadosJSON = criarJSON($listDadosArray);
        return $response -> withStatus(200)
                         -> withHeader('Content-Type', 'application/json')
                         -> write($listDadosJSON);
    });

    // EndPoint : post, envia um novo cliente para o banco de dados
    $app -> post('/clientes', function($request, $response, $args){
        return $response -> withStatus(201)
                         -> withHeader('Content-Type', 'application/json')
                         -> write('{"message":"Item criado com sucesso"}');
    });

    // EndPoint : put, atualiza um novo cliente no banco de dados 
    $app -> put('/clientes', function($request, $response, $args){
        return $response -> withStatus(201)
                         -> withHeader('Content-Type', 'application/json')
                         -> write('{"message":"Item atualizado com sucesso"}');
    });

    // EndPoint : delete, exclui um cliente do banco de dados 
    $app -> delete('/clientes', function($request, $response, $args){
        return $response -> withStatus(200)
                         -> withHeader('Content-Type', 'application/json')
                         -> write('{"message":"Item deletado com sucesso"}');
    });

    // Carrega todos os EndPoint para execução
    $app -> run();

    // EndPoint - É um ponto de aparada da API, ou seja serão as formas de requisição que a API irá responder

    // request - será usado para pegar algo que vai ser enviado para a API
    // response - será uitlizado para quando a API irá devolver algo, seja uma mensagem, status, body, header, etc 
    //args - serão os argumentos que podem ser encaminhados para a API
?>