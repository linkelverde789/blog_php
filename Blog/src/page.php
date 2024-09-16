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

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_GET["id"])) {
        try {
            $id = isset($_POST["id"]) ? $_POST["id"] : $_GET["id"];

            $conexion = new PDO('pgsql:host=192.168.1.201;dbname=bdjuegos', 'app', 'app');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $statement = $conexion->prepare('SELECT * FROM consulta WHERE id = ?');
            $statement->execute([$id]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) == 0) {
                echo "<h1>No se ha encontrado el artículo con el ID: " . htmlspecialchars($id) . "</h1>";
            } else {
                echo "<div class='individual'>";
                foreach ($result as $item) {
                    echo "<div>";
                    echo "<h1>" . htmlspecialchars($item["titulo"]) . "</h1>";
                    echo "<p>" . nl2br(htmlspecialchars($item["texto"])) . "</p>";
                    echo "</div>";
                }
                echo "</div>";
                comentarios($id, $_SESSION["username"]);
            }
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }
    ?>

</body>

</html>
<?php
function comentarios($id_articulo, $usuario)
{
    try {
        $conexion = new PDO("pgsql:host=192.168.1.201;dbname=bdjuegos", "app", "app");
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $conexion->prepare("select * from seccion_comentarios where id_articulo=?");
        $statement->execute([$id_articulo]);
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);

        $comment = false;
        foreach ($resultado as $item) {
            if ($item["usuario"] == $usuario) {
                $comment = true;
                break;
            }
        }
        echo "<div class='comment'>";
        if ($comment) {
            echo "<h1>Ya has hecho un comentario</h1>";
        } else {
            echo "<form action='createComment.php' method='post'>
            <input type='text' name='comment'> <button type='submit'>Comentar</button>
            <input type='number' name='id' value=$id_articulo hidden>
            </form>";
        }
        
        foreach ($resultado as $item) {
            echo "<div class='popo'>";
            echo "<p>" . htmlspecialchars($item["usuario"]) . "</p>";
            echo "<p>" . htmlspecialchars($item["comentario"]) . "</p>";
            echo "<p>" . htmlspecialchars($item["fecha_creacion"]) . "</p>";
            echo "</div>";
            echo "<br>";
        }
        echo "</div>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>