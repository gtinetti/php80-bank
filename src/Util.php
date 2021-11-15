<?php

final class Util
{
    public static function sanitize(string $text): string
    {
        return preg_replace("/[^a-zA-Z0-9]/", "", $text);
    }
}