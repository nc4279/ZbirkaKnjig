<?php
session_start();
require_once "./data/DBInit.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $name = test_input($_POST["ime"]);
        $up = test_input($_POST["up_ime"]);
        $pass = test_input($_POST["pass"]);
        $passR = test_input($_POST["passR"]);

        if($pass === $passR){

            if(!UserDB::validLoginAttempt($up))
            {
                $hash = password_hash($pass,PASSWORD_DEFAULT);
                if (UserDb::insertUser($name,$up,$hash))
                {
                    $_SESSION["up_ime"] = strtoupper($name);
                    $_SESSION["user"] = $up;
                    header("Location: index.php");
                }
             }
             else{
                echo "<script type='text/javascript'>alert('Uporabniško ime: " . $up. " že obstaja, izberite drugega!');</script>";
            } 
             
        }
        else {

        }

}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

class UserDB {

    static function validLoginAttempt($username) {
        $dbh = DBInit::getInstance();

        $query = "SELECT COUNT(up_ime) FROM uporabnik WHERE up_ime = :user";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user',$username);
        $stmt->execute();

        return $stmt->fetchColumn(0) == 1;
    }

    static function insertUser($name, $user, $pass)
    {
        $dbh = DBInit::getInstance();
        $query = "INSERT INTO uporabnik VALUES (:user,:pass,:name)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':user',$user);
        $stmt->bindParam(':pass',$pass);
        
        return $stmt->execute();

    }
}
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Registracija</title>
</head>
<body>
    
<?php include("./include/header-nav.php"); ?>

<div id="main">
    <h2>Registracija za nove uporabnike</h2>
    <p>Prosim, izpolni obrazec za registracijo.</p>

    <form action="" onsubmit="return pregledPodatkov()" method="post">

        <label for="ime"><b>Vaše ime</b></label>
        <input type="text" placeholder="Vnesi ime" name="ime"  required>

        <label for="up_ime"><b>Uporabniško ime</b></label>
        <input type="text" placeholder="Vnesi uporabniško ime" name="up_ime" required>

        <label for="pass"><b>Geslo</b></label>
        <input type="password" placeholder="Vnesi geslo" name="pass" id="pass" required>

        <label for="passR"><b>Ponovi geslo</b></label>
        <input type="password" placeholder="Ponovi geslo" name="passR"  id ="passR" required><br>

        <button type="submit">Registriraj me!</button><br>

    </form>
</div>
<?php include("./include/aside.php"); ?>
<?php include("./include/footer.php"); ?>

<script type='text/javascript'> 

function pregledPodatkov()
{
    let pass = document.getElementById("pass").value;
    let passR = document.getElementById("passR").value;

    if (pass != passR)
    {
        alert("Podani gesli se ne ujemata!");
        return false;
    }
    else if (pass.length <= 7)
    {
        alert("Geslo mora vsebovati vsaj 8 znakov!");
        return false;
    }
}

</script>
</body>
</html>