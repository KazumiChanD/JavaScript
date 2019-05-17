import {Sorter} from "./Sorter.js";

export class LeaInsertSorter extends Sorter {
    _runAlgorithm() {


        const itemsToSortLength = this._itemsToSort.length;
        const itemsToSort = this._itemsToSort;

        /**
         * Schleife zum durchlaufen der aktuelen Position
         *
         */
        for (let currentPosition = 1; currentPosition < itemsToSortLength; currentPosition++) {
            let nextPosition = currentPosition + 1;

            /**
             * Schleife zum durchlaufen der zweiten Position
             *
             */
            for (;itemsToSort[nextPosition] < itemsToSort[currentPosition];) {
                let shortSave = itemsToSort[currentPosition];
                itemsToSort[currentPosition] = itemsToSort[currentPosition + 1];
                itemsToSort[currentPosition + 1] = shortSave;
            }


        }

    }

}