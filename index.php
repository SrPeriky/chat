<?php // Variables
$sala = "";
$nombre = "";
$chat = false;
if (isset($_POST["sala"]) && isset($_POST["nom"])){
  $sala = $_POST['sala'];
  $color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT); // para diferenciar
  $nombre = $_POST['nom'];
  $chat = true;
} 
 ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <script src="./jquery.min.js"></script>
    <title><?php if($chat) echo 'Chat - '.$sala; else echo "Salas"; ?></title>
    <!--script src="http://nwnw.000webhostapp.com/carreras/jquery.min.js"></script-->
  </head>
  <body>
    <h4>Tengo hambre</h4>
    <form action="index.php" method="post">
      <label>Nombre</label> <input type="text" name="nom"> <input type="submit" value="Entrar"> <br>
      <input type="radio" name="sala" value="s1" id="sala1" checked>
      <label for="sala1">
        Sala 1
      </label>
      <input type="radio" name="sala" value="s2" id="sala2">
      <label for="sala2">
        Sala 2
      </label>
      <input type="radio" name="sala" value="s3" id="sala3">
      <label for="sala3">
        Sala 3
      </label>
    </form>
    <?php if($chat) require_once('chat.php'); ?>
  </body>
</html>