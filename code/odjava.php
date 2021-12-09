<?php
  session_start();
  unset($_SESSION['up_ime']);
  unset($_SESSION["user"]);
  
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Odjava</title>
</head>
<body>
<?php include("./include/header-nav.php"); ?>
<div id="main">
    <h2>Uspešno ste se odjavili!</h2>
    <a href='index.php'><button> Domov </button></a>
</div>
<?php include("./include/aside.php"); ?>
<?php include("./include/footer.php"); ?>
</body>
</html>