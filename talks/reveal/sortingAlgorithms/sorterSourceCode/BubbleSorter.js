import {Sorter} from "./Sorter.js";

export class BubbleSorter extends Sorter {
    _runAlgorithm() {
        let swapped = true;
        let index = 0;
        let temp;
        const itemsToSortLength = this._itemsToSort.length;

        while (swapped) {
            swapped = false;
            index++;
            for (let i = 0; i < itemsToSortLength - index; i++) {
                if (this._itemsToSort[i] > this._itemsToSort[i + 1]) {
                    temp = this._itemsToSort[i];
                    this._itemsToSort[i] = this._itemsToSort[i + 1];
                    this._itemsToSort[i + 1] = temp;
                    swapped = true
                }
            }
        }
    }
}