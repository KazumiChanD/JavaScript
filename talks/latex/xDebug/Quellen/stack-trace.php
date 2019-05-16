<?php
ini_set('xdebug.collect_vars', 'on');
ini_set('xdebug.collect_params', '4');
ini_set('xdebug.dump_globals', 'on');
ini_set('xdebug.dump.SERVER', 'PWD');
ini_set('xdebug.show_local_vars', 'on');

function foo($array)
{
    $word = 'a word';
    throw new RuntimeException($word);
}

$class = new stdClass;
$class->bar = 100;

$array = [
    42 => false,
    'foo' => 912124,
    $class,
    fopen('/etc/passwd', 'r')
];

foo($array);
