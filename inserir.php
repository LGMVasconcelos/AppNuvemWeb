<?php
include_once 'conexao.php';
$nome = $_POST['nome'] ?? '';
$celular = $_POST['celular'] ?? '';
$datanasc = $_POST['datanasc'] ?? '';
$genero = $_POST['genero'] ?? '';
$stmt = $pdo->prepare("SELECT nome, celular, datanasc, genero FROM clientes WHERE nome = ? AND celular = ? AND datanasc = ? AND genero = ?");
$stmt->execute([$nome, $celular, $datanasc, $genero]);
if (strlen($celular) != 11 && $celular[2] != '9') {
    echo "Celular inválido.";
    exit;
}
if (strtotime($datanasc) > strtotime(date('Y-m-d'))) {
    echo "Data de nascimento inválida.";
    exit;
}
if ($stmt->rowCount() > 0) {
    echo "Erro: Cliente já existe.";
} else {
    $stmt = $pdo->prepare("INSERT INTO clientes (nome, celular, datanasc, genero) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$nome, $celular, $datanasc, $genero])) {
        echo "Cliente inserido com sucesso!";
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao inserir cliente.";
        header("Location: index.php");
        exit();
    }
}
?>