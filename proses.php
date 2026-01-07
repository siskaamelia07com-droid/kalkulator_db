<?php
require 'Calculator.php';

$a = $_POST['angka1'];
$b = $_POST['angka2'];
$op = $_POST['operator'];

$calc = new Calculator();
echo $calc->hitung($a, $b, $op);
