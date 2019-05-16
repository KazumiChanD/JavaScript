# JavaScript

Um einen eigenen Algorythmus einzufügen:

* SortTimer.js öffnen
+ in Zeile (2 zum Beispiel) einfügen:  

```javascript
import {IrgendeinName} from "./IrgendeinName.js";
```

+ in Zeile (16 zum Beispiel)

```javascript
{name: 'IrgendeinName', instance: new IrgendeinName()},
```

+ in dem eigenen Algorythmus 

```javascript
import {Sorter} from "./Sorter.js";
export class IrgendeinName extends Sorter {
    _runAlgorithm() {
```
+ das Array ist mit **_this._itemsToSort;_** aufrufbar

