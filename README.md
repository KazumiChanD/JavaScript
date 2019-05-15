# JavaScript

Um die js Dateien -Sort ausführen bzw testen zu können, muss erst das repo https://github.com/ZooRoyal/talks.git ausgecheckt werden.
cd talks
cd reveal
cd sortingAlgorithms
cd sourterSource Code und dort die einfügen.
Damit diese implementiert sind, muss man noch in der SortTimer.js zwei Zeilen hinzufügen.

Zeile 2 und 3 
import {LeaSorter} from "./LeaSorter.js";
import {LeaSelectionSorter} from "./LeaSelectionSort.js";

und Zeile 16 und 17
        {name: 'LeaSorter', instance: new LeaSorter()},
        {name: 'LeaSelectionSorter', instance: new LeaSelectionSorter()},
