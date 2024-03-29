<?php

declare(strict_types=1);

namespace App;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'input_filter_specs' => $this->getInputFilterSpecs(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,
                Service\DistanceCalculator\InMemoryCalculator::class => Service\DistanceCalculator\InMemoryCalculator::class,
            ],
            'factories'  => [
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
                Handler\CalculateDistanceHandler::class => Handler\CalculateDistanceHandlerFactory::class,
            ],
            'aliases' => [
                Service\DistanceCalculator\Calculator::class => Service\DistanceCalculator\InMemoryCalculator::class,
            ]
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'app'    => ['templates/app'],
                'error'  => ['templates/error'],
                'layout' => ['templates/layout'],
            ],
        ];
    }

    private function getInputFilterSpecs()
    {
        return  [
            'queryDistanceCalculator' => [
                [
                    'name' => 'targetUnit',
                    'required' => true,
                    'allow_empty' => false,
                    'continue_if_empty' => false,
                ],
                [
                    'name' => 'query',
                    'required' => true,
                    'allow_empty' => false,
                    'continue_if_empty' => false,
                ],
            ],
        ];
    }
}
