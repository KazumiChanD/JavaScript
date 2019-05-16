import {Sorter} from "./Sorter.js";

export class InsertionSorter extends Sorter {
    _runAlgorithm() {
        const itemsToSortLength = this._itemsToSort.length;

        for (let i = 1; i < itemsToSortLength; i++) {
            let item;
            let moveIndex;

            item = this._itemsToSort[i];
            moveIndex = i - 1;

            while (moveIndex >= 0 && this._itemsToSort[moveIndex] > item) {
                this._itemsToSort[moveIndex + 1] = this._itemsToSort[moveIndex];
                moveIndex--;
            }

            this._itemsToSort[moveIndex + 1] = item;
        }
    }
}