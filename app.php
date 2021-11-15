<?php

require_once "src/Util.php";
require_once "src/Model/Account.php";
require_once "src/Model/Agency.php";
require_once "src/Model/Person.php";

$agency  = new Agency("2244", "1");

$gabriel = new Person("450.303.548-75", "Gabriel", "Tinetti");
$alice   = new Person("403.231.231-33", "Alice", "Doe");

$accGabriel = new Account("193238", "1", 0.0, $agency, $gabriel);
$accAlice   = new Account("222232", "1", 0.0, $agency, $alice);

$accGabriel->deposit(2321);

$accAlice->deposit(1000);
$accAlice->transfer(900, $accGabriel);

var_dump($accGabriel->getBalance(), $accAlice->getBalance());