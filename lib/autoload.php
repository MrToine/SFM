<?php
/**
 * ALIASES
 *
 * Tableau des alias de namespaces pour les chargements automatiques.
 */
const ALIASES = [
    'SFM' => 'lib',
    'App' => 'app',
    'Plugins' => 'plugins'
];

/**
 * Enregistre une fonction d'autoload pour charger les classes automatiquement.
 */
spl_autoload_register(function(string $class): void {
    $namespaces = explode('\\', $class);

    // Vérifie si le premier segment du namespace est dans les alias définis
    if (in_array($namespaces[0], array_keys(ALIASES))) {
        // Remplace le premier segment du namespace par son alias
        $namespaces[0] = ALIASES[$namespaces[0]];
    } else {
        // Lance une exception si le namespace n'est pas reconnu
        throw new Exception("Namespace <{$namespaces[0]}> invalide");
    }

    // Construit le chemin du fichier de la classe
    $filepath = dirname(__DIR__) . '/' . implode('/', $namespaces) . '.php';

    // Lance une exception si le fichier de la classe n'existe pas
    if (!file_exists($filepath)) {
        throw new Exception("Le fichier <{$filepath}> est introuvable pour la classe <{$class}>");
    }

    // Charge le fichier de la classe
    require $filepath;
});