import {Sorter} from "./Sorter.js";

export class SelectionSorter extends Sorter {
    _runAlgorithm() {
        const itemsToSortLength = this._itemsToSort.length;

        let minimum;

        for (let i = 0; i < itemsToSortLength; i++) {

            //set minimum to this position
            minimum = i;

            //check the rest of the array to see if anything is smaller
            for (let remainingItemsIndex = i + 1; remainingItemsIndex < itemsToSortLength; remainingItemsIndex++) {
                if (this._itemsToSort[remainingItemsIndex] < this._itemsToSort[minimum]) {
                    minimum = remainingItemsIndex;
                }
            }

            //if the minimum isn't in the position, swap it
            if (!(i === minimum)) {
                let temp = this._itemsToSort[i];
                this._itemsToSort[i] = this._itemsToSort[minimum];
                this._itemsToSort[minimum] = temp;
            }
        }
    }
}