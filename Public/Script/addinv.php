<?php

session_start(); 
require_once('../../Models/connexion2.php');
$db = getConnexion();
   
$order_total_before_tax = 0;
$order_total_tax1 = 0;
$order_total_tax = 0;
$order_total_after_tax = 0;

$invoice_number=htmlspecialchars(strip_tags($_GET['invoice_number']));
$invoice_date=htmlspecialchars(strip_tags($_GET['invoice_date']));
$invoice_type="FN";
$customer_id=htmlspecialchars(strip_tags($_GET['customer_id']));
$order_total_before_tax=$order_total_before_tax;
$order_total_tax1=$order_total_tax1;
$order_total_tax=$order_total_tax;
$order_total_after_tax=$order_total_after_tax;
$invoice_datetime=time();
$invoice_signature=htmlspecialchars(strip_tags($_GET['invoice_signature']));
$payment_type=htmlspecialchars(strip_tags($_GET['payment_type']));
$statut=0;
$annuler=0;
$iduser=$_SESSION['iduser'];
     
$query ="INSERT INTO tbl_inv_order(invoice_number, invoice_date,invoice_type, customer_id, order_total_before_tax, 
order_total_tax1,order_total_tax, order_total_after_tax, invoice_datetime,invoice_signature,payment_type,statut	,annuler,iduser) 
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$req = $db->prepare($query);         
$re = $req->execute([$invoice_number,$invoice_date,$invoice_type,$customer_id,$order_total_before_tax,$order_total_tax1,$order_total_tax,
$order_total_after_tax,$invoice_datetime,$invoice_signature,$payment_type,$statut,$annuler,$iduser]);
    
$statement = $db->query("SELECT LAST_INSERT_ID()");
$order_id = $statement->fetchColumn();
 
for($count=0; $count<$_GET["total_item"]; $count++){

     $order_total_before_tax = $order_total_before_tax + floatval(trim($_GET["order_item_actual_amount"][$count]));
     $order_total_tax1 = $order_total_tax1 + floatval(trim($_GET["order_item_tax1_amount"][$count]));
     $order_total_after_tax = $order_total_after_tax + floatval(trim($_GET["order_item_final_amount"][$count]));
  
     $statement = $db->prepare("
            INSERT INTO tbl_inv_order_item 
            (order_id, item_name, order_item_quantity, order_item_price, order_item_actual_amount, order_item_tax1_rate, order_item_tax1_amount,  order_item_final_amount)
            VALUES (:order_id, :item_name, :order_item_quantity, :order_item_price, :order_item_actual_amount, :order_item_tax1_rate, :order_item_tax1_amount, :order_item_final_amount)
          ");
          $statement->execute(
            array(
              ':order_id'               =>  $order_id,
              ':item_name'              =>  trim($_GET["item_name"][$count]),
              ':order_item_quantity'          =>  trim($_GET["order_item_quantity"][$count]),
              ':order_item_price'           =>  trim($_GET["order_item_price"][$count]),
              ':order_item_actual_amount'       =>  trim($_GET["order_item_actual_amount"][$count]),
              ':order_item_tax1_rate'         =>  trim($_GET["order_item_tax1_rate"][$count]),
              ':order_item_tax1_amount'       =>  trim($_GET["order_item_tax1_amount"][$count]),
              ':order_item_final_amount'        =>  trim($_GET["order_item_final_amount"][$count])
            )
          );
    }
   $order_total_tax = $order_total_tax1 ;

   $statement = $db->prepare("UPDATE tbl_inv_order SET order_total_before_tax = :order_total_before_tax, 
   order_total_tax1 = :order_total_tax1, order_total_tax = :order_total_tax, order_total_after_tax = :order_total_after_tax 
   WHERE order_id = :order_id 
 ");
 $statement->execute(
   array(
     ':order_total_before_tax'     =>  $order_total_before_tax,
     ':order_total_tax1'         =>  $order_total_tax1,
     ':order_total_tax'          =>  $order_total_tax,
     ':order_total_after_tax'      =>  $order_total_after_tax,
     ':order_id'             =>  $order_id
   )
 );
  
}
?>