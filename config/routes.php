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
    ]
];
