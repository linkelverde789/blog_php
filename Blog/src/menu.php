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
<h1>Bienvenid@, <?php echo htmlspecialchars($_SESSION["username"]);?></h1>