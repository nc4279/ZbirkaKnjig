<?php

session_start();

require_once "./data/DBInit.php";

if(isset($_SESSION["user"]) and !empty($_SESSION["user"])){
    
    $up = $_SESSION["user"];

    if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["dodaj"])) {

        $naslov = test_input($_POST["naslov"]);
        $avtor = test_input($_POST["avtor"]);
        $datum = test_input($_POST["datum"]);
        $cena = test_input($_POST["cena"]);
        $ocena = test_input($_POST["ocena"]);
        $mnenje = test_input($_POST["mnenje"]);

        if (DBbook::insertBook($naslov,$avtor, $datum, $cena, $ocena,$mnenje,$up))
        {
            header("Refresh:0");
        }
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["delete"]))
    {
        if(DBbook::deleteBook($_POST["delete"]))
        {
            header("Refresh:0");
        }
    }
    else if ($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST["update"]))
    {
        $_SESSION['bookinfo'] = DBbook::bookData($_POST["update"]);
        
    }
    else if ($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST["spremeni"]))
    {
        $naslov = test_input($_POST["naslov"]);
        $avtor = test_input($_POST["avtor"]);
        $datum = test_input($_POST["datum"]);
        $cena = test_input($_POST["cena"]);
        $ocena = test_input($_POST["ocena"]);
        $mnenje = test_input($_POST["mnenje"]);

        if(DBbook::bookUpdate($_POST["spremeni"],$naslov,$avtor,$datum,$cena,$ocena,$mnenje))
        {
            header("Refresh:0");
        }

    }
}



function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


class DBbook {

    static function insertBook($naslov, $avtor, $datum, $cena, $ocena,$mnenje,$up)
        {
            $dbh = DBInit::getInstance();
            $query = "INSERT INTO knjiga (naslov,avtor,datum,cena,ocena,mnenje,user) VALUES (:naslov,:avtor,:datum,:cena,:ocena,:mnenje,:user)";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':naslov',$naslov);
            $stmt->bindParam(':avtor',$avtor);
            $stmt->bindParam(':datum',$datum);
            $stmt->bindParam(':cena',$cena);
            $stmt->bindParam(':ocena',$ocena);
            $stmt->bindParam(':mnenje',$mnenje);
            $stmt->bindParam(':user',$up);
            
