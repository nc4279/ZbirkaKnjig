<?php
session_start();
require_once "./data/DBInit.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $vpr = test_input($_POST["vpr"]);
        $odg = test_input($_POST["odg"]);
        $odg1 = test_input($_POST["odg1"]);
        $odg2= test_input($_POST["odg2"]);
        $odgP= test_input($_POST["pravilno"]);

        if(DBQue::insertQuestion($vpr,$odg,$odg1,$odg2,$odgP,$_SESSION["user"]))
        {
            echo "<script type='text/javascript'>alert('Uspešno ste dodali novo vprašanje!');</script>"
        }
        

}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

class DBQue {

    static function insertQuestion($vpr, $odg,$odg1,$odg2,$pravilno,$user)
    {
        $dbh = DBInit::getInstance();
        $query = "INSERT INTO vprašanje(vprašanje,odgovor,odgovor1,odgovor2,pravilno,user) VALUES (:vpr,:odg,:odg1,:odg2,:pravilno,:user)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':vpr',$vpr);
        $stmt->bindParam(':odg',$odg);
        $stmt->bindParam(':odg1',$odg1);
        $stmt->bindParam(':odg2',$odg2);
        $stmt->bindParam(':pravilno',$pravilno);
        $stmt->bindParam(':user',$user);
        return $stmt->execute();

    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Novo vprašanje</title>
</head>
<body>
    
<?php include("./include/header-nav-user.php");?>

<h2>Dodajanje novega vprašanja</h2>
<p>Prosim vas, da ko dodajate novo vprašanje, da se slovnično pravilno izražate, da je vprašanje povezano s književnostjo in da vsebuje 3 možne odgovore, eden od teh mora biti pravilen. </p>

<form action="" onsubmit="return pregledPodatkov()" method="post">

    <label for="vpr"><b>Vprašanje</b></label>
    <input type="text" placeholder="Vnesi vprašanje" id = "vpr" name="vpr" required>

    <label for="odg"><b>Možni odgovor</b></label>
    <input type="text" placeholder="Vnesi odgovor" id="odg" name="odg" required>

    <label for="odg1"><b>Možni odgovor</b></label>
    <input type="text" placeholder="Vnesi odgovor" id="odg1" name="odg1" required>

    <label for="odg2"><b>Možni odgovor</b></label>
    <input type="text" placeholder="Vnesi odgovor" id="odg2" name="odg2" required>

    <label for="pravilno"><b>Pravilni odgovor</b></label>
    <input type="text" placeholder="Vnesi pravilni odgovor" id="pravilno" name="pravilno" required><br>

    <button type="submit">Dodaj!</button><br>

</form>
<?php include("./include/aside.php"); ?>
<?php include("./include/footer.php"); ?>


<script type='text/javascript'> 

function pregledPodatkov()
{
    let vpr = document.getElementById("vpr").value;
    let odg = document.getElementById("odg").value;
    let odg1 = document.getElementById("odg1").value;
    let odg2 = document.getElementById("odg2").value;
    let odgPravilno = document.getElementById("pravilno").value;

    if (!vpr.includes("?"))
    {
        alert("Vprašanje mora vsebovati vprašaj (?)!");
        return false;
    }
    else if (odg !== odgPravilno && odg1 !== odgPravilno && odg2 !== odgPravilno )
    {
        alert("Pravilni odgovor mora biti eden izmed 3 možnih odgovorov!");
        return false;
    }
}
</script>


</body>
</html>