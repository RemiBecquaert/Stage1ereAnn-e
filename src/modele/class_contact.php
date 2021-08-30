<?php

class Contact {
    private $db;
    private $insert;
    private $select;
    private $delete;

    public function __construct($db){
        $this->db = $db;
        $this->insert = $this->db->prepare("insert into contact(nom, prenom, email, text)values (:nom, :prenom, :email, :text)");
        $this->select = $db->prepare("select nom, prenom, email, text, id from contact");
        $this->delete = $db->prepare("delete from contact where id=:id");
    }

    public function insert($nom, $prenom, $email, $text, $id){        
        $r = true;        
        $this->insert->execute(array(':nom'=>$nom, ':prenom'=>$prenom, ':email'=>$email, ':text'=>$text, ':id'=>$id));        
        if ($this->insert->errorCode()!=0){
            print_r($this->insert->errorInfo());               
            $r=false;        
        }        
        return $r;    
    }

    public function select(){        
        $r = true;        
        $this->select->execute();        
        if ($this->select->errorCode()!=0){
            print_r($this->select->errorInfo());               
            $r=false;        
        }        
        return $this->select->fetchAll();
    }
    
    public function delete($id){
        $r = true;
        $this->delete->execute(array(':id'=>$id));
        if ($this->delete->errorCode()!=0){
            print_r($this->delete->errorInfo());
            $r = false;
        }
        return $r;
    }
}

?>