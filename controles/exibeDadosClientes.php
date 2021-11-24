<?php
    /*
        Data:23.09.21
        Objetivo: Buscar ou Listar todos os dados de Clientes, solicitando ao Banco de Dados
        Autor: Juliana Oliveira
    */

    //Import do arquivo para inserir no Banco
    require_once(SRC . '/bd/listarClientes.php');

    function exibirClientes(){
        //Chama a função que busca os dados no BD e recebe os registros de clientes
        
        $dados = listar();
        return $dados;
    }

    // Função para criar um array de dados com base no retorno do banco 
    function criarArray($objeto){

        $cont = (int) 0;

        // Estrutura de repetição para pegar um objeto de dados e converter em um array
        while($rsDados = mysqli_fetch_assoc($objeto)){
            $arrayDados[$cont] = array(
                "id" => $rsDados['idcliente'],
                "nome" => $rsDados['nome'],
                "foto" => $rsDados['foto'],
                "rg" => $rsDados['rg'],
                "cpf" => $rsDados['cpf'],
                "telefone" => $rsDados['telefone'],
                "celular" => $rsDados['celular'],
                "email" => $rsDados['email'],
                "obs" => $rsDados['obs'],
                "idEstado" => $rsDados['idEstado'],
                "sigla" => $rsDados['sigla']
            );

            $cont ++;
        }

        // Tratamento para validar se existe dados no banco de dados, senão houver o retorno deverá ser falso 
        if(isset($arrayDados)){
            return $arrayDados;
        }else{
            return false;
        }
    }

    // Função para gerar um JSON, com base em um array de dados 
    function criarJSON($arrayDados){
        // Especifica no cabeçalho do PHP que será gerado o JSON
        header("content-type:application/json");

        // Converte um array em JSON
        $listJSON = json_encode($arrayDados);

        if(isset($listJSON)){
            return $listJSON;
        }else{
            return false;
        }
    }

    // json_encode - converte um array em formato JSON
    // json_decode - converte um JSON em formato array
?>