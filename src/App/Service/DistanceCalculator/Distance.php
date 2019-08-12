<?php

declare(strict_types=1);

namespace App\Service\DistanceCalculator;

final class Distance
{
    /** @var float */
    private $value;

    /** @var Unit */
    private $unit;

    public function __construct(float $value, Unit $unit)
    {
        $this->value = $value;
        $this->unit = $unit;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getUnit(): Unit
    {
        return $this->unit;
    }

    public static function createFromMeters(float $meters): self
    {
        return new self($meters, Unit::meter());
    }

    public static function createFromYards(float $yards): self
    {
        return new self($yards, Unit::yard());
    }
}
