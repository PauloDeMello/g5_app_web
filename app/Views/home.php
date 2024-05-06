<?php
$beltArray = array
(
    "0" => "White",
    "1" => "Yellow",
    "2" => "Orange",
    "3" => "Green",
    "4" => "Purple",
    "5" => "Blue",
    "6" => "Brown",
    "7" => "Black",
);
echo "this is the home page <br>";

$name = auth()->user()->name;
$beltName = $beltArray[auth()->user()->belt];
echo "$name <br>";
echo "$beltName belt";