<?php
session_start();
if (!isset($_SESSION["username"]) || !isset($_SESSION["id"])) {
    header('Location: login.html');
    exit();
}
include("standar.html");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST["title"]) || !isset($_POST["text"])) {
            throw new Exception("No se ha elegido ningún artículo");
        }

        // Conexión a PostgreSQL usando PDO
        $conexion = new PDO("pgsql:host=192.168.1.201;dbname=bdjuegos", "app", "app");

        // Configuración de atributos PDO para manejar errores
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
        $title = $_POST["title"];
        $text = $_POST["text"];

      
        $statement = $conexion->prepare("INSERT INTO articulos (titulo, texto, id_usuario) VALUES (?, ?, ?);");

        // Ejecutar la consulta con los datos del formulario
        $statement->execute([$title, $text, $_SESSION["id"]]);

        echo "<h1>Artículo guardado con éxito</h1>";
    } catch (Exception $e) {
        echo "<h1>Error: " . htmlspecialchars($e->getMessage()) . "</h1>";
    }
}
?>
