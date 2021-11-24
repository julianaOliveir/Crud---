<?php

    require_once('controles/visualizarDadosClientes.php');

    // Recebe o id enviado pelo AJAX na pagina da index 
    $id = $_GET['id'];

    // Chama a função para buscar no BD
    $dadosCliente = visualizarCliente($id);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Visualizar </title>
</head>
<body>
    <table>
        <tr>
            <td> Nome:  </td>
            <td> <?=$dadosCliente['nome']?> </td>
        </tr>

        <tr>
            <td> RG:  </td>
            <td> <?=$dadosCliente['rg']?> </td>
        </tr>

        <tr>
            <td> CPF:  </td>
            <td> <?=$dadosCliente['cpf']?> </td>
        </tr>

        <tr>
            <td> Telefone:  </td>
            <td> <?=$dadosCliente['telefone']?> </td>
        </tr>

        <tr>
            <td> Celular:  </td>
            <td> <?=$dadosCliente['celular']?> </td>
        </tr>

        <tr>
            <td> Email:  </td>
            <td> <?=$dadosCliente['email']?> </td>
        </tr>

        <tr>
            <td> Observações:  </td>
            <td> <?=$dadosCliente['obs']?> </td>
        </tr>

        <tr>
            <td> Foto: </td>
            <td> <?=$dadosCliente['foto']?> </td>
        </tr>

        
    </table>
</body>
</html>