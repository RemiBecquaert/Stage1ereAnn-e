<?php

class Produit{

    private $db;
    private $insert;
    private $select;
    private $selectById;
    private $delete;

    public function __construct($db){
        $this->db = $db;
        $this->insert = $this->db->prepare("insert into lutins(numero, idType, nomProduit, desProduit, prix, photo) values (:numero, :idType, :nomProduit, :desProduit, :prix, :photo)");
        $this->select = $db->prepare("select idProduit, numero, l.idType, nomProduit, desProduit, prix, t.libelle as libelletype, photo from lutins l, type t where l.idType = t.idType order by numero");
        $this->selectById = $db->prepare("select idProduit, numero, idType, nomProduit, desProduit, prix, photo from lutins where idProduit=:idProduit");
        $this->delete = $db->prepare("delete from lutins where idProduit=:idProduit");
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

    public function selectById($idProduit){
        $this->selectById->execute(array(':idProduit'=>$idProduit));
        if ($this->selectById->errorCode()!=0){
            print_r($this->selectById->errorInfo());
        }
        return $this->selectById->fetch();
    }

    public function delete($idProduit){
        $r = true;
        $this->delete->execute(array(':idProduit'=>$idProduit));
        if ($this->delete->errorCode()!=0){
            print_r($this->delete->errorInfo());
            $r=false;
        }
        return $r;
    }
}



?>