import {Sorter} from "./Sorter.js";

export class LeaSelectionSorter extends Sorter {
    _runAlgorithm() {

        const itemsToSortLength = this._itemsToSort.length;
        const itemsToSort = this._itemsToSort;

        /**
         * Anzahl der Durchläufe
         *
         * @param itemsToSortLength beinhaltet die Länge der Variable
         * @param itemsToSort beinhaltet die Variable
         */
        for (let j = 0; j < itemsToSortLength; j++) {

            /**
             * Durchläufe zum überprüfen
             *
             * @param itemsToSortLength beinhaltet die Länge der Variable
             * @param itemsToSort beinhaltet die Variable
             */
            for (let i = 0; i < itemsToSortLength; i++) {
                let temp = i;

                /**
                 * verändern der kleinsten gespeicherten Zahl
                 *
                 * @param itemsToSortLength beinhaltet die Länge der Variable
                 * @param itemsToSort beinhaltet die Variable
                 */
                for (let k = 1; i < itemsToSortLength - k; k++) {
                    if (itemsToSort[temp] > itemsToSort[k]) {
                        temp = k;
                    }
                }
                swap(itemsToSort, temp, i);
            }
        }

        /**
         * Austauschen der kleinsten und aktuellsten Zahl
         *
         * @param itemsToSort beinhaltet die Variable
         * @param temp
         * @param i
         */
        function swap(itemsToSort, temp, i) {
            let old = itemsToSort[i];
            itemsToSort[i] = itemsToSort[temp];
            itemsToSort[temp] = old;
        }

    }

}