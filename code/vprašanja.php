<?php

require_once "./data/DBInit.php";

if (isset($_SESSION['stVpr']) and !empty($_SESSION['stVpr']) and $_SESSION['stVpr']<11){

    $vpr = DBQuestion::getQuestion();
    $vp = $vpr['vprašanje'];
    $vpId = $vpr['id'];
    if (in_array($vpId, $_SESSION["ID"])){
        $vpr = DBQuestion::getQuestion();
        $vp = $vpr['vprašanje'];
        $vpId = $vpr['id'];
    } else {
        array_push($_SESSION["ID"],$vpId);
    }

    $odg =DBQuestion::getAnswer($vpId);
    $pravilni = DBQuestion::getRightAnswer($vpId);

    $_SESSION["odgovori"] = $odg;
    $_SESSION["pravilno"] = $pravilni;
   
    echo "<h2>" . $_SESSION["stVpr"].".  Vprašanje </h2>";
    echo "<h3> $vp </h3>";

    $_SESSION["stVpr"]++;
    
    }
else if($_SESSION['stVpr']>10)
    {
        echo "<h2>Konec kviza</h2>";
        echo "<p>Uspešno ste prišli do konca kviza. Upam, da ste se zabavali in se naučili kaj novega.</p><br>";
        echo "<br><br><b>Vaš rezultat je: " . (($_SESSION["rez"] / 10) * 100). "%</b><br><br>";

        if(isset($_SESSION["user"]) and !empty($_SESSION["user"])){
            
            $up = $_SESSION["user"];
            $rez = (($_SESSION["rez"] / 10) * 100);
            $date = date("Y/m/d");
            if (DBQuestion::insertResults($date,$up,$rez))
            { 
                unset($_SESSION['stVpr']);
                unset($_SESSION['odgovori']);
            }

            echo "<p>Če imate vi kakšno vprašanje, nam ga lahko podate. Z veseljem širimo znanje.</p>";
            echo "<a href='novovprašanje.php'><button> Dodaj novo vprašanje </button></a><br><br>";
            echo "<a href='index.php'><button> Domov </button></a><br>";
        }
        else {
            unset($_SESSION['stVpr']);
            unset($_SESSION['odgovori']);
            echo "<br><a href='index.php'><button> Domov </button></a><br>";
        }
       
      
        
    }

class DBQuestion{

    static function getQuestion() {
        $dbh = DBInit::getInstance();

        $query = "SELECT vprašanje,id FROM vprašanje ORDER BY RAND() LIMIT 1";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result[0];
    }


    static function getAnswer($id){ 
        $dbh = DBInit::getInstance();

        $query = "SELECT odgovor, odgovor1, odgovor2 FROM vprašanje where id= :id";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result[0];
    }

    static function getRightAnswer($id){

        $dbh = DBInit::getInstance();

        $query = "SELECT pravilno FROM vprašanje where id= :id";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result[0]["pravilno"];
    }

    static function insertResults($date,$up,$rez)
    {
        $dbh = DBInit::getInstance();

        $query = "INSERT INTO kviz (datum,rezultat,uporabnik) VALUES (:datum,:rez,:user)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':datum', $date);
        $stmt->bindParam(':rez', $rez);
        $stmt->bindParam(':user', $up);
        return $stmt->execute();
    
    }

}
