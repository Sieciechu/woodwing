<?php

declare(strict_types=1);

namespace App\Service\DistanceCalculator;

final class InMemoryCalculator implements Calculator
{

    /**
     * @inheritDoc
     */
    public function sum(Distance $a, Distance $b, Unit $resultUnit): Distance
    {
        return Distance::createFromMeters(3.0);
    }
}
