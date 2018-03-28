<?php

class CommentEntity
{
    private $id, $date, $auteur, $contenu, com_report, $post_id;

    /**
     * Comment constructor.
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
        
        // On vérifie si le nombre est bien strictement positif
        if ($id > 0) {
            $this->id = $id;
        } else {
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
    public function getAuteur()
    {
        return htmlspecialchars($this->auteur);
    }

    /**
     * @param mixed $auteur
     */
    public function setAuteur($auteur)
    {
        // On vérifie qu'il s'agit bien d'un chaine de caractères
        if (is_string($auteur))
        {
            $this->auteur = $auteur;
        }
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return htmlspecialchars($this->contenu);
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        if (is_string($contenu))
        {
           $this->contenu = $contenu; 
        }
    }
    
    public function getComReport()
    {
        return $this->com_report;
    }

    /**
     * @param mixed $id
     */
    public function setComReport($com_report)
    {
        $com_report = (int)$com_report;
        $this->com_report = $com_report;
    }    
    
    public function getBilletId()
    {
        return $this->post_id;
    }
    
    public function setBilletId($post_id)
    {
        $post_id = (int)$post_id;
        
        // On vérifie si le nombre est bien strictement positif
        if ($post_id > 0) {
            $this->post_id = $post_id;
        } else {
            throw new Exception("L'id entrée n'est pas un nombre");
        }

    }

}