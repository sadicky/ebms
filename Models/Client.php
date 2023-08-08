<?php

class Client{

    private $table = "tbl_customer";
    private $connexion=null;

    public $customer_id;
    public $customer_name;
    public $customer_TIN;
    public $customer_address;
    public $vat_customer_payer;

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

    } public function getCl(){

        $sql = "SELECT * FROM $this->table";        
        $sql = $this->connexion->query($sql);
        $data = $sql->fetch(PDO::FETCH_OBJ);
        return $data;

    }

        //user signup method
    public function create($customer_name,$customer_TIN,$customer_address,$vat_customer_payer){
    
            // query to insert record of new user signup
            $query = "INSERT INTO " . $this->table. "
                    SET customer_name=?, customer_TIN=?,customer_address=?,vat_customer_payer=?";
        
            // prepare query
            $req = $this->connexion->prepare($query); 
             $re = $req->execute([$customer_name,$customer_TIN,$customer_address,$vat_customer_payer]);
            return $re;
            
        }


    public function delete(){
        $sql = "DELETE FROM $this->table WHERE customer_id=:customer_id";
        $req = $this->connexion->prepare($sql);
        $re = $req->execute([
            "customer_id"=>$this->customer_id
        ]);         
      if($re){
        return true;
      }else{
          return false;
      }
    }

    public function update(){

        $sql = "UPDATE $this->table SET customer_name=:customer_name, customer_TIN=:customer_TIN,customer_address=:customer_address,
        vat_customer_payer=:vat_customer_payer WHERE customer_id=:customer_id";
        $req = $this->connexion->prepare($sql);        
        $re = $req->execute([
            "customer_name"=>$this->customer_name,
            "customer_TIN"=>$this->customer_TIN,
            "customer_address"=>$this->customer_address,
            "vat_customer_payer"=>$this->vat_customer_payer,
            "customer_id"=>$this->customer_id
      ]); 
      if($re){
        return true;
      }else{
          return false;
      }
    }
  
    // READ single
    public function getClient($customer_id){
        $sqlQuery = "SELECT customer_id, customer_name, customer_TIN, customer_address, vat_customer_payer FROM $this->table  WHERE customer_id = '$customer_id' LIMIT 1";
        $stmt = $this->connexion->query($sqlQuery);
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
    }



}