<?php

require_once "vendor/autoload.php";

use App\Model\Account;
use App\Model\Person;
use App\Model\Agency;

$agency = new Agency("2244", "1");

$john = new Person("50940827018", "John", "Doe");
$xpto = new Person("55942880077", "Xpto", "Doe");

$accJohn = new Account("193238", "1", 0.0, $agency, $john);
$accXpto = new Account("222232", "1", 0.0, $agency, $xpto);

$accJohn->deposit(2321.1);

$accXpto->deposit(1000.3);
$accXpto->transfer(1000, $accJohn);

var_dump(
    $accJohn->getBalance(),
    $accXpto->getBalance()
);