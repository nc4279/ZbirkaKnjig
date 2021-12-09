"use strict";

let knjige = [];

function addKnjiga(event) {

    const naslov = document.querySelector("#naslov").value;
    const avtor = document.querySelector("#avtor").value;
    let datum = document.querySelector("#datum_izdaje").value;
    const cena = document.querySelector("#cena").value;
    const ocena = document.querySelector("#ocena").value;
    const mnenje = document.querySelector("#mnenje").value;

    let date = new Date(datum);
    datum = date.getDate() +"."+ (date.getMonth()+1) +"."+ date.getFullYear(); 

    document.querySelector("#naslov").value = "";
    document.querySelector("#avtor").value = "";
    document.querySelector("#datum_izdaje").value = "";
    document.querySelector("#cena").value = "";
    document.querySelector("#ocena").value = "";
    document.querySelector("#mnenje").value = "";

    const knjiga = {
        avtor: avtor,
        naslov: naslov,
        datum_izdaje: datum,
        cena: cena,
        ocena: ocena,
        mnenje: mnenje
    };

    knjige.push(knjiga);
    store();
    addToZbirka(knjiga);

}

function addToZbirka(knjiga) {

   const zbirka = document.querySelector(".zbirka");   /*ce uporabim v form button se takoj zbrise, torej namesto form napisi div*/
   const k = document.createElement("div");
   k.className="knjiga";
   zbirka.appendChild(k);


   k.addEventListener("dblclick", () =>
   {
        const odgovor = confirm("Ali res želiš izbrisati to knjigo iz svoje zbirke?");
        if(odgovor){
            let pos = knjige.findIndex(x => x.naslov === k.children[1].innerText);
            knjige.splice(pos,1);
            k.remove();
            store();
        }
   });

   for(const key in knjiga){

    const p = document.createElement("p");
    p.innerText = knjiga[key];
    p.style.width ="fit-content";
    p.style.marginLeft="2em";
    p.style.marginRight="1em"

    if (key === "naslov")
    {
        p.style.fontWeight = "900";
    }
    if (key === "cena")
    {
        p.innerText+=" €";
    }
    if (key === "ocena")
    {
        p.innerText+= " ★";
    }

    k.appendChild(p);

    p.addEventListener("click", () => 
        {
        const odgovor = confirm("Želite urediti text '" + p.innerText +"' ?");
        if(odgovor){
            const urejeno = prompt("Spremeni:", p.innerText);
            if (urejeno == null || urejeno == ""){
                alert("Sprememba ni bila uspešna!")
            }
            else {
                //najdi kjer je bil tisti text napisan in ga spremeni, pojdi skozi array
                for (const kn in knjige)
                {
                    for (const key in knjige[kn])
                    {
                        if(key === "ocena" || key === "cena")
                        {
                            let s= p.innerText.split(" ");
                            let sp =s[0];

                            if(knjige[kn][key] === sp)
                            {
                                if(preveriPodatke(key, urejeno))
                                {   
                                    knjige[kn][key] = urejeno;
                                    
                                    if(key === "ocena")
                                        p.innerText = urejeno +" ★";
                                    else 
                                        p.innerText = urejeno+" €";
                                }
                            }
                        }
                        else if (knjige[kn][key] === p.innerText)
                            {
                                if(preveriPodatke(key, urejeno))
                                {   
                                    knjige[kn][key] = urejeno;
                                    p.innerText = urejeno;
                                }
                            }
                    }
                }
                
                store();
            }
                
        }
        });
   }

}
function preveriPodatke(key, text) // ki jih spremenimo
{
    if (key === "datum_izdaje")
    {
        let d = text.split(".");
        let dt = d[2]+"-"+(d[1])+"-"+d[0];
        const date = Date.parse(dt);
        const danes = new Date();
        if (isNaN(date))  //nan = not a number
            alert("Ni pravilen datum");
        else if(date > danes)
            alert("Datum izdaje ne more biti v prihodnosti!");
        else
         return true;
    }
    else if (key === "ocena")
    {
        if (text < 0 || text > 6 )
            alert("Ocene knjige so v razponu od 1 do 5!");
        else 
            return true;
    }
    else if (key === "cena") 
    {
        if (text <= -1)
            alert("Cena knjige ne more biti negativna!");
        else
            return true;   
    }
    else
        return true;
}

