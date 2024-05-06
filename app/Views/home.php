<?php
echo "this is the home page <br>";
$name = auth()->user()->name;
echo "$name <br>";
echo "$beltName belt <br>";


foreach ($syllabus as $technique) {
    echo "$technique <br>";
  }