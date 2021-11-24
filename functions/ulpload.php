<?php
    /*
        Data: 03.11.21
        Objetivo: Arquivo para fazer upload de Imagens
        Autor: Juliana Oliveira
    */

    // Função para fazer upload de arquivos
    function uploadFile($arrayFile){
        
        $fotoFile = $arrayFile;
        $tamanhoOriginal = (int) 0;
        $tamanhoKB = (int) 0;
        $extensao = (string) null;
        $tipoArquivo = (string) null;
        $nomeArquivo = (string) null;
        $nomeArquivoCript = (string) null;
        $arquivoTemp = (string) null;
        $foto = (string) null;

        // Valida se o arquivo existe no array
        if($fotoFile['size'] > 0 && $fotoFile['type'] != ""){
            
            // Recebe o tamnho original do arquivo em byte
            $tamanhoOriginal = $fotoFile['size'];
            
            // Converte o tamanho original em KBytes 
            $tamanhoKB = $tamanhoOriginal / 1024;

            // Recebe o tipo original do arquivo
            $tipoArquivo = $fotoFile['type'];

            // Valida se o tamanho do arquivo é  menor do que o permitido
            if($tamanhoKB <= TAMANHO_FILE){

                //Validação para percorrer o array de extensões permitidas buscando a extensão do arquivo atual, se encontrar retorna true 
                if(in_array($tipoArquivo, EXTENSOES_PERMITIDAS)){

                    //Permite extrair apenas o nome de um arquivo sem a extensão
                    $nomeArquivo = pathinfo($fotoFile['name'], PATHINFO_FILENAME);
                    //Permite extrair apenas a extensão de um arquivo sem o nome
                    $extensao = pathinfo($fotoFile['name'], PATHINFO_EXTENSION);

                    // uniqid - gera uma sequência numérica com base nas configurações de hardware da máquina. time(): pega a hora, minuto e sugundo atuais.
                    $nomeArquivoCript = md5($nomeArquivo . uniqid(time()));

                    // Conta o novo nome do arquivo com a extensão 
                    $foto = $nomeArquivoCript.".".$extensao;

                    // Recebe o nome do arquivo temporário que foi gerado quando o apache recebeu o arquivo do form
                    $arquivoTemp = $fotoFile['tmp_name'];

                    //  Move o arquivo da pasta temporária do apache para a pasta do servidor que foi criada
                    if(move_uploaded_file($arquivoTemp, SRC.NOME_DIRETORIO_FILE.$foto)){
                        return $foto;
                    }else{
                        echo('ERRO Upload do arquivo');
                    }
                    
                }else{
                    echo('ERRO Tipo de arquivo');
                }
            }else{
                echo('ERRO Tamanho do arquivo');
            }
        }

        // die; // Serve para parar a execução do código do apache
        
        /*
            Algoritmos de Criptografia no PHP
                hash('sha256', 'variavel')
                sha1('variavel')
                md5('variavel')
        */
    }
?>