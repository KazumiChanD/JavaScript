import {Sorter} from "./Sorter.js";

export class NativeSorter extends Sorter {
    _runAlgorithm() {
        this._itemsToSort.sort((a, b) => a - b);
    }
}