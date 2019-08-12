<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\DistanceCalculator\Calculator;
use Psr\Container\ContainerInterface;

class CalculateDistanceHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CalculateDistanceHandler
    {
        return new CalculateDistanceHandler($container->get(Calculator::class));
    }
}
