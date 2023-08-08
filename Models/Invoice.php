<?php

class Invoice{

    private $table = "tbl_inv_order";
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
        $sql = "SELECT tbl_inv_order.invoice_date,tbl_inv_order.invoice_number,tbl_customer.customer_name,tbl_customer.vat_customer_payer,tbl_inv_order.order_total_after_tax,tbl_users.nom FROM tbl_inv_order_item,tbl_customer,tbl_inv_order,tbl_users where tbl_customer.customer_id=tbl_inv_order.customer_id and tbl_inv_order.order_id=tbl_inv_order_item.order_id
        and tbl_users.id=tbl_inv_order.iduser order by tbl_inv_order.invoice_date DESC";       
        $sql = $this->connexion->query($sql);
        $data = $sql->fetchAll(PDO::FETCH_OBJ);
        return $data;

    }

        //user signup method
    public function create($invoice_number,$invoice_date,$invoice_type,$customer_id,$order_total_before_tax,$order_total_tax1,$order_total_tax,
    $order_total_after_tax,$invoice_datetime,$invoice_signature,$payment_type,$statut,$annuler,$iduser){
    
    $query ="INSERT INTO". $this->table. "(invoice_number, invoice_date,invoice_type, customer_id, order_total_before_tax, 
    order_total_tax1,order_total_tax, order_total_after_tax, invoice_datetime,invoice_signature,payment_type,statut	,annuler,iduser) 
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
    $req = $this->connexion->prepare($query);         
    $re = $req->execute([$invoice_number,$invoice_date,$invoice_type,$customer_id,$order_total_before_tax,$order_total_tax1,$order_total_tax,
    $order_total_after_tax,$invoice_datetime,$invoice_signature,$payment_type,$statut,$annuler,$iduser]);
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
    public function getInv(){
        $sqlQuery = "SELECT order_id FROM $this->table  ORDER BY order_id DESC LIMIT 1";
        $stmt = $this->connexion->prepare($sqlQuery);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_OBJ);
       return $res;                
    }

    // $last = "SELECT order_id FROM tbl_inv_order ORDER BY order_id DESC LIMIT 1"; 
    // $statl = $connect->prepare($last);  
    // $statl->execute( );       
    // $l=$statl->fetch(); 

}