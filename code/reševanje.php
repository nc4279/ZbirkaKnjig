<?php session_start(); ?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Kviz</title>
</head>
<body>

<?php if(isset($_SESSION["up_ime"]) and !empty($_SESSION["up_ime"])){
        include("./include/header-nav-user.php");
    }
    else {
        include("./include/header-nav.php");
    }
?>
<div id="main">
    <?php

    if(isset($_POST["odgovor"]) && !empty($_POST["odgovor"])){
     
       
        if ( $_POST["odgovor"] == $_SESSION["pravilno"])
        {
            $_SESSION["rez"]++;
        }
    }
    include("vprašanja.php");

    ?>


    <form action="" method="post">
    <?php
    if (isset($_SESSION["odgovori"]) && !empty($_SESSION["odgovori"]))
        {   
            $odg = $_SESSION["odgovori"];
            $o = $odg['odgovor'];
            $o1 = $odg['odgovor1'];
            $o2 = $odg['odgovor2'];
           
            echo "<button type=submit name=odgovor value='$o'>" . $o ."</button> <br>";
            echo "<button type=submit name=odgovor value='$o1'>" . $o1 ."</button> <br>";
            echo "<button type=submit name=odgovor value='$o2'>" . $o2 ."</button> <br>";
            
        }
    ?>

    </form>
</div>
<?php include("./include/aside.php"); ?>
<?php include("./include/footer.php"); ?>
</body>
</html>