<?php

function pr($val)
{
    echo print_r($val, true) . PHP_EOL;
}

$data = [
    'email' => "james4@toggen.com.au",
    'user' => "James McDonald4"
];

// $data = array_values($data);
// $data[] = "This is an error string";

pr(array_values($data)[] = "This is the end");




$callable = function (...$args) {
    pr($args[0]);
    pr(func_get_args(), true);
};

$callable('a', 'b', 'c');

// echo print_r($data, true);
