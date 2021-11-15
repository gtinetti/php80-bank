<?php

namespace App\Model;

class Person
{
    private string $document;
    private string $firstName;
    private string $lastName;

    public function __construct(
        string $document,
        string $firstName,
        string $lastName,
    ) {
        $this->document  = $this->__formatDoc($document);

        [$firstName, $lastName] = array_map(
            fn($arg) => \App\Util::sanitize($arg),
            [$firstName, $lastName]
        );

        $this->firstName = $firstName;
        $this->lastName  = $lastName;
    }

    public function getFullName(): string
    {
        return sprintf("%s %s", $this->firstName, $this->lastName);
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getDocument(): string
    {
        return $this->document;
    }

    private function __formatDoc(string $document): string
    {
        $isFormatted = preg_match("/^([0-9]{3}\.){2}[0-9]{3}\-[a-zA-Z0-9]{2}$/", $document);
        if ($isFormatted) {
            return $document;
        }

        $normalized = \App\Util::sanitize($document);

        return $this->__glueDocNum($this->__splitDocNum($normalized));
    }

    private function __splitDocNum(string $number): array
    {
        return preg_split("/([0-9]{3})/", $number, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    }

    private function __glueDocNum(array $splittedNum): string
    {
        if (count($splittedNum) <= 2) {
            return "";
        }

        return sprintf("%s.%s.%s-%d", ...$splittedNum);
    }
}
