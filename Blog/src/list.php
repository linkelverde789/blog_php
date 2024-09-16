<?php
include "inactivity.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="list.css">
</head>

<body>
    <div class="nav">
        <a href="menu.php">Menú</a>
        <a href="list.php">Listar</a>
        <a href="create.php">Crear</a>
        <a href="remove.php">Borrar</a>
        <a href="search.php">Buscar</a>
        <a href="listarUsuarios.php">Listar Usuarios</a>
    </div>
    <?php
    try {
        $conexion = new PDO("pgsql:host=192.168.1.201;dbname=bdjuegos", "app", "app");
        $statement = $conexion->prepare("select id, titulo, texto from articulos where id_usuario=?");
        $statement->execute([$_SESSION["id"]]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        echo "<div class='general'>";
        foreach ($result as $item) {
            echo "<div class='manolo'>";
            echo "<h1>" . htmlspecialchars($item["titulo"]) . "</h1>";
            echo "<form action='page.php' method='post'>
                    <button name='id' value='" . htmlspecialchars($item['id']) . "' type='submit'>Ver Artículo</button>
                  </form>";
            echo "</div>";

        }
        echo "</div>";
    } catch (Exception $e) {
        echo "<h1>Error: " . htmlspecialchars($e->getMessage()) . "</h1>";
    }

    ?>
</body>

</html>