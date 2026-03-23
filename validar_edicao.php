<?php
include_once('conexao.php');
$id = $_POST['id'] ?? '';
$nome = $_POST['nome'] ?? '';
$celular = $_POST['celular'] ?? '';
$datanasc = $_POST['datanasc'] ?? '';
$genero = $_POST['genero'] ?? '';

$stmt = $pdo->prepare("SELECT id FROM clientes WHERE id = ?");
$stmt->execute([$id]);
if ($stmt->rowCount() === 0) {
    echo "Cliente não encontrado.";
    exit;
} else {
    $stmt = $pdo->prepare("UPDATE clientes SET nome = ?, celular = ?, datanasc = ?, genero = ? WHERE id = ?");
    if ($stmt->execute([$nome, $celular, $datanasc, $genero, $id])) {
        echo "Cliente atualizado com sucesso!";
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao atualizar cliente.";
        header("Location: index.php");
        exit();
    }
}
?>
