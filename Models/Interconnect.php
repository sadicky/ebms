<?php
class Interconnect{

    private $table = "tbl_interconnect";
    private $connexion=null;

    public $con_id;
    public $con_url;
    public $con_username;
    public $con_password;

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
    
    public function getInter(){
        $sql = "SELECT * FROM $this->table WHERE con_id=?";        
        $sql = $this->connexion->prepare($sql);
        $sql->execute(array("1"));
        $data = $sql->fetch(PDO::FETCH_OBJ);
        return $data;

    }

    public function create(){
      $sql = "INSERT INTO $this->table(con_id,con_url,con_username,con_password,created_at) VALUES (:con_id,:con_url,:con_username,:con_password,NOW())"; 
      $req = $this->connexion->prepare($sql); 
      $re = $req->execute([
            "con_id"=>$this->con_id,
            "con_url"=>$this->con_url,
            "con_username"=>$this->con_username,
            "con_password"=>$this->con_password
      ]);
      if($re){
        return true;
      }else{
          return false;
      }
    }

    public function update(){
        $sql = "UPDATE $this->table SET con_username=:con_username, con_url=:con_url, con_password=:con_password WHERE con_id=:con_id";
        $req = $this->connexion->prepare($sql);        
        $re = $req->execute([
            "con_username"=>$this->con_username,
            "con_url"=>$this->con_url,
            "con_password"=>$this->con_password,
            "con_id"=>$this->con_id
      ]); 
      if($re){
        return true;
      }else{
          return false;
      }
    }

    public function delete(){
        $sql = "DELETE FROM $this->table WHERE con_id=:con_id";
        $req = $this->connexion->prepare($sql);
        $re = $req->execute([
            "con_id"=>$this->con_id
        ]);         
      if($re){
        return true;
      }else{
          return false;
      }
    }
 
}