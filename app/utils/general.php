<?php

namespace App\Utils;

class General
{
    /**
     * Validates whether all provided fields are non-empty.
     *
     * @param {array} $fields - An array of values to be checked for being non-empty.
     * @returns {boolean} Returns false if at least one field is empty, true otherwise.
     */
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
