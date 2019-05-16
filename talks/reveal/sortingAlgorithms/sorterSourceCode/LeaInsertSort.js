import {Sorter} from "./Sorter.js";

export class LeaInsertSorter extends Sorter {
    _runAlgorithm() {


        const itemsToSortLength = this._itemsToSort.length;
        const itemsToSort = this._itemsToSort;


        for (let currentPosition = 0; currentPosition < itemsToSortLength; currentPosition++) {
            let nextPosition = currentPosition +1;

            for (;itemsToSort[nextPosition] < itemsToSort[currentPosition];) {
                insert(currentPosition, nextPosition, itemsToSort);
            }

        }

        function insert(itemsToSort, currentPosition, nextPosition) {
            let shortSave = itemsToSort[currentPosition];
            itemsToSort[currentPosition] = itemsToSort[nextPosition];
            itemsToSort[nextPosition] = shortSave;
        }

    }




}