<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Verificar si los datos se reciben correctamente


    try {
        // Conectar a la base de datos
        $conexion = new PDO("pgsql:host=192.168.1.201;dbname=bdjuegos", "app", "app");
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar la consulta SQL usando marcadores de posición nombrados
        $statement = $conexion->prepare("SELECT id, password FROM usuarios WHERE usuario = :username");
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->execute();

        // Obtener los resultados
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        // Verificar si la consulta devuelve resultados
        if ($user === false) {
            echo "<script>alert('Usuario no encontrado');</script>";
        } else {

            if ($password == $user["password"]) {
                $_SESSION["username"] = $username;
                $_SESSION["id"] = $user["id"];
                header("Location: menu.php");
                exit();
            } else {
                
            }
        }

    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
