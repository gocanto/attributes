<?php

declare(strict_types=1);

namespace Gocanto\Relay\Types;

use Gocanto\Relay\AttributesException;
use Symfony\Component\Validator\Validation;

class Assert
{
    /**
     * @param mixed $value
     * @param Constraints $constraints
     * @param string|null $error
     * @throws AttributesException
     */
    public static function assert($value, Constraints $constraints, ?string $error = null): void
    {
        $validator = Validation::createValidator();

        $validations = $validator->validate($value, $constraints->toArray());

        if (count($validations) === 0) {
            return;
        }

        throw new AttributesException($error ?? "The given value [{$value}] is invalid.");
    }
}
