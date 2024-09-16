<?php
include "inactivity.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar</title>
</head>

<body>
    <?php
    try {
        $conexion = new PDO('pgsql:host=192.168.1.201;dbname=bdjuegos', 'app', 'app');
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statemnt=$conexion->prepare('select id,nombre, usuario, correo, password from usuarios');
        $statemnt->execute();
        $listaCliente=$statemnt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table border='1'>";
        echo "<tr><th>Nombre</th><th>Usuario</th><th>Correo</th><th>Contraseña</th></tr>";
        foreach($listaCliente as $item){
            echo "<tr>";
            echo "<td>" . htmlspecialchars($item["nombre"]) ."</td>";
            echo "<td>" . htmlspecialchars($item["usuario"]) ."</td>";
            echo "<td>" . htmlspecialchars($item["correo"]) ."</td>";
            echo "<td>" . htmlspecialchars($item["password"]) ."</td>";
            
            if($item["id"]==$_SESSION["id"]&&$item["usuario"]==$_SESSION["username"]){
                echo "<td>Eres tú</td>";
            }
            echo "<tr>";
        }
        echo "</table>";
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
    ?>
</body>

</html>