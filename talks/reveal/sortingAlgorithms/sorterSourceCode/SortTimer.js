import {BubbleSorter} from "./BubbleSorter.js";
import {LeaSorter} from "./LeaSorter.js";
import {LeaSelectionSorter} from "./LeaSelectionSort.js";
import {InsertionSorter} from "./InsertionSort.js";
import {SelectionSorter} from "./SelectionSort.js";
import {QuickSorter} from "./QuickSort.js";
import {NativeSorter} from "./NativeSorter.js";
import {BucketSorter} from "./BucketSorter.js";


export class SortTimer {

    _itemsCounts = [];
    _sorters = [
        {name: 'BubbleSorter', instance: new BubbleSorter()},
        {name: 'LeaSorter', instance: new LeaSorter()},
        {name: 'LeaSelectionSorter', instance: new LeaSelectionSorter()},
        {name: 'SelectionSorter', instance: new SelectionSorter()},
        {name: 'InsertionSorter', instance: new InsertionSorter()},
        {name: 'BucketSorter', instance: new BucketSorter()},
        {name: 'QuickSorter', instance: new QuickSorter()},
        {name: 'NativeSorter', instance: new NativeSorter()},
    ];

    constructor(){
        for (var i = 500; i <= 5000; i = i + 250) {
            this._itemsCounts.push(i);
        }
    }

    run() {
        let outputLines = [];

        for (let itemsCount in this._itemsCounts) {
            let items = [];
            items = this.buildItemsWithSize(this._itemsCounts[itemsCount]);

            for (let sorterIndex in this._sorters) {
                let sorter;
                let timeUsedSum;
                if (outputLines[sorterIndex] === undefined) {
                    outputLines[sorterIndex] = {label: this._sorters[sorterIndex].name, data: []};
                }

                sorter = this._sorters[sorterIndex].instance;
                sorter.setItemsToSort([...items]);
                sorter.executeSort();
                timeUsedSum = timeUsedSum = sorter.getTimeUsed();

                console.log(
                    sorter.constructor.name + "for items: " + this._itemsCounts[itemsCount] + " needs " + timeUsedSum
                    + "ms"
                );
                outputLines[sorterIndex].data.push(timeUsedSum);
            }
        }

        return outputLines;
    }

    buildItemsWithSize(size) {
        let items = [];

        for (let i = 1; size >= i; i++) {
            items.push(Math.floor(Math.random() * Math.floor(1000000000000)))
        }

        return items
    }

    setItemsCounts(newItemsCounts) {
        this._itemsCounts = newItemsCounts;
    }

    setSorters(sorters) {
        this._sorters = sorters
    }
}