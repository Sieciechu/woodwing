<?php

declare(strict_types=1);

namespace AppTest\Service\DistanceCalculator;

use App\Service\DistanceCalculator\Distance;
use App\Service\DistanceCalculator\InMemoryCalculator;
use App\Service\DistanceCalculator\Unit;
use PHPUnit\Framework\TestCase;

class InMemoryCalculatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider distanceProvider
     * @param Distance $a
     * @param Distance $b
     * @param Unit $unitResult
     * @param Distance $expectedDistance
     */
    public function sum(Distance $a, Distance $b, Unit $unitResult, Distance $expectedDistance)
    {
        $calculator = new InMemoryCalculator();

        $result = $calculator->sum($a, $b, $unitResult);

        $this->assertEquals($expectedDistance, $result);
    }

    public function distanceProvider()
    {
        $basicCase = [
            Distance::createFromMeters(1.0),
            Distance::createFromMeters(2.0),
            Unit::meter(),
            Distance::createFromMeters(3.0)
        ];

        return [
            $basicCase,
        ];
    }
}