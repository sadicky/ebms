<?php

class User{

    private $table = "tbl_users";
    private $connexion=null;

    public $id;
    public $nom;
    public $prenom;
    public $tel;
    public $email;
    public $password;
    public $created_at;

    public function __construct($db){ 
        if($this->connexion == null){
            $this->connexion = $db;
        }
    }

    public function getAll(){

        $sql = "SELECT * FROM $this->table";        
        $sql = $this->connexion->query($sql);
        $data = $sql->fetchAll(PDO::FETCH_OBJ);
        return $data;

    }

        //user signup method
    public function Signup($nom,$prenom,$tel,$email,$password){
    
            if($this->isAlreadyExist()){
                return false;
            }
            // query to insert record of new user signup
            $query = "INSERT INTO " . $this->table. "
                    SET nom=?, prenom=?,tel=?,email=?,password=?";

            // prepare query
            $req = $this->connexion->prepare($query); 
             $re = $req->execute([$nom,$prenom,$tel,$email,$password]);
             return $re;
            
        }

        
    //Notify if User with given username Already exists during SignUp
    public function isAlreadyExist(){
        $query = "SELECT * FROM " . $this->table. " WHERE
                email='".$this->email."'";
        // prepare query statement
        $stmt = $this->connexion->prepare($query);
        // execute query
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function delete(){
        $sql = "DELETE FROM $this->table WHERE id=:id";
        $req = $this->connexion->prepare($sql);
        $re = $req->execute([
            "id"=>$this->id
        ]);         
      if($re){
        return true;
      }else{
          return false;
      }
    }

    public function update(){

        if($this->isAlreadyExist()){
            return false;
        }
        
        $sql = "UPDATE $this->table SET nom=:nom, prenom=:prenom,tel=:tel,email=:email WHERE id=:id";
        $req = $this->connexion->prepare($sql);        
        $re = $req->execute([
            "nom"=>$this->nom,
            "prenom"=>$this->prenom,
            "tel"=>$this->tel,
            "email"=>$this->email,
            "id"=>$this->id
      ]); 
      if($re){
        return true;
      }else{
          return false;
      }
    }
    // login user method
    public function Login(){
        // select all query with user inputed username and password
        $query = "SELECT * FROM $this->table 
        WHERE email=? AND password=?";
        // prepare query statement
        $stmt = $this->connexion->prepare($query);
        // execute query
        $stmt->execute(array($this->email,$this->password));
        return $stmt;
    }
            // READ single
    public function getUserId($id){
        $this->id = $id;
        $sqlQuery = "SELECT id, nom, prenom, email, created FROM $this->table  WHERE id = :id LIMIT 1";
        $stmt = $this->connexion->prepare($sqlQuery);
        $res = $stmt->execute([
            "id"=>$this->id
        ]);
        // $res = $res->fetch(PDO::FETCH_OBJ);
       return $res;                
    }



}