<?php
include_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
        </script>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>Registro de Usuários</h1>
        <form action="inserir.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="celular" class="form-label">Celular:</label>
                <input type="text" class="form-control" id="celular" name="celular" maxlength="11" required>
            </div>
            <div class="mb-3">
                <label for="datanasc" class="form-label">Data de Nascimento:</label>
                <input type="date" class="form-control" id="datanasc" name="datanasc" required>
            </div>
            <div class="mb-3">
                <label for="genero" class="form-label">Gênero:</label>
                <select class="form-select" id="genero" name="genero" required>
                    <option value="">Selecione</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                    <option value="O">Outro</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Inserir</button>
        </form>
        <table>
            <tr>
                <th> Nome: </th>
                <th> Celular: </th>
                <th> Data de Nascimento: </th>
                <th> Gênero: </th>
                <th>Ações: </th>
            </tr>
            <br>
            <?php
            $sql = "SELECT * FROM clientes";
            $stmt = $pdo->query($sql);
            $generoformatado = "";
            $celularformatado = "";
    
            while ($row = $stmt->fetch()) {
                if ($row['genero'] == "M") {
                    $generoformatado = "Masculino";
                } else if ($row['genero'] == "F") {
                    $generoformatado = "Feminino";
                } else {
                    $generoformatado = "Outro";
                }
                if (strlen($row['celular']) == 11 && $row['celular'][2] == '9') {
                    $celularformatado = "(" . substr($row['celular'], 0, 2) . ") " . substr($row['celular'], 2, 5) . "-" . substr($row['celular'], 7, 4);
                } else {
                    $celularformatado = $row['celular'];
                }
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['nome']) . '</td>';
                echo '<td>' . htmlspecialchars($celularformatado) . '</td>';
                echo '<td>' . htmlspecialchars($row['datanasc']) . '</td>';
                echo '<td>' . htmlspecialchars($generoformatado) . '</td>';

                echo '<td>';
                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarModal' . $row['id'] . '">Editar</button>';
                echo '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal' . $row['id'] . '">Excluir</button>';

                echo '</td>';
                echo '<div class="modal fade" tabindex="-1" id="editarModal' . $row['id'] . '" aria-labelledby="editModal" aria-hidden="true">';
                echo '    <div class="modal-dialog">';
                echo '        <div class="modal-content">';
                echo '            <div class="modal-header">';
                echo '                <h5 class="modal-title">Editar usuário</h5>';
                echo '                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                echo '            </div>';
                echo '            <div class="modal-body">';
                echo '                <form action="validar_edicao.php" method="POST">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '"';
                echo '                    <label for="id">Editando o(a) cliente: ' . $row['nome'] . '</label>';
                echo '<div class="mb-3">';
                echo '    <label for="nome" class="form-label">Nome:</label>';
                echo '    <input type="text" class="form-control" id="nome" name="nome" required value=' . $row['nome'] . '>';
                echo '</div>';
                echo '<div class="mb-3">';
                echo '<label for="celular" class="form-label">Celular:</label>';
                echo '<input type="text" class="form-control" id="celular" name="celular" maxlength="11" required value=' . $row['celular'] . '>';
                echo '</div>';
                echo '<div class="mb-3">';
                echo '<label for="datanasc" class="form-label">Data de Nascimento:</label>';
                echo '<input type="date" class="form-control" id="datanasc" name="datanasc" required>';
                echo '</div>';
                echo '<div class="mb-3">';
                echo '<label for="genero" class="form-label">Alterar gênero:</label>';
                echo '<select class="form-select" id="genero" name="genero" required>';
                echo '<option disabled value="">Selecione</option>';
                echo '<option value="M">Masculino</option>';
                echo '<option value="F">Feminino</option>';
                echo '<option value="O">Outro</option>';
                echo '</select>';
                echo '</div>';
                echo '<button type="submit" class="btn btn-primary">Editar</button>';
                echo '</form>';
                echo '</div>';
                echo '<div class="modal-footer">';
                echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

                echo '<div class="modal fade" tabindex="-1" id="deleteModal' . $row['id'] . '" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>';
                echo '<div class="modal-body">';
                echo '<form action="validar_exclusao.php" method="POST">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '"';
                echo '<label for="id">Tem certeza que deseja excluir o(a) cliente: ' . $row['nome'] . '?</label>';
                echo '<button type="submit" class="btn btn-danger">Excluir</button>';
                echo '</form>';
                echo '</div>';

                echo '<div class="modal-footer">';
                echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

            }




            echo '</tr>';

            ?>
        </table>

    </div>
</body>

</html>