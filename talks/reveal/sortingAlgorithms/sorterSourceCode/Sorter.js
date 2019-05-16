export class Sorter {
    _itemsToSort = [];
    _timeUsed;

    constructor(itemsToSort = []) {
        this._itemsToSort = itemsToSort;
    }

    executeSort() {
        let startTime;
        let stopTime;

        startTime = performance.now();

        this._runAlgorithm();

        stopTime = performance.now();

        this._checkSorting();

        this._timeUsed = stopTime - startTime;

    }

    _runAlgorithm() {

    }

    _checkSorting() {
        for (let itemIndex in this._itemsToSort) {
            if (+itemIndex + 1 < this._itemsToSort.length) {
                if (!(this._itemsToSort[itemIndex] <= this._itemsToSort[+itemIndex + 1])) {
                    throw "The sorting algorithm is incorrect. " + this._itemsToSort[itemIndex]
                    + " > " + this._itemsToSort[+itemIndex + 1] + "\n"
                    + this._itemsToSort;
                }
            }
        }
    }

    getTimeUsed() {
        return this._timeUsed
    }

    setItemsToSort(itemsToSort) {
        this._itemsToSort = itemsToSort;
    }
}