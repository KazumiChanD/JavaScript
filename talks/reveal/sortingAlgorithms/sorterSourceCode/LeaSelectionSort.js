import {Sorter} from "./Sorter.js";

export class LeaSelectionSorter extends Sorter {
    _runAlgorithm() {

        const itemsToSortLength = this._itemsToSort.length;
        const itemsToSort = this._itemsToSort;

        /**
         * Durchläufe zum überprüfen
         */
        for (let currentPosition = 0; currentPosition < itemsToSortLength; currentPosition++) {
            let minimumIndex = currentPosition;

            /**
             * verändern der kleinsten gespeicherten Zahl
             */
            for (let k = currentPosition + 1; k < itemsToSortLength; k++) {
                if (itemsToSort[minimumIndex] > itemsToSort[k]) {
                    minimumIndex = k;
                }
            }
            swap(itemsToSort, minimumIndex, currentPosition);
        }


        /**
         * Austauschen der kleinsten und aktuellsten Zahl
         *
         * @param itemsToSort beinhaltet die Variable
         * @param minimumIndex
         * @param currentPosition
         */
        function swap(itemsToSort,minimumIndex, currentPosition) {
            let old = itemsToSort[currentPosition];
            itemsToSort[currentPosition] = itemsToSort[minimumIndex];
            itemsToSort[minimumIndex] = old;
        }

    }

}