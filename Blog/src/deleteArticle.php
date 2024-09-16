<?php
session_start();
if (!isset($_SESSION["id"]) || !isset($_SESSION["username"])) {
    header("Location: login.html");
    exit();
}

include ("standar.html");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if(!isset($_POST["article_id"])){
            throw new Exception("No se ha elegido ningún artículo");
        }
        $articleID = $_POST["article_id"];

        $conexion = new PDO("pgsql:host=192.168.1.201;dbname=bdjuegos", "app", "app");
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $statement = $conexion->prepare("DELETE FROM articulos WHERE id = ?");
        $statement->execute([$articleID]);

        echo "<h1>Se ha eliminado el artículo con ID: " . htmlspecialchars($articleID) . "</h1>";

    } catch (Exception $e) {
        echo "<h1>Error: " . $e->getMessage() . "</h1>";
    } catch (PDOException $e) {
        echo "<h1>Error en la base de datos: " . $e->getMessage() . "</h1>";
    }
}
?>