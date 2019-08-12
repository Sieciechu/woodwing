<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\DistanceCalculator\Calculator;
use Psr\Container\ContainerInterface;

class CalculateDistanceHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CalculateDistanceHandler
    {
        // Retrieve the InputFilterManager
        $filters = $container->get('InputFilterManager');

        return new CalculateDistanceHandler(
            $container->get(Calculator::class),
            $filters->get('queryDistanceCalculator')
        );
    }
}
