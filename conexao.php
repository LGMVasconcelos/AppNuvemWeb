<?php
$host    = 'sql.freedb.tech';
$db_name = 'freedb_senai_2026';
$user    = 'freedb_LuizAdm';
$pass    = 'at7#vD*&hEyM5K2';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options); 
} catch (\PDOException $e) {
    exit("Erro na conexão com o Banco de Dados: " . $e->getMessage());
}
$conn = mysqli_connect($host, $user, $pass, $db_name);
if (!$conn) {
    exit("Erro na conexão MySQLi: " . mysqli_connect_error());
}
mysqli_set_charset($conn, $charset);
?>