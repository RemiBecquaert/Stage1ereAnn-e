<?php

class Produit{

    private $db;
    private $insert;
    private $select;

    public function __construct($db){
        $this->db = $db;
        $this->insert = $this->db->prepare("insert into lutins(numero, idType, nomProduit, desProduit, prix, photo) values (:numero, :idType, :nomProduit, :desProduit, :prix, :photo)");
        $this->select = $db->prepare("select idProduit, numero, l.idType, nomProduit, desProduit, prix, t.libelle as libelletype, photo from lutins l, type t where l.idType = t.idType order by numero");
    }

    public function insert($numero, $idType, $nomProduit, $desProduit, $prix, $photo){
        $r = true;
        $this->insert->execute(array(':numero'=>$numero, ':idType'=>$idType, ':nomProduit'=>$nomProduit, ':desProduit'=>$desProduit, ':prix'=>$prix, ':photo'=>$photo));
        if ($this->insert->errorCode()!=0){
            print_r($this->insert->errorInfo());
            $r=false;
        }
        return $r;
    }

    public function select(){
        $this->select->execute();
        if ($this->select->errorCode()!=0){
            print_r($this->select->errorInfo());
        }
        return $this->select->fetchAll();        
    }
}



?>