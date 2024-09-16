<?php
include "inactivity.php";
try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $con = new PDO("pgsql:host=192.168.1.201;dbname=bdjuegos", "app", "app");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $con->prepare("insert into comentarios (id_usuario, id_articulo, comentario) values (?,?,?)");
        $statement->execute([$_SESSION["id"], $_POST["id"], $_POST["comment"]]);
        $idArticulo = $_POST["id"];
        header("Location: page.php?id=" . $idArticulo);
        exit();
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>