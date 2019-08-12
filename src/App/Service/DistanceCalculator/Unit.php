<?php

declare(strict_types=1);

namespace App\Service\DistanceCalculator;


class Unit
{
    const METERS = 'm';
    const YARDS = 'yd';

    const ALLOWED_UNITS = [
        self::METERS,
        self::YARDS,
    ];

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $unit
     */
    public function __construct(string $unit)
    {
        if (!in_array($unit, self::ALLOWED_UNITS)) {
            $supportedTypes = implode(", ", self::ALLOWED_UNITS);
            throw new \InvalidArgumentException(
                "Given unit '$unit' is not supported. Only $supportedTypes are allowed"
            );
        }

        $this->value = $unit;
    }
}