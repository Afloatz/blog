<?php
/**
 * Created by PhpStorm.
 * User: aurelienantonio
 * Date: 15/03/2018
 * Time: 03:20
 */

class BilletEntity
{
    private $id, $date, $titre, $contenu;

    /**
     * Billet constructor.
     *
     * @param $id
     */
    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }


    public function hydrate (array $donnees){
        foreach ($donnees as $key => $value)
        {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);

            // Si le setter correspondant existe.
            if (method_exists($this, $method))
            {
                // On appelle le setter.
                $this->$method($value);
            }

        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $id = (int)$id;
        if($id > 0){
            $this->id = $id;
        }else{
            throw new Exception("L'id entrée n'est pas un nombre");
        }

    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return htmlspecialchars($this->titre);
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }



}