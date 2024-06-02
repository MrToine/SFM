<?php
/**
 * Modèle abstrait de base pour les modèles.
 */
namespace SFM\Model;

abstract class Model extends BaseModel {

    /**
     * Nom de la table.
     * @var string
     */
    protected $table;

    /**
     * Attributs du modèle.
     * @var array
     */
    protected $attributes = [];

    /**
     * Constructeur de la classe Model.
     *
     * @param array $attributes Les attributs du modèle.
     */
    public function __construct(array $attributes = []) {
        parent::__construct($this->table . '.json');
        $this->fill($attributes);
    }

    /**
     * Remplit les attributs du modèle.
     *
     * @param array $attributes Les attributs à remplir.
     * @return void
     */
    public function fill(array $attributes) {
        foreach ($attributes as $key => $value) {
            $this->attributes[$key] = $value;
        }
    }

    /**
     * Récupère tous les objets du modèle.
     *
     * @return array Les objets du modèle.
     */
    public function all() {
        $data = $this->loadData();
        $objects = [];
        foreach ($data as $id => $attributes) {
            $objects = new static($attributes);
        }

        return $objects;
    }

    /**
     * Récupère un objet du modèle par son identifiant.
     *
     * @param int $id L'identifiant de l'objet.
     * @return mixed L'objet trouvé ou null s'il n'existe pas.
     */
    public function find(int $id) {
        $data = $this->loadData();
        if (isset($data->$id)) {
            return new static($data->$id);
        }
        return null;
    }

    /**
     * Récupère le dernier objet du modèle.
     *
     * @return mixed Le dernier objet trouvé ou null s'il n'existe pas.
     */
    public function last() {
        $data = $this->loadData();
        if (!empty($data)) {
            $keys = array_keys((array) $data);
            $lastKey = $keys[count($keys) - 1];
            $lastRecord = $data->{$lastKey};
            if (is_array($lastRecord)) {
                $lastRecord['id'] = $lastKey;
            } elseif (is_object($lastRecord)) {
                $lastRecord->id = $lastKey;
            }
            return $this->find($lastKey);
        }
        return null;
    }

    /**
     * Récupère le premier objet du modèle.
     *
     * @return mixed Le premier objet trouvé ou null s'il n'existe pas.
     */
    public function first() {
        $data = $this->loadData();
        if ($data) {
            return $this->find(1);
        }
    }

    /**
     * Insère un nouvel objet dans le modèle.
     *
     * @param array $attributes Les attributs de l'objet à insérer.
     * @return mixed Le nouvel objet inséré.
     */
    public function insert(array $attributes) {
        $data = $this->loadData();
        $last = $this->last();
        $i = $last->id + 1;
        $data->$i = $attributes;
        $this->saveData($data);
        return new static($attributes);
    }

    /**
     * Sauvegarde les modifications d'un objet dans le modèle.
     *
     * @return bool True si la sauvegarde a réussi, false sinon.
     */
    public function save() {
        $data = $this->loadData();
        $id = $this->attributes['id'];
        if (isset($data->$id)) {
            $data->$id = $this->attributes;
            $this->saveData($data);
            return true;
        }
        return false;
    }

    /**
     * Supprime un objet du modèle.
     *
     * @return bool True si la suppression a réussi, false sinon.
     */
    public function destroy() {
        $data = $this->loadData();
        $id = $this->attributes['id'];
        if (isset($data->$id)) {
            unset($data->$id);
            $this->saveData($data);
            return true;
        }
        return false;
    }

    /**
     * Récupère les attributs du modèle.
     *
     * @return array Les attributs du modèle.
     */
    public function getAttributes() {
        return $this->attributes;
    }

    /**
     * Accède à un attribut du modèle.
     *
     * @param string $key Le nom de l'attribut.
     * @return mixed La valeur de l'attribut ou null s'il n'existe pas.
     */
    public function __get($key) {
        return $this->attributes[$key] ?? null;
    }

    /**
     * Modifie la valeur d'un attribut du modèle.
     *
     * @param string $key Le nom de l'attribut.
     * @param mixed $value La nouvelle valeur de l'attribut.
     * @return void
     */
    public function __set($key, $value) {
        $this->attributes[$key] = $value;
    }
} 
