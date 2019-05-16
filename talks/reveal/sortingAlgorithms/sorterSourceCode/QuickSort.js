import {Sorter} from "./Sorter.js";

export class QuickSorter extends Sorter {
    _runAlgorithm() {

        // Sort the entire array.
        this._recursion(0, this._itemsToSort.length - 1);
    }

    _recursion(start, end) {
        // If this sub-array contains less than 2 elements, it's sorted.
        if (end - start < 1) {
            return;
        }

        const pivotValue = this._itemsToSort[end];
        let splitIndex = start;
        for (let i = start; i < end; i++) {
            // This value is less than the pivot value.
            if (this._itemsToSort[i] < pivotValue) {

                // If the element just to the right of the split index,
                //   isn't this element, swap them.
                if (splitIndex !== i) {
                    const temp = this._itemsToSort[splitIndex];
                    this._itemsToSort[splitIndex] = this._itemsToSort[i];
                    this._itemsToSort[i] = temp;
                }

                // Move the split index to the right by one,
                //   denoting an increase in the less-than sub-array size.
                splitIndex++;
            }

            // Leave values that are greater than or equal to
            //   the pivot value where they are.
        }

        // Move the pivot value to between the split.
        this._itemsToSort[end] = this._itemsToSort[splitIndex];
        this._itemsToSort[splitIndex] = pivotValue;

        // Recursively sort the less-than and greater-than arrays.
        this._recursion(start, splitIndex - 1);
        this._recursion(splitIndex + 1, end);
    };
}