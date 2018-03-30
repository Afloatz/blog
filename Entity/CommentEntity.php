<?php

class CommentEntity
{
    private $id, $date, $auteur, $contenu, $report, $postid;

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

    public function getId()
    {
        return $this->id;
    }

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

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getAuteur()
    {
        return htmlspecialchars($this->auteur);
    }

    public function setAuteur($auteur)
    {
        // On vérifie qu'il s'agit bien d'un chaine de caractères
        if (is_string($auteur))
        {
            $this->auteur = $auteur;
        }
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        if (is_string($contenu))
        {
           $this->contenu = $contenu; 
        }
    }
    
    public function getReport()
    {
        return $this->report;
    }

    public function setReport($report)
    {
        $report = (int)$report;
        $this->report = $report;
    }  
    
    public function getPostId()
    {
        return $this->postid;
    }

    public function setPostId($postid)
    {
        $postid = (int)$postid;
        
        // On vérifie si le nombre est bien strictement positif
        if ($postid > 0) {
            $this->postid = $postid;
        } else {
            throw new Exception("L'id entrée n'est pas un nombre");
        }
    }

}