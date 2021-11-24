<?php

    //Ativa a utilização de variaveis 
    session_start();

    //Declaração das variaveis para o formulário
    $nome = (string) null;
    $telefone = (string) null;
    $celular = (string) null;
    $rg = (string) null;
    $cpf = (string) null;
    $email = (string) null;
    $obs = (string) null;
    $foto = (string) "sem-foto.jpg";
    $id = (int) 0;

    // Variaveis para trazer os valores do Estado
    $idEstado = (int) null;
    $sigla = (string) "Selecione um item";

    //Essa variavel será utilizada para definir o modo de manipulação com o banco de dados.
    //Salvar será feito o insert Atualizar = será feito o update 
    $modo = (string) "Salvar";

    //Import do arquivo de configuração de variaveis e constantes
    require_once('functions/config.php');
    // require_once(SRC . 'bd/conexaoMysql.php');
    require_once(SRC . 'controles/exibeDadosClientes.php');
    // echo($_SERVER['DOCUMENT_ROOT']);
    
    //Import do arquivo que lista todos os Estados no Banco
    require_once(SRC . 'controles/listarDadosEstado.php');

    // Import do arquivo que faz upload de arquivos
    require_once(SRC . 'functions/ulpload.php');

    //Verifica a existencia da variavel de sessão que usamos para trazer os dados para o editar
   if(isset($_SESSION['cliente'])){
       $id = $_SESSION['cliente'] ['idcliente'];
       $nome = $_SESSION['cliente'] ['nome'];
       $rg = $_SESSION['cliente'] ['rg'];
       $cpf = $_SESSION['cliente'] ['cpf'];
       $telefone = $_SESSION['cliente'] ['telefone'];
       $celular = $_SESSION['cliente'] ['celular'];
       $email = $_SESSION['cliente'] ['email'];
       $obs = $_SESSION['cliente'] ['obs'];
       $idEstado = $_SESSION['cliente'] ['idEstado'];
       $foto = $_SESSION['cliente'] ['foto'];
       $sigla = $_SESSION['cliente'] ['sigla'];
       $modo = "Atualizar";

       unset($_SESSION['cliente']);
   }

?>

