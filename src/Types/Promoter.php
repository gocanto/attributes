<?php declare(strict_types=1);

namespace Gocanto\Attributes\Types;

use Gocanto\Attributes\AttributesException;

class Promoter
{
    private bool $optional = false;
    private string $candidate;

    /**
     * @throws AttributesException
     */
    private function __construct(string $candidate)
    {
        if (!class_exists($candidate, true)) {
            throw new AttributesException("The given candidate [{$candidate}] does not exist.");
        }

        $this->candidate = $candidate;
    }

    /**
     * @throws AttributesException
     */
    public static function make(string $candidate): self
    {
        return new static($candidate);
    }

    /**
     * @throws AttributesException
     */
    public static function optional(string $candidate): self
    {
        $promoter = new static($candidate);
        $promoter->markAsOptional();

        return $promoter;
    }

    public function markAsOptional(): self
    {
        $this->optional = true;

        return $this;
    }

    public function build($value): Type
    {
        $type = $this->candidate;

        return new $type($value);
    }
}