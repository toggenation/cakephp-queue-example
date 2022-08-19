<?php

if (!function_exists('p')) {
    /**
     * print_r for james
     * @param mixed $val 
     * @return void 
     */
    function pt($val)
    {
        echo print_r($val, true) . PHP_EOL;
    }
}

$data = [
    'email' => "james4@toggen.com.au",
    'user' => "James McDonald4"
];

// $data = array_values($data);
// $data[] = "This is an error string";

pt(array_values($data)[] = "This is the end");




$callable = function (...$args) {
    pt($args[0]);
    pt(func_get_args(), true);
};

$callable('a', 'b', 'c');

// echo print_r($data, true);
