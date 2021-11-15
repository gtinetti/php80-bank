<?php

class Agency
{
    private string $number;
    private string $digit;

    public function __construct(string $number, string $digit)
    {
        [$number, $digit] = array_map(
            fn($arg) => Util::sanitize($arg),
            [$number, $digit]
        );

        $this->number = $number;
        $this->digit  = $digit;
    }
}