            return $stmt->execute();

        }

    static function getBooks ($up)
    {
        $dbh = DBInit::getInstance();
        $query = "SELECT * FROM knjiga where user = :user";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user',$up);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ( $result as $row) {
            echo "<div id='knjiga'> 
            <p>Naslov: ". $row['naslov']." </p> 
            <p>Avtor: ". $row['avtor'] ."</p>
            <p>Datum izdaje: ". $row['datum'] ."</p>
            <p>Cena: ". $row['cena'] ."</p>
            <p>Ocena: ". $row['ocena'] ."★</p> 
            <p>Mnenje: ".  $row['mnenje'] ."</p>
            <form method='post'>
            <button type='submit' name='delete' value='" .$row['id']. "'/>Izbriši </button><br>
            <button type='submit' id ='update' name='update' value='" .$row['id']. "'/>Posodobi </button>      
            </form>
            </div>"; 
        }
    }

    static function deleteBook($id)
    {
        $dbh = DBInit::getInstance();
        $query = "DELETE FROM knjiga WHERE id = :id";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':id',$id);
        return $stmt->execute();
    }

    static function bookData($id)
    {
        $dbh = DBInit::getInstance();
        $query = "SELECT * FROM knjiga WHERE id = :id";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result[0];

    }

    static function bookUpdate($id,$naslov,$avtor,$datum,$cena,$ocena,$mnenje)
    {
        $dbh = DBInit::getInstance();
        $query = "UPDATE knjiga SET naslov = :naslov,
        avtor = :avtor, datum = :datum, cena = :cena, ocena = :ocena, mnenje=:mnenje WHERE id = :id";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":naslov", $naslov);
        $stmt->bindParam(":avtor", $avtor);
        $stmt->bindParam(":datum", $datum);
        $stmt->bindParam(":cena", $cena);
        $stmt->bindParam(":ocena", $ocena);
        $stmt->bindParam(":mnenje", $mnenje);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    static function orderBooks ($up,$order)
    {
        $dbh = DBInit::getInstance();
        $query = "SELECT * FROM knjiga where user = :user ORDER BY $order";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user',$up);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ( $result as $row) {
            echo "<div id='knjiga'> 
            <p>Naslov: ". $row['naslov']." </p> 
            <p>Avtor: ". $row['avtor'] ."</p>
            <p>Datum izdaje: ". $row['datum'] ."</p>
            <p>Cena: ". $row['cena'] ."</p>
            <p>Ocena: ". $row['ocena'] ."★</p> 
            <p>Mnenje: ".  $row['mnenje'] ."</p>
            <form method='post'>
            <button type='submit' name='delete' value='" .$row['id']. "'/>Izbriši </button><br>
            <button type='submit' id ='update' name='update' value='" .$row['id']. "'/>Posodobi </button>      
            </form>
            </div>"; 
        }
    }

    static function dragaKnjiga($up)
    {
        $dbh = DBInit::getInstance();
        $query = "SELECT naslov FROM knjiga WHERE user = :user ORDER BY cena desc, avtor LIMIT 1";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user',$up);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(isset($result[0]["naslov"]))
            return $result[0]["naslov"];

    }

    static function bestKnjiga($up)
    {
        $dbh = DBInit::getInstance();
        $query = "SELECT naslov FROM knjiga WHERE user = :user ORDER BY ocena desc, avtor LIMIT 1";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user',$up);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(isset($result[0]["naslov"]))
            return $result[0]["naslov"];


    }

    static function stKnjig($up)
    {
        $dbh = DBInit::getInstance();
        $query = "SELECT count(*) AS st FROM knjiga WHERE user = :user";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user',$up);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result[0]["st"];

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
    <style>
        
    
    </style>
    <title>Vaše Knjige</title>

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
 
    <h2> Shramba knjig </h2>
    <p>Tukaj je prostor za vse vaše prebrane knjige, katere si želite zapomniti in nikoli pozabiti. Za vsako vašo knjigo je prostor in prav tako za vsako vaše mnenje o te knjigi.
        Knjige lahko med seboj tudi ustrezno uredite po naraščajočem zaporedju.<br></p><br>
        <?php if(empty($_SESSION['user']))
        {
            echo "<b> Shramba knjig je omogočena samo za naše obstoječe uporabnike. </b><br>";
            echo "<p>Če ste že naš uporabnik, se prosim prijavite!</p>";
            echo "<a href='prijava.php'><button> Prijava </button></a><br>";
            echo "<p>Če pa še niste, se pa lahko registrirate!</p>";
            echo "<a href='registracija.php'><button> Registracija </button></a>";
           
        }
            else{

                if(empty($_POST["update"]))
                 {
                    echo "<div id='sticky'>";
                    echo "<div id='info'>";
                    echo "<p>Najbolje ocenjena knjiga: <b>".DBbook::bestKnjiga($_SESSION['user'])."</b></p>";
                    echo "<p>Najdražja knjiga: <b>".DBbook::dragaKnjiga($_SESSION['user'])."</b></p>";
                    echo "<p>Število knjig v vaši shrambi: <b>".DBbook::stKnjig($_SESSION['user'])."</b></p> </div>";
                    echo "<div id ='uredi'>";
                    echo "<form method='post'>";
                    echo "<button type='submit' name='uredi' value='avtor' id='uredi'><b>Uredi po avtorju</b> </button>";
                    echo "<button type='submit' name='uredi' value='naslov' id ='uredi'><b>Uredi po naslovu</b> </button>";
                    echo "<button type='submit' name='uredi' value='cena' id ='uredi'><b>Uredi po ceni </b> </button>";
                    echo "<button type='submit' name='uredi' value='ocena' id ='uredi'><b>Uredi po oceni</b> </button>";
                    echo "</form></div>";
                    echo "</div>";
                    echo "<br><div style='width:100%;'><h3>Vaše knjige</h3></div>";

                    echo "<div id='zbirka'>";
                    if ($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST["uredi"]))
                    {
                        DBbook::orderBooks($up,$_POST["uredi"]);
                    }
                    else {
                        DBbook::getBooks($_SESSION['user']);
                    }
                    echo "</div><br>";
                   
                }
            }
        ?>

    <?php if(empty($_POST["update"]) and !isset($_POST["update"]) and !empty($_SESSION['user'])): ?>
        
        <h3>Dodaj novo knjigo</h3>
        <form action="" onsubmit="return pregledPodatkov()" method="post">
            <label for="naslov">Naslov</label>
            <input type="text" id="naslov" name="naslov" required>
            <label for="avtor">Avtor</label>
            <input type="text" id="avtor" name="avtor" required>
            <label for="datum">Datum izdaje</label>
            <input type="date" id="datum" name="datum" required>
            <label for="cena">Cena</label>
            <input type="number" id="cena" min="0" step="any" name="cena" required>
            <label for="ocena">Ocena ★</label>
            <input type="number" name="ocena" id="ocena" min="1" max="5" required> 
            <label for="mnenje">Mnenje</label>
            <textarea rows="4" cols="50" id="mnenje" name="mnenje" placeholder="Napiši mnenje"></textarea><br>
            <button  type="submit" name="dodaj">Dodaj</button><br>
        </form>
       
    <?php endif; ?>


    <?php if(!empty($_POST["update"]) and isset($_POST["update"]) and !empty($_SESSION["bookinfo"])): ?>
        <h3>Spremeni podatke o knjigi:</h3>
        <form action=""  id="forma" onsubmit="return pregledPodatkov()" method="post">
            <label for="naslov">Naslov</label>
            <input type="text" id="naslov" name="naslov" value="<?= $_SESSION["bookinfo"]['naslov'] ?>" required>
            <label for="avtor">Avtor</label>
            <input type="text" id="avtor" name="avtor" value="<?= $_SESSION["bookinfo"]['avtor'] ?>" required>
            <label for="datum">Datum izdaje</label>
            <input type="date" id="datum" name="datum" value="<?= $_SESSION["bookinfo"]['datum'] ?>" required>
            <label for="cena">Cena</label>
            <input type="number" id="cena" min="0" step="any" name="cena" value="<?= $_SESSION["bookinfo"]['cena'] ?>" required>
            <label for="ocena">Ocena ★</label>
            <input type="number" name="ocena" id="ocena" min="1" max="5" value="<?= $_SESSION["bookinfo"]['ocena'] ?>" required> 
            <label for="mnenje">Mnenje</label>
            <textarea rows="4" cols="50" id="mnenje" name="mnenje" placeholder="Napiši mnenje"><?= $_SESSION["bookinfo"]['mnenje'] ?></textarea><br>
            <button  type="submit" id="spremeni" name="spremeni" value="<?= $_SESSION["bookinfo"]['id'] ?>">Spremeni</button><br>
        </form>
    <?php endif; ?>

</div>

<?php include("./include/aside.php"); ?>

<?php include("./include/footer.php"); ?>

<script type='text/javascript'>

function pregledPodatkov()
{

    let naslov = document.getElementById("naslov").value;
    let avtor = document.getElementById("avtor").value;
    let datum = document.getElementById("datum").value;
    let cena = document.getElementById("cena").value;
    let ocena = document.getElementById("ocena").value;

    let date = new Date(datum);
    const danes = new Date();
    cena = parseInt(cena);
    ocena = parseInt(ocena);

    if(naslov == "" || avtor == "" || datum == "" || ocena == ""){
        alert("Podatki o avtorju, naslovu, datumu izdaje in oceni morajo biti izpoljeni!");
        return false;
    }
    else if(date > danes){
        alert("Datum izdaje ne more biti v prihodnosti!");
        return false;
    }
    else if (ocena < 0 || ocena > 6){
        alert("Ocene knjige so v razponu od 1 do 5!");
        return false;
    }
    else if (cena <= -1){
        alert("Cena knjige ne more biti negativna!");
        return false;
    }
}

</script>


</body>
</html>