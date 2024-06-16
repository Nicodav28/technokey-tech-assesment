<?php

namespace App\Utils;

class General
{
    public static function validateEmptyFields(array $fields)
    {
        foreach ($fields as $field) {
            if (empty($field)) {
                return false;
            }
        }

        return true;
    }
}
