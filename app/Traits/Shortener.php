<?php

namespace App\Traits;

use Random\RandomException;

trait Shortener
{
    /**
     * @throws RandomException
     */
    public function base62_encode($number): string
    {
        $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $encoded          = '';

        while ($number > 0) {
            $encoded = $characters[$number % $charactersLength] . $encoded;
            $number  = floor($number / $charactersLength);
        }

        # Ensure the result is minimum 6 characters long
        while (strlen($encoded) < 6) {
            $encoded .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $encoded;
    }
}
