<?php

namespace SFM\Router;

/**
 *  
 * Gère le routage des requêtes HTTP.
 * 
 */
class Router {
    /**
     * @var array Les routes disponibles.
     */
    private $routes;

    /**
     * @var array Les chemins disponibles.
     */
    private $available_paths;

    /**
     * @var string Le chemin de la requête.
     */
    private $request;

    /**
     * Constructeur de la classe Router.
     */
    public function __construct() {
        $this->routes = ROUTES;
        $this->available_paths = array_keys($this->routes);
        $this->request = isset($_GET['r']) ? $_GET['r'] : '/';
        $this->parseRoutes();
    }

    /**
     * Découpe un chemin en segments.
     *
     * @param string $path Le chemin à découper.
     * @return array Les segments du chemin.
     */
    private function explodePath(string $path): array {
        return explode('/', rtrim(ltrim($path, '/'), '/'));
    }

    /**
     * Vérifie si un segment de chemin est un paramètre.
     *
     * @param string $path Le segment de chemin.
     * @return bool Vrai si c'est un paramètre, sinon faux.
     */
    private function is_param(string $path): bool {
        return str_contains($path, '{') && str_contains($path, '}');
    }

    /**
     * Parse les routes pour déterminer la route correspondante à la requête.
     */
    private function parseRoutes(): void {
        $explodedRequestedPath = $this->explodePath($this->request);
        $params = [];
        $route = null;

        foreach ($this->available_paths as $candidatePath) {
            $foundMatch = true;
            $explodedCandidatePath = $this->explodePath($candidatePath);

            if (count($explodedCandidatePath) == count($explodedRequestedPath)) {
                foreach ($explodedRequestedPath as $key => $requestedPathPart) {
                    $candidatePathPart = $explodedCandidatePath[$key];

                    if ($this->is_param($candidatePathPart)) {
                        $params[substr($candidatePathPart, 1, -1)] = $requestedPathPart;
                    } elseif ($candidatePathPart !== $requestedPathPart) {
                        $foundMatch = false;
                        break;
                    }
                }

                if ($foundMatch) {
                    $route = $this->routes[$candidatePath];
                    break;
                }
            }
        }

        if ($route) {
            $this->dispatch($route, $params);
        } else {
            echo '404 - Page non trouvée';
        }
    }

    /**
     * Dispatche la requête vers le contrôleur approprié et appelle la méthode correspondante.
     *
     * @param array $route Les informations sur la route.
     * @param array $params Les paramètres de la route.
     */
    private function dispatch(array $route, array $params): void {
        $controllerName = $route['controller'];
        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            $method = $route['method'];
            if (method_exists($controller, $method)) {
                $controller->$method(...array_values($params));
            } else {
                echo "Méthode $method non trouvée dans le contrôleur $controllerName";
            }
        } else {
            echo "Contrôleur $controllerName non trouvé";
        }
    }
}
