<?php

declare(strict_types=1);

namespace App\Service\DistanceCalculator;

interface Calculator
{
    /**
     * @param Distance $a
     * @param Distance $b
     * @param Unit $resultUnit
     * @return Distance Sum of $a and $b . Distance unit is converted to $resultUnit
     */
    function sum(Distance $a, Distance $b, Unit $resultUnit): Distance;
}