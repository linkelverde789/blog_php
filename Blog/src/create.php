<?php
session_start();
if (!isset($_SESSION["username"]) || !isset($_SESSION["id"])) {
    header('Location: login.html');
    exit();
}
?>
<?php
include("standar.html");
?>
<form action="processCreate.php" method="post">
    <h1>Título</h1>
    <input type="text" maxlength="20" name="title" required>
    <br>
    <h1>Texto</h1>
    <textarea required name="text"></textarea>
    <br>
    <button type="submit">Crear</button>
</form>