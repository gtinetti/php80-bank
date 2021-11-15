<?php

namespace App\Model;

use \App\Exceptions\BalanceException;

class Account
{
    public function __construct(
        private string $number,
        private string $digit,
        private float $balance,
        private Agency $agency,
        private Person $person,
    ) {}

    public function getPerson(): Person
    {
        return $this->person;
    }

    public function getAgency(): Agency
    {
        return $this->agency;
    }

    public function getBalance(bool $round = true): float
    {
        return ($round) ? round($this->balance, 2) : $this->balance;
    }

    public function deposit(float|int $amount): bool
    {
        $this->balance += $amount;
        return true;
    }

    public function withdraw(float|int $amount): bool
    {
        if ($this->balance - $amount <= 0) {
            throw new BalanceException("Insufficient funds");
        }

        $this->balance -= $amount;
        return true;
    }

    public function transfer(float|int $amount, Account $to): bool
    {
        $this->withdraw($amount);
        $to->deposit($amount);

        return true;
    }
}