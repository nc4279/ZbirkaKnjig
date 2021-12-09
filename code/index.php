<?php
session_start();
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <title>Moja Zbirka</title>
</head>
<body>


<?php 
    if(isset($_SESSION["up_ime"]) and !empty($_SESSION["up_ime"])){
        include("./include/header-nav-user.php");
    }
    else {
        include("./include/header-nav.php");
    }
?>

<div id="main">

    <div>
        <h2> Kaj je branje? </h2>  
        <p>
        Branje je pojem, ki opisuje dekodiranje zapisanih črk, ki jih pretvorimo v zvočne jezikovne znake. 
        Kadar dovolj časa vadimo, branje postane avtomatiziran proces. To pomeni, da besedilo vedno preberemo brez dodatnega miselnega napora 
        (Kordigel, 1992). Širši pojem je »bralna pismenost«. Bralno pismen bralec je sposoben brati tekoče in z razumevanjem ter zna fleksibilno 
        uporabljati različne strategije in tehnike branja glede na vrsto besedila in cilj branja. Na koncu lahko informacije, ki jih je pridobil,
        tudi uporabi. Bralna pismenost tako vključuje  <span id="dots">...</span><span id="more"> tri glavne sestavine: tehniko branja, razumevanje prebranega in fleksibilnost branja 
        (Pečjak, 2010). Tehnika branja predstavlja način, kako oseba bere, razumevanje prebranega pomeni, kako dobro oseba razume prebrano 
        vsebino, medtem ko fleksibilnost branja sporoča, da je oseba zmožna brati različne vrste besedila (Kralj, 2010).
        Bolj natančno lahko branje opredelimo kot 7-stopenjski proces: Bralec najprej z očmi zazna vizualne podatke oz. črke.
        Nadaljuje s prepoznavanjem črk in besed. Te nato razume in poveže posamezne besede z vsebino celotnega besedila. 
        Zatem prebrano poveže z znanjem, ki ga je imel pred branjem. Nato informacije učinkovito shrani v spomin,
        iz katerega jih lahko po potrebi tudi prikliče. Zadnji korak pri branju je učinkovita uporaba pridobljenih
        informacij v drugih kontekstih (Kordigel, 1992).
        Branje lahko razdelimo glede na cilj in vrsto besedila, ki ga beremo. Pragmatično branje poteka,
        kadar bralec bere z namenom doseganja konkretnih ciljev (npr. pridobivanje novega znanja).
        V tem primeru je branje orodje za iskanje in zbiranje informacij. Druga vrsta branja je literarno-estetsko branje,
        pri katerem je v ospredju užitek (Kordigel, 1992).</span></p>
        <button onclick="prikaz()" id="prik">Več</button>
        <br><br>
    </div>


