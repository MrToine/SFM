<?php
/**
 * Classe abstraite de base pour les modèles.
 */
namespace SFM\Model;

abstract class BaseModel {
    /**
     * Chemin du fichier de données.
     * @var string
     */
    protected $dataFilePath;

    /**
     * Constructeur de la classe BaseModel.
     *
     * @param string $filename Le nom du fichier de données.
     */
    protected function __construct($filename) {
        $this->dataFilePath = dirname(__DIR__, 2) . '/data/' . $filename;
    }

    /**
     * Charge les données à partir du fichier.
     *
     * @return mixed Les données chargées depuis le fichier.
     */
    protected function loadData() {
        $jsonData = file_get_contents($this->dataFilePath);
        $decodedData = json_decode($jsonData, true);
    
        // Assurez-vous que les données sont sous forme d'un tableau ou d'un objet
        if (is_array($decodedData) || is_object($decodedData)) {
            return $decodedData;
        } else {
            // Si les données ne sont ni un tableau ni un objet, retournez une valeur par défaut (par exemple, un tableau vide)
            return [];
        }
    }

    /**
     * Sauvegarde les données dans le fichier.
     *
     * @param mixed $data Les données à sauvegarder.
     * @return void
     */
    protected function saveData($data) {
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($this->dataFilePath, $jsonData);
    }

    /**
     * Convertit les données en objet.
     *
     * @param mixed $data Les données à convertir.
     * @return object L'objet résultant.
     */
    protected function convertToObject($data) {
        return (object) $data;
    }
}
