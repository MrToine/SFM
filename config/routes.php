<?php
/**
 * Tableau des routes pour le routage des requêtes HTTP.
 */
const ROUTES = [
    '/' => [
        'controller' => App\Controllers\HomeController::class,
        'method' => 'index'
    ],
    '/save_test' => [
        'controller' => App\Controllers\HomeController::class,
        'method' => 'save_test'
    ],
    '/delete' => [
        'controller' => App\Controllers\HomeController::class,
        'method' => 'delete'
    ],
    '/test' => [
        'controller' => App\Controllers\HomeController::class,
        'method' => 'test'
    ],

    //DataVisualizer
    '/DataVisualizer/add' => [
        'controller' => App\Controllers\DataVisualizerController::class,
        'method' => 'add'
    ],
    '/DataVisualizer/{table}' => [
        'controller' => App\Controllers\DataVisualizerController::class,
        'method' => 'index'
    ],
];