<!DOCTYPE>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title> Cadastro </title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <script src="js/jquery.js"></script>

        <script>
            $(document).ready(function(){

                //Alterando uma propriedade de css ao carregar da página
                $('#container-modal').css('display', 'none');
                //Abrir modal
                $('.pesquisar').click(function(){
                    $('#container-modal').fadeIn(1000);

                    //Recebe o id do Cliente que foi adicionado pelo data atributo no HTML
                    let idcliente = $(this).data('id');

                    // Realiza uma requisição para consumir dados de uma outra página
                    $.ajax({
                        // Organiza uma requisição para consumir dados de uma outra página
                        type:"GET", // Tipo de requisição (GET, POST PUT , etc)
                        url:"visualizarDados.php", //URL da página que será consumida 
                        data:{id:idcliente},
                        success: function(dados){ // Se a requisição der certo iremos receber o conteúdo da variavel dados 
                            $('#modal').html(dados); // Exibe dentro  da div #modal
                        }
                    });
                });

                //Fechar Modal
                $('#fechar-modal').click(function(){
                    $('#container-modal').fadeOut();
                });
            });
        </script>

    </head>
    <body>
        <!-- Principais elementos de formulário para HTML5 
            <input type = "tel"> indica que a caixa recebe um telefone
            <input type = "email"> indica que a caixa recebe um email com o minimo necessário para ser um email @
            <input type = "url"> indica que a caixa recebe uma URL válida (https://)
            <input type = "number"> indica que a caixa recebe apenas números inteiros
            <input type = "range"> cria um elemento tipo barra de rolagem horizontal
            <input type = "color"> cria uma paleta de cores para escolha do usuário
            <input type = "date"> cria um calendario para escolha da data
            <input type = "month"> cria um calendaio somente para escolha de mes e ano
            <input type = "week"> cria um calendario que retorna o numero da semana do ano 
         -->

         <!-- Modal -->
        <div id="container-modal">
            <span id="fechar-modal">
                <img src="img/trash.png">
            </span>
            <div id="modal"></div>
        </div>

        <div id="cadastro"> 
            <div id="cadastroTitulo"> 
                <h1> Cadastro de Contatos </h1>
            </div>
            <div id="cadastroInformacoes">
        
                <!-- As variaveis modo e id que foram utilizadas no action do form são responsáveis por encaminhar para a pagina recebeDados.php duas informações
                    modo - é responsável por definir se é para inserir ou atualizar
                    id - é responsável por identificar o registro a ser atualizado no banco de dados
                -->

                <!-- enctype="multipart/form-data" - é obrigatório ser utilizado quando for trabalhar com imagens 
                    Obs : Para trabalhar com a input type="file" é obrigatório utilizr o método POST
                -->

                <form enctype="multipart/form-data" action="controles/recebeDadosClientes.php?modo=<?=$modo?>&id=<?=$id?>&nomefoto=<?=$foto?>" name="frmCadastro" method="post" >
                   
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Nome: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtNome" value="<?=$nome?>" placeholder="Digite seu Nome" maxlength="100">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Foto: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="file" name="fleFoto" value="" accept="image/jpeg, image/jpg, image/png">
                        </div>
                        <div id="visualizarFoto">
                            <img src="<?=NOME_DIRETORIO_FILE.$foto?>" alt="">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Estado: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <select name="sltEstado" id="">
                                <option selected value="<?=$idEstado?>"> <?=$sigla?> </option>
                                <?php
                                    //Chama a função que vai buscar todos os estados no banco 
                                    $listEstados = exibirEstados();

                                    while ($rsEstados = mysqli_fetch_assoc($listEstados)){
                                ?>
                                    <option value="<?=$rsEstados['idEstado']?>"><?=$rsEstados['sigla']?></option>
                                
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> RG: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtRg" value="<?=$rg?>" maxlength="15">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> CPF: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtCpf" value="<?=$cpf?>" maxlength="20">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Telefone: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="tel" name="txtTelefone" value="<?=$telefone?>" maxlength="18">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Celular: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="tel" name="txtCelular" value="<?=$celular?>" maxlength="18">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Email: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="email" name="txtEmail" value="<?=$email?>" maxlength="60">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Observações: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <textarea name="txtObs" cols="50" rows="7"><?=$obs?></textarea>
                        </div>
                    </div>
                    <div class="enviar">
                        <div class="enviar">
                            <input type="submit" name="btnEnviar" value="<?=$modo?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="consultaDeDados">
            <table id="tblConsulta" >
                <tr>
                    <td id="tblTitulo" colspan="6">
                        <h1> Consulta de Dados.</h1>
                    </td>
                </tr>
                <tr id="tblLinhas">
                    <td class="tblColunas destaque"> Nome </td>
                    <td class="tblColunas destaque"> Celular </td>
                    <td class="tblColunas destaque"> Email </td>
                    <td class="tblColunas destaque"> Foto </td>
                    <td class="tblColunas destaque"> Opções </td>
                </tr>

                <?php
                    $dadosClientes = exibirClientes();
                
                    while($rsClientes = mysqli_fetch_assoc($dadosClientes)){
                ?>

                <tr id="tblLinhas">
                    <td class="tblColunas registros"><?=$rsClientes['nome']?></td>
                    <td class="tblColunas registros"><?=$rsClientes['celular']?></td>
                    <td class="tblColunas registros"><?=$rsClientes['email']?></td>
                    <td class="tblColunas registros"> <img src="<?=NOME_DIRETORIO_FILE.$rsClientes['foto']?>" alt="" class="foto"> </td>
                    <td class="tblColunas registros">
                        
                        <a href="controles/editaDadosCliente.php?id=<?=$rsClientes['idcliente']?>">
                           <img src="img/edit.png" alt="Editar" title="Editar" class="editar">
                        </a>    
                        
                        <a onclick=" return confirm('Tem certeza que deseja excluir?');" href="controles/excluiDadosCliente.php?id=<?=$rsClientes['idcliente']?>&foto=<?=$rsClientes['foto']?>">
                            <img src="img/trash.png" alt="Excluir" title="Excluir" class="excluir">
                        </a>
                        
                        <img src="img/search.png" alt="Visualizar" title="Visualizar" class="pesquisar" data-id="<?=$rsClientes['idcliente']?>">
                    </td>
                </tr>

                <?php
                    }
                ?>
            
            </table>
        </div>
    </body>
</html>