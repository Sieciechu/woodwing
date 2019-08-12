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
        $convertedA = $this->convertDistance($a, $resultUnit);
        $convertedB = $this->convertDistance($b, $resultUnit);

        $distanceValue = $convertedA->getValue() + $convertedB->getValue();

        return new Distance($distanceValue, $resultUnit);
    }

    /**
     * @param Distance $source
     * @param Unit $targetUnit
     * @return Distance Creates new Distance
     */
    private function convertDistance(Distance $source, Unit $targetUnit): Distance
    {
        if ((string)$source->getUnit() === (string)$targetUnit) {
            return $source;
        }

        if (Unit::METERS === (string)$targetUnit) {
            return Distance::createFromMeters($source->getValue() * 0.9144);
        }

        if (Unit::YARDS === (string)$targetUnit) {
            return Distance::createFromYards($source->getValue() * 1.0936133);
        }
    }
}