function reset()
{
    const tmp= JSON.parse(localStorage.getItem("knjige"));
    tmp.forEach(element => {
        addToZbirka(element);        
    });

    knjige=tmp;

    izpis();

}

function store()
{
    localStorage.setItem("knjige",JSON.stringify(knjige));
    izpis();  
    
}

function izpis()
{
    izpisStKnjig();
    izpisNajKnjige();
    izpisNajDrazjeKnjige();   
}

function izpisStKnjig()
{
    document.getElementById("stKnjig").innerText = "Število knjig: " + JSON.parse(localStorage.getItem("knjige")).length;
}

function izpisNajKnjige()
{
    let max = 0;
    let naslov= "";
    let tmpS =JSON.parse(localStorage.getItem("knjige"));
    tmpS.forEach(element => {
    if (element.ocena > max) {
        max = element.ocena;
        naslov = element.naslov;
    }
    });

    document.getElementById("najKnjiga").innerText = "Najbolje ocenjena knjiga: " + naslov;

}

function izpisNajDrazjeKnjige()
{
    let max = 0;
    let naslov= "";
    let temp =JSON.parse(localStorage.getItem("knjige"));
    temp.forEach(element => {
        if (element.cena > max) {
            max = element.cena;
            naslov = element.naslov;
        }
    });

    document.getElementById("dragaKnjiga").innerText = "Najdražja knjiga: " + naslov +", cena: "+ max +"€";

}

function pregledPodatkov()
{
    const naslov = document.querySelector("#naslov").value;
    const avtor = document.querySelector("#avtor").value;
    let datum = document.querySelector("#datum_izdaje").value;
    let cena = document.querySelector("#cena").value;
    let ocena = document.querySelector("#ocena").value;

    let date = new Date(datum);
    const danes = new Date();
    cena = parseInt(cena);
    ocena = parseInt(ocena);

    if(naslov == "" || avtor == "" || datum == "" || ocena == "")
        alert("Podatki o avtorju, naslovu, datumu izdaje in oceni morajo biti izpoljeni!");

    else if(date > danes)
        alert("Datum izdaje ne more biti v prihodnosti!")
    else if (ocena < 0 || ocena > 6)
        alert("Ocene knjige so v razponu od 1 do 5!");
    else if (cena <= -1)
        alert("Cena knjige ne more biti negativna!");
    else 
        addKnjiga();

}

function poAvtorju()
{
    odstraniVseKnjige();
    knjige.sort((a, b) => (a.avtor > b.avtor) ? 1 : -1);  //When we return 1, the function communicates to sort() that the object b takes precedence in sorting over the object a. Returning -1 would do the opposite.
    store();
    reset();
   
}
function poNaslovu()
{
    odstraniVseKnjige();
    knjige.sort((a, b) => (a.naslov > b.naslov) ? 1 : -1);
    store();
    reset();
    
}
function poCeni()
{
    odstraniVseKnjige();
    knjige.sort((a, b) => (a.cena > b.cena) ? 1 : -1);
    store();
    reset();
    
}
function poOceni()
{
    odstraniVseKnjige();
    knjige.sort((a, b) => (a.ocena > b.ocena) ? 1 : -1);
    store();
    reset();

}

function odstraniVseKnjige(){

    const elementi = document.getElementsByClassName("knjiga");
    while(elementi.length > 0){
        elementi[0].parentNode.removeChild(elementi[0]);
    }
}

document.addEventListener("DOMContentLoaded", () => {

    document.getElementById("dodaj").onclick = pregledPodatkov;
    document.getElementById("poAvtorju").onclick = poAvtorju;
    document.getElementById("poNaslovu").onclick = poNaslovu;
    document.getElementById("poCeni").onclick = poCeni;
    document.getElementById("poOceni").onclick = poOceni;
    reset();  
});