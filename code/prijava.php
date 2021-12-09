<?php session_start(); 

require_once "./data/DBInit.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $up = test_input($_POST["up_ime"]);
    $pass = test_input($_POST["pass"]);

    /*if (UserDB::validLoginAttempt($up,$pass))
    {
        $_SESSION["up_ime"] = UserDB::getUserName($up);
        $_SESSION["user"] = $up;
        header("Location: index.php");
    }*/
    $hash = UserDB::getHash($up);
    
    if(password_verify($pass, $hash)){
        $_SESSION["up_ime"] = strtoupper(UserDB::getUserName($up)); 
        $_SESSION["user"] = $up;
        header("Location: index.php");
    }

    else {
        echo "<script type='text/javascript'>alert('Napačno uporabniško ime ali geslo!');</script>";

    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


class UserDB {

    static function validLoginAttempt($username,$pass) {

        $dbh = DBInit::getInstance();
        $query = "SELECT count(up_ime) FROM uporabnik WHERE up_ime = :user AND geslo= :pass";
        $stmt = $dbh->prepare($query);
        $stmt ->bindParam(':pass',$pass);
        $stmt->bindParam(':user',$username);
        $stmt->execute();
    
        return $stmt->fetchColumn(0) == 1;
    }

    static function getUserName ($username){
        $dbh = DBInit::getInstance();
        $query = "SELECT ime FROM uporabnik WHERE up_ime = :user";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user',$username);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result[0]["ime"];
    }

    static function getHash ($username){
        $dbh = DBInit::getInstance();
        $query = "SELECT geslo FROM uporabnik WHERE up_ime = :user";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user',$username);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result[0]["geslo"];
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
    <title>Prijava</title>
</head>
<body>


<?php include("./include/header-nav.php");?>
<div id="main">
    <h2>Prijava za obstoječe uporabnike</h2>
    <p>Prosim, prijavi se. </p>
    <form action="" method="post">

        <label for="up_ime"><b>Uporabniško ime</b></label>
        <input type="text" placeholder="Vnesi uporabniško ime" name="up_ime" required>

        <label for="pass"><b>Geslo</b></label>
        <input type="password" placeholder="Vnesi geslo" name="pass" required><br>

        <button type="submit">Prijavi me!</button><br>

    </form>
</div>
<?php include("./include/aside.php"); ?>
<?php include("./include/footer.php"); ?>
</body>
</html>