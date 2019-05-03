let Citys = ["Crivitz", "Schwerin", "Parchim", "Rostock", "Köln"];
let car = { color: "yellow", };
let tire = { strain: "2,5 bar", };
let raeder = 4;

/**
 * Initialisiert die 2 new Operator Auto und Street
 */

function Main() {

    /**
     * Anzahl an Citys.length Autos werden erstellt
     * @param {array} Citys wird benötigt
     * @param {string} raeder wird benötigt
     */
    for (let i = 0; i < Citys.length ; i++) {
        Auto(4, Citys[i]);
    }

    let myAuto = new Auto();
    let myStreets = new Street("Crivitz", "Parchim");
    console.log(myStreets.succesfull());
}

/**
 * Überprüft ob Stadt1 und Stadt2 existieren
 *
 * @param {string} Stadt1 wird benötigt
 * @param {string} Stadt2 wird benötigt
 *
 */
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
    /**
     *
     * @return {string} succesfullStreet enthält Stadt1 und Stadt2
     *
     */
    this.succesfull = function() {
        let succesfullStreet = Symbol();
        succesfullStreet = Stadt1 + " " + Stadt2;
        return succesfullStreet;
    }
}

/**
 * Überprüft ob das Auto 4 Räder hat und einen Aufenthaltsort besitzt
 *
 * @param {string} raeder wird benötigt
 * @param {string} aufenthaltsort wird benötigt
 *
 */
function Auto(raeder, aufenthaltsort) {
    this.raeder = raeder;
    this.aufenthaltsort = aufenthaltsort;
    if (raeder === 4 && aufenthaltsort !== "") {
        console.log("Jetzt darf das Auto von " + aufenthaltsort + " los fahren.");
    } else {
        console.log("Hält sich zur Zeit das Auto in einer Stadt auf?");
    }
    /**
     *
     * Soll das Auto bewegen
     *
     */
    let move = function() {

    }
}

Main();