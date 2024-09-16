<?php
include "inactivity.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
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
    <div class="buscador">
        <form action="search.php" method="post">
            <input type="text" name="text">
            <button type="submit">Buscar</button>
        </form>
    </div>
    <?php
    try {
        $conexion = new PDO("pgsql:host=192.168.1.201;dbname=bdjuegos", "app", "app");
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            buscador($_POST["text"], $conexion);
        } else {
            normal($conexion);
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
</body>

</html>

<?php
function buscador($text, $conexion)
{
    $statement = $conexion->prepare("SELECT * FROM consulta WHERE titulo ILIKE ?");
    $statement->execute(['%' . $text . '%']);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) == 0) {
        echo "<h1>No se han encontrado elementos que coincidan con: " . htmlspecialchars($text) . "</h1>";
    } else {
        echo "<div class='general'>";
        foreach ($result as $item) {
            echo "<div class='manolo'>";
            echo "<h1>" . htmlspecialchars($item["titulo"]) . "</h1>";
            echo "<form action='page.php' method='post'>
                    <button name='id' value='" . htmlspecialchars($item['id']) . "' type='submit'>Ver Artículo</button>
                  </form>";
            
            echo "<h4> Autor: " . htmlspecialchars($item["usuario"]) . "</h4>";
            echo "</div>";
        }
        echo "</div>";
    }
}

function normal($conexion)
{
    $statement = $conexion->prepare("SELECT * FROM consulta");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo "<div class='general'>";
    foreach ($result as $item) {
        echo "<div class='manolo'>";
        echo "<h1>" . htmlspecialchars($item["titulo"]) . "</h1>";
        echo "<form action='page.php' method='post'>
                <button name='id' value='" . htmlspecialchars($item['id']) . "' type='submit'>Ver Artículo</button>
              </form>";
        
        echo "<h4> Autor: " . htmlspecialchars($item["usuario"]) . "</h4>";
        echo "</div>";
    }
    echo "</div>";
}
?>
