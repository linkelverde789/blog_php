<?php
include "inactivity.php";
include "standar.html";
$conexion = new PDO("pgsql:host=192.168.1.201;dbname=bdjuegos", "app", "app");
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$statement = $conexion->prepare("select id, titulo from articulos where id_usuario=?");
$statement->execute([$_SESSION["id"]]);
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<form action=deleteArticle.php method="post">
    <select name="article_id">
        <?php
        foreach ($result as $item) {
            echo "<option value=\"" . htmlspecialchars($item["id"]) . "\">" . htmlspecialchars($item["titulo"]) . "</option>";
        }
        ?>
    </select>
    <button type="submit">Crear</button>
</form>