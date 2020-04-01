<?php declare(strict_types=1);

namespace Gocanto\Attributes\Types;

use Gocanto\Attributes\AttributesException;
use Gocanto\Attributes\Type;
use Symfony\Component\Validator\Constraints\Url as UrlConstraint;

class Url implements Type
{
    private string $value;

    private function __construct()
    {
    }

    /**
     * @param $value
     * @return static
     * @throws AttributesException
     */
    public static function make($value): self
    {
        Assert::assert($value, self::constraints(), "The given url [{$value}] is invalid.");

        $url = new static();
        $url->value = $value;

        return $url;
    }

    /**
     * @return Constraints
     * @throws AttributesException
     */
    private static function constraints(): Constraints
    {
        return new Constraints([
            new UrlConstraint(),
        ]);
    }

    public function get(): string
    {
        return $this->value;
    }
}
