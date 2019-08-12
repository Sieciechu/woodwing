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

        $basicYardCase = [
            Distance::createFromYards(1.0),
            Distance::createFromYards(2.0),
            Unit::yard(),
            Distance::createFromYards(3.0)
        ];

        $mixedUnitsCase1 = [
            Distance::createFromMeters(1.0),
            Distance::createFromYards(2.0),
            Unit::meter(),
            Distance::createFromMeters(2.8288)
        ];

        $mixedUnitsCase2 = [
            Distance::createFromMeters(1.0),
            Distance::createFromYards(2.0),
            Unit::yard(),
            Distance::createFromYards(3.0936133)
        ];

        $mixedUnitsCase3 = [
            Distance::createFromMeters(1.0),
            Distance::createFromMeters(2.0),
            Unit::yard(),
            Distance::createFromYards(3.2808399)
        ];

        $mixedUnitsCase4 = [
            Distance::createFromYards(1.0),
            Distance::createFromYards(2.0),
            Unit::meter(),
            Distance::createFromMeters(2.7432)
        ];

        return [
            $basicCase,
            $basicYardCase,
            $mixedUnitsCase1,
            $mixedUnitsCase2,
            $mixedUnitsCase3,
            $mixedUnitsCase4,
        ];
    }
}