<?php

namespace SFM\Controller;

/**
 * Classe abstraite de base pour les contrôleurs.
 */
abstract class BaseController {

    /** @var array Les variables à passer à la vue. */
    private $vars = [];
    
    /** @var string Le nom du layout par défaut. */
    public $layout = 'layout';

    /**
     * Affiche une vue avec les données fournies.
     *
     * @param string $template Le chemin vers le fichier de vue.
     * @param mixed $data Les données à passer à la vue.
     * 
     * @return void
     */
    protected function render(string $template, $data = null): void {
        
        if ($data !== null) {
            if(is_array($data)) {
                extract($data);
            } else {
                foreach (get_object_vars($data) as $key => $value) {
                    $this->vars[$key] = $value;
                }
            }
        }

        ob_start();

        require dirname(__DIR__, 2) . '/app/views/' . $template;
        $output = ob_get_clean();

        require dirname(__DIR__, 2) . '/app/views/' . $this->layout . '.php';
    }

    /**
     * Redirige vers une route avec des paramètres.
     *
     * @param string $path Le chemin de la route.
     * @param array $params Les paramètres de la route.
     * 
     * @return void
     */
    protected function redirect_to_route(string $path, array $params): void {
        $uri = $_SERVER['SCRIPT_NAME'] . "?r=" . $path;

        if(!empty($params)) {
            $str_params = [];

            foreach ($params as $key => $value) {
                array_push($str_params, urlencode((string) $key) . '=' . urlencode((string) $value));
            }
            $uri .= '&' . implode('&', $str_params);
        }

        header("Location: " . $uri);
        die;
    }
}
