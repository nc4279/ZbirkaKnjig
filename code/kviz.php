<?php session_start();

$_SESSION["stVpr"] = 1;
$_SESSION["rez"] = 0;
$_SESSION["odgovori"] = null;
$_SESSION["ID"] = array();

require_once "./data/DBInit.php";

class DBQuiz {

    static function getResults ($up)
    {
        $dbh = DBInit::getInstance();
        $query = "SELECT * FROM kviz where uporabnik = :user";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user',$up);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ( $result as $row) {
            echo "<tr><td> Na kvizu, ki je bil rešen ". $row['datum'] . " ste dosegli: " .$row['rezultat']. " % </td></tr>"; 
        }
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
    <title>Kviz</title>
</head>
<body>

<?php if(isset($_SESSION["user"]) and !empty($_SESSION["user"])){
        include("./include/header-nav-user.php");
        echo "<div id='main'>";
        include("./include/opis-kviz.php");
        echo "<table>
        <tr>
            <th><h3> Vaši prejšni poskusi</h3> </th>
        </tr>";
        DBQuiz::getResults($_SESSION["user"]);
        echo "</table>";
        echo "<br>";
        echo "<a href='reševanje.php'><button> Reši kviz </button></a>";
        echo "</div>";
    }
    else {
        include("./include/header-nav.php");
        echo "<div id='main'>";
        include("./include/opis-kviz.php");
        echo "<a href='reševanje.php'><button> Reši kviz </button></a>";
        echo "</div>";
    }
?>



<?php include("./include/aside.php"); ?>
<?php include("./include/footer.php"); ?>
</body>
</html>