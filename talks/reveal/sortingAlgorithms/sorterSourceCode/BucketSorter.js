import {Sorter} from "./Sorter.js";
import {QuickSorter} from "./QuickSort.js";

export class BucketSorter extends Sorter {

    _bucketSize = 10000000;
    _sorter = new QuickSorter();

    _runAlgorithm() {

        if (this._itemsToSort.length === 0) {
            return this._itemsToSort;
        }

        // Declaring vars
        let minValue = this._itemsToSort[0];
        let maxValue = this._itemsToSort[0];
        let sortedItems = [];

        // Setting min and max values
        for (let i in this._itemsToSort) {
            if (this._itemsToSort[i] < minValue) {
                minValue = this._itemsToSort[i];
            } else if (this._itemsToSort[i] > maxValue) {
                maxValue = this._itemsToSort[i];
            }
        }

        // Initializing buckets
        let allBuckets = [];

        //
        // for (let i in allBuckets) {
        //     allBuckets[i] = [];
        // }

        // Pushing values to buckets
        for (let i in this._itemsToSort) {
            let bucketIndex = Math.floor((this._itemsToSort[i] - minValue) / this._bucketSize);

            if (allBuckets[bucketIndex] === undefined) {
                allBuckets[bucketIndex] = [this._itemsToSort[i]];
            } else {
                allBuckets[bucketIndex].push(this._itemsToSort[i]);
            }
        }

        // Sorting buckets
        this._itemsToSort.length = 0;

        for (let i in allBuckets) {
            if (allBuckets[i].length > 1) {
                this._sorter.setItemsToSort(allBuckets[i]);
                this._sorter.executeSort();
            }
            sortedItems.push(...allBuckets[i]);
        }

        this._itemsToSort = sortedItems;
    }

    setBucketSize(size) {
        this._bucketSize = size;
    }

    setSorter(sorter) {
        this._sorter = sorter;
    }
}