<div class="slideshow-container">
    <h2>10 romanov, ki kraljujejo na vseh lestvicah najboljših knjig vseh časov</h2>
        <div class="mySlides fade">
            <div class="text">
                <h3>Tujec, Albert Camus</h3>
                <p>V središču te pripovedi je tema absurda ali nesmisla. 
                Meursaultu se zdi absurdno razmerje med človekom in svetom. 
                Človek teži k sreči, popolnosti, česar pa svet človeku ne daje
                in tukaj nastane razmerje absurda. Meusault se te absurdnosti jasno zaveda,
                    drugi ljudje pa ne. Absurd zavrača s tem, da noče sodelovati v lažnivem upanju
                    v smisel, ki ga družba načrtno goji in zahteva. Meursault se je temu absurdnemu svetu uprl.</p></div>
            </div>

        <div class="mySlides fade">

            <div class="text">
                <h3>Iskanje izgubljenega časa, Marcel Proust</h3>
                <p>Iskanje izgubljenega časa je pripoved o preobrazbi bolnega in introvertiranega otroka v umetnika. Je avtobiografija, ki nazorno prikaže življenje francoske visoke družbe na prelomu iz 19. v 20. stoletje, sicer ne z objektivnega, temveč s subjektivnega zornega kota. Pisatelj dogodke opisuje skozi lastno zavest, opisuje razočaranje nad ljubeznijo, prijateljstvom, življenjem v visoki družbi. Svoj čas pojmuje kot izgubljen čas, od tod tudi naslov cikla. Končno sporočilo tega dela je, da lahko le umetniško ustvarjanje reši človeka pred minljivostjo, in da življenju neki smisel.</p>
            </div>
        </div>

        <div class="mySlides fade">

            <div class="text">
                <h3>Sto let samote, Gabriel García Márquez</h3>
                <p>Glavni tok zgodbe se vrti okoli družine Buendia, ki jo je pisatelj umestil v izmišljeno vasico Macondo v Kolumbiji. Sedem generacij te družine doživlja vzpone in padce, v približno stotih letih (od tod naslov romana) se jih dotaknejo številna dogajanja. Tako ali drugače so vpleteni v razvoj kmetovanja, v tehnološki razvoj mesta, v ponaseljenost pokrajine, v državljansko vojno in v vsaki na novo rojeni generaciji vznikne posameznik, ki izstopa po produktivnosti in izvirnosti, ali pa po čudaškosti in neumnosti. Usoda rodbini Buendia nameni tako razcvet kot propad, določene karakterne vloge posameznikov namreč družino pripeljejo do uničenja. Kultni Marquezov roman briljira v magičnem realizmu, kjer se čarobnost prepleta z resničnostjo, zapolnjen je s fascinantnimi opisi raznih podrobnosti in z mericami humorja, ki omehčajo kruta dogajanja.</p>
            </div>
        </div>
        <div class="mySlides fade">

            <div class="text">
                <h3>Ulikses, James Joyce</h3>
                <p>Ulikses prikazuje en dan v Dublinu na začetku 20. stoletja (16. januarja 1904). Delo lahko primerjamo z nekaterimi mitskimi zgodbami (Homerjeva Odiseja). Tri glavne osebe romana so dublinski žid Leopold
            Bloom (Odisej), njegova žena Molly (Penelopa) in Stephen Dedalus (Telemah, Odisejev sin). Dedalus nastopi kot glavni lik že v romanu Umetnikov mladostni portret, tako je Ulikses v nekem smislu nadaljevanje tega romana. Bloom je reklamni agent in akviziter oglasov in je zato stalno na poti. Njegova žena Molly je amaterska pevka in ta dan, ko moža ni doma, sprejme ljubimca. Stephen Dedalus je nereden študent, intelektualec, ki se trenutno preživlja s poučevanjem v neki šoli. V romanu predstavlja Dedalus nekakega duhovnega Bloomovega sina.</p>
            </div>
        </div>
        <div class="mySlides fade">

            <div class="text">
                <h3>Veliki Gatsby, Francis Scott Fitzgerald</h3>
                <p>Jay Gatsby ima eno samo veliko željo. Ta želja je Daisy Buchanan, mladostna ljubezen. Zgodbo pripoveduje Nick Caraway, ki je na ameriški vzhod prišel, da bi se seznanil s trgovanjem z vrednostnimi papirji. Nick najame malo hiško v West Eggu. Njegov sosed postane Jay Gatsby, ki v ogromni vili prireja zabave za širni bogataški svet. Jay upa, da bo nekega dne skozi vrata stopila tudi Daisy in da bo z vsem bliščem, truščem in sijajem napravil vtis nanjo. Daisy se je po tem, ko je predolgo čakala Jayev povratek iz vojne, poročila z bogatim igralcem pola in nekega dne Jayu s pomočjo Nicka, ki je Daisyin daljni sorodnik in Jayev zaupnik, uspe zvabiti Daisy na srečanje. Vendar je čas 20. let 20. stoletja tudi čas, ko še vedno veljajo toga družbena pravila. Je čas, v katerem med revnimi in bogatimi obstaja točno določena meja.</p>
            </div>
        </div>
        <div class="mySlides fade">

            <div class="text">
                <h3>Ana Karenina, Lev Nikolajevič Tolstoj</h3>
                <p>Brezčasna zgodba raziskuje zmožnost za ljubezen, ki preveva človeška srca, hkrati pa osvetljuje razkošno družbo carske Rusije. Smo v letu 1874. Živahna lepotica Ana Karenina ima vse, kar bi si lahko želele njene sodobnice. Je žena visokega vladnega uradnika Karenina, ki mu je rodila sina, njen položaj v sanktpeterburški družbi skoraj ne bi mogel biti višji. Odpravi se v Moskvo, da bi nezvestemu bratu Oblonskemu pomagala rešiti zakon z Dolly. Na poti Ana spozna grofico Vronsko, ki jo na postaji pričaka njen sin, sijajni konjeniški častnik Vronski. Med Ano in Vronskim preskoči iskrica, ki je ni mogoče prezreti.</p>
            </div>
        </div>
        <div class="mySlides fade">

            <div class="text">
                <h3>Don Kihot, Miguel de Cervantes</h3>
                <p>
                Don Kihot je bil obubožan plemič iz Manče, ki je prebral toliko viteških romanov, da ni več ločil fantazije od stvarnosti. Zato se je odpravil v svet, da bi obudil dobo popotnega viteštva. Dolžnost popotnega viteza je bila braniti nedolžne in preganjati krive. Osedlal je kljuse, konja Rosinanta, kot oproda ga je spremljal kmet Sančo Pansa, izbral si je tudi damo svojega srca, Dulsinejo Toboško, da bi v njeno slavo opravljal junaška dejanja. Obe pripovedni osebi, suhi, pesniško navdahnjeni don Kihot na konju in čokati, trezno misleči in preračunljivi Sančo Pansa na oslu, sta doživljali prigodo za prigodo in jo skoraj vedno skupili (enkrat so ju nabili trgovci, drugič pastirji, don Kihot si je polomil zobe, ko se je zapodil v mline na veter, češ da so sovražni velikani, z njima sta se ponorčevala še vojvoda in vojvodinja). Domači župnik in brivec sta klateža končno z zvijačo spravila domov, kjer je don Kihota srečala pamet, spoznal je svoje čudne zablode in spametovan (vendar oropan iluzij) umrl.
                </p>
            </div>
        </div>
        <div class="mySlides fade">

            <div class="text">
                <h3>Zločin in kazen, Fjodor M. Dostojevski</h3>
                <p>Zločin in kazen je psihološki roman Fjodorja Mihajloviča Dostojevskega, ki obravnava predvsem subjektivna razmišljanja glavnega junaka Raskolnikova o življenju, zlasti pa upravičenost zločina. Ta je prvi v nizu romanov, v katerih se Dostojevski loteva večnih vprašanj o bogu, ljubezni, morali, zlu, trpljenju, odrešenju in človekovi svobodi. Osrednja tema je nemotiviran umor, toda slog Dostojevskega zgodbo pretvori v napeto detektivsko pripoved. Kljub temu da je zgodba zelo navezana na Sankt-Peterburg v 60. letih 19. stoletja, so vprašanja, ki jih postavlja, aktualna v vseh časih.</p>
            </div>
        </div>
        <div class="mySlides fade">

            <div class="text">
                <h3>Prevzetnost in pristranost, Jane Austen</h3>
                <p>Prevzetnost in pristranost je uspešnica že več kot dvesto let! Dolgočasno življenje na angleškem podeželju v 18. stoletju vznemiri novica, da se je v sosesko priselil mlad, samski in bogat moški. Gospa Bennet, ki bo po smrti moža skupaj s petimi hčerami ostala brez strehe nad glavo, v tem vidi priložnost za poroko ene izmed njih. Izmed sester najbolj izstopa Elizabeth, ki je samosvoja, samozavestna in, po mnenju očeta, najpametnejša med vsemi. Kljub pričakovanjem Elizabeth ne dovoli, da bi nanjo vplival denar in pomembnost ljudi okrog nje. Tako kot protagonistka romana tudi pisateljica Jane Austen v svojem najbolj znanem delu razmišlja zunaj okvirov, ki jih je ženskam določala tedanja družba.</p>
            </div>
        </div>
        <div class="mySlides fade">

            <div class="text">
                <h3>Če ubiješ oponašalca, Lee Harper</h3>
                <p>Če ubiješ oponašalca je prvenec Lee Harper iz leta 1960. Zanj je leta 1961 prejela Pulitzerjevo nagrado za književnost. Zgodba je pisana z očmi osemletne Scout. Na začetku se zdi, kot da bomo brali idilično pripoved o njenem otroštvu, ki ga sicer brez mame preživlja z bratom Jemom in temnopolto varuško Calpurnijo. Zgodba se odvija v Alabami v 30. letih 20. stoletja, v času, ko sistem rasnega ločevanja sicer že počasi razpada, vendar je kljub temu še vedno močno usidran v širših množicah. V to idilo zareže novica, da je temnopolti Tom Robinson obtožen posilstva belke Mayelle Evell. Obrambo prevzame belec, samohranilec dveh otrok, odvetnik Atticus Finch.</p>
            </div>
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
        <br><br>
        </div>
</div>
</div>

<?php include("./include/aside.php"); ?>
   
<?php include("./include/footer.php"); ?>

<script>
function prikaz() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("prik");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Več"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Manj"; 
    moreText.style.display = "inline";
  }
}


var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");

  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  slides[slideIndex-1].style.display = "block";  

}

</script>

</body>
</html>