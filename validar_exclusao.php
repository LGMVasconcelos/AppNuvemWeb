<?php
include_once("conexao.php");
$cliente = $_POST["id"];
$stmt = $pdo->prepare("DELETE FROM clientes WHERE id = ?");
$success = $stmt->execute([$cliente]);
if ($success && $stmt->rowCount() > 0) {
    echo "<p class='sucesso'>Cliente excluído com sucesso!</p>";
    header("Location: index.php");
    exit();
} else {
    echo "<p class='alerta'>Erro ao deletar o cliente. Tente novamente.</p>";
    header("Location: index.php");
    exit();
}
?>