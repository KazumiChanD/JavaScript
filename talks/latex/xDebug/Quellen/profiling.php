<?php

firstfunction();

function firstFunction()
{
    $data = ['a', 'bb', 'ccc'];
    secondFunction($data);
    wasteTime();
}

function secondFunction($data)
{
    for ($i = 0 ; $i < 10000; $i++) {
        $items = implode(',', $data);
        echo "items $items \n" ;
    }
}

function wasteTime()
{
    echo 'Wasting Time' . "\n";
    sleep(1);
}
