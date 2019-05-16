import {Sorter} from "./Sorter.js";

export class LeaSorter extends Sorter {
    _runAlgorithm() {


        const itemsToSortLength = this._itemsToSort.length;
        const itemsToSort = this._itemsToSort;

        //BubbleSort Absteigend!
        /**
         * überprüft und sortiert das Array aus dem Parameter
         * @param itemsToSortLength worin die Sachen zum sortieren drin sind
         */
        //Äußerer Loop
        /*
        for (let i = 1; i < itemsToSortLength; i++) {
            //Innerer Loop
            for (let j = 0; j < itemsToSortLength - i; j++) {

                if (itemsToSort[j] > itemsToSort[j + 1]) {
                } else {
                    let temp = itemsToSort[j];
                    itemsToSort[j] = itemsToSort[j + 1];
                    itemsToSort[j + 1] = temp;
                }

            }

        }*/


        //BubbleSort Aufsteigend!
        /**
         * überprüft und sortiert das Array aus dem Parameter
         * @param itemsToSortLength worin die Sachen zum sortieren drin sind
         */

        //Äußerer Loop
        for (let i = 1; i < itemsToSortLength; i++) {
            //Innerer Loop
            for (let j = 0; j < itemsToSortLength - i; j++) {

                if (itemsToSort[j] >= itemsToSort[j + 1]) {
                    let temp = itemsToSort[j];
                    itemsToSort[j] = itemsToSort[j + 1];
                    itemsToSort[j + 1] = temp;
                }

            }

        }



    }

}