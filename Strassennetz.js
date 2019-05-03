//Umlaute ändern! x
//Schleife auf variable Länge zuschneiden x
//Function auslagern x
//Räder in eine Variable auslagern x
//if zusammenfassen x
//Functionen aufteilen und eine Main Function erstellen x

let Citys = ["Crivitz", "Schwerin", "Parchim", "Rostock", "Köln"];
let car = { color: "yellow", };
let tire = { strain: "2,5 bar", };
let street = { success: true, };
let raeder = 4;

//die Main Methode initialisiert die new Operator
function Main() {

    //Damit werden Anzahl an Citys.length Autos erstellt
    for (let i = 0; i < Citys.length ; i++) {
        Auto(4, Citys[i]);
    }

    let myAuto = new Auto();
    let myStreets = new Street("Crivitz", "Parchim");
    console.log(myStreets.succesfull());
}

//überprüft ob der 1 Parameter und der 2 Parameter existieren
function Street(Stadt1, Stadt2) {
    this.Stadt1 = Stadt1;
    this.Stadt2 = Stadt2;
    for (let i = 0; i < Citys.length; i++) {
        if (Stadt1 == Citys[i]) {
            console.log(Stadt1 + " existiert.");
        }
        else if (Stadt2 == Citys[i]) {
            console.log(Stadt2 + " existiert auch, also gibt es diese Straße.");
        }
    }
    this.succesfull = function() {
        let succesfullStreet = Symbol();
        succesfullStreet = Stadt1 + " " + Stadt2;
        return succesfullStreet;
    }
}

//überprüft ob das Auto 4 Räder und einen Aufenthaltsort besitzt
function Auto(raeder, aufenthaltsort) {
    this.raeder = raeder;
    this.aufenthaltsort = aufenthaltsort;
    if (raeder === 4 && aufenthaltsort !== "") {
        console.log("Jetzt darf das Auto von " + aufenthaltsort + " los fahren.");
    } else {
        console.log("Hält sich zur Zeit das Auto in einer Stadt auf?");
    }
}

Main();