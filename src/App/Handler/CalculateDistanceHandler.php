<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\DistanceCalculator\Calculator;
use App\Service\DistanceCalculator\Distance;
use App\Service\DistanceCalculator\Unit;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class CalculateDistanceHandler implements RequestHandlerInterface
{
    const QUERY_DISTANCES_SEPARATOR = ",";

    /** @var Calculator */
    private $calculator;

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $targetUnit = $request->getQueryParams()['targetUnit'];

        $query = $request->getQueryParams()['query'];
        $distances = $this->convertQueryToDistances($query);

        $result = $this->calculator->sum($distances[0], $distances[1], new Unit($targetUnit));
        return new JsonResponse(['value' => $result->getValue(), 'unit' => (string)$result->getUnit()]);
    }

    public function convertQueryToDistances($query): array
    {
        $matches = [];
        $separator = self::QUERY_DISTANCES_SEPARATOR;
        preg_match_all("#((.*?) \b(Yards|Meters)\b)$separator?#", $query, $matches);
        $distancesValues = $matches[2];
        $distancesUnits = $matches[3];

        $distances = [];
        foreach ($distancesValues as $i => $value) {
            $unit = $distancesUnits[$i];
            if ('Yards' == $unit) {
                $unit = Unit::yard();
            }
            else if ('Meters' == $unit) {
                $unit = Unit::meter();
            }
            $distance = new Distance((float)$value, $unit);

            $distances[] = $distance;
        }

        return $distances;
    }
